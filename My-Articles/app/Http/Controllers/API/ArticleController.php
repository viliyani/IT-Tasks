<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ArticleController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::select('*');

        // Check tags filtering
        if ($request->has('tags')) {
            $tagsInput = $request->query('tags');

            $tagNames = explode(',', $tagsInput);

            $articles = $articles->whereHas('tags', function ($query) use ($tagNames) {
                $query->whereIn('name', $tagNames);
            });
        }

        $articles = $articles->get();

        $articlesArray = [];

        foreach ($articles as $article) {
            $articlesArray[] = $article->getArticleData();
        }

        // Response
        $this->apiResponseContent['data'] = $articlesArray;

        return $this->sendResponse();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $isValidInput = $this->checkIsValidArticleInput($request);

        if ($isValidInput === false) {
            return $this->sendResponse();
        }

        // Upload image
        $imagePath = $this->uploadArticleImage($request);

        // Create article
        $article = Article::create([
            'title' => $request->input('title', ''),
            'content' => $request->input('content', ''),
            'image' => $imagePath,
        ]);

        // Proccess tags
        $this->proccessArticleTags($request, $article);

        // Response
        $this->apiResponseContent['data'] = $article->getArticleData();
        $this->apiResponseContent['message'] = 'The article has been created successfully!';
        $this->apiResponseStatusCode = 201;

        return $this->sendResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get article if exist
        $article = $this->getArticleIfExist($id);

        if ($article === null) {
            return $this->sendResponse();
        }

        // Response
        $this->apiResponseContent['data'] = $article->getArticleData();

        return $this->sendResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get article if exist
        $article = $this->getArticleIfExist($id);

        if ($article === null) {
            return $this->sendResponse();
        }

        // Validate
        $isValidInput = $this->checkIsValidArticleInput($request, true);

        if ($isValidInput === false) {
            return $this->sendResponse();
        }

        // Update only the given fields
        if ($request->has('title')) {
            $article->title = $request->input('title');
        }

        if ($request->has('content')) {
            $article->content = $request->input('content');
        }

        if ($request->has('image')) {
            $imagePath = $this->uploadArticleImage($request);
            $article->image = $imagePath;
        }

        if ($request->has('tags')) {
            $tagsInput = $request->input('tags');

            if ($tagsInput == '-') {
                // Detach all tags
                $article->tags()->sync([]);
            } else {
                // Proccess tags
                $this->proccessArticleTags($request, $article);
            }
        }

        $article->save();

        // Response
        $this->apiResponseContent['data'] = $article->getArticleData();
        $this->apiResponseStatusCode = 200;

        return $this->sendResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get article if exist
        $article = $this->getArticleIfExist($id);

        if ($article === null) {
            return $this->sendResponse();
        }

        // Destroy the article
        $article->delete();

        // Response
        $this->apiResponseContent['message'] = 'The article has been successfully deleted!';
        $this->apiResponseStatusCode = 200;

        return $this->sendResponse();
    }

    // ## Custom Helper Methods
    public function getArticleIfExist($id)
    {
        $article = Article::find($id);

        if ($article === null) {
            // Set response variables
            $this->apiResponseContent['success'] = false;
            $this->apiResponseContent['message'] = 'Article not found!';
            $this->apiResponseStatusCode = 404;
        }

        return $article;
    }

    public function checkIsValidArticleInput($request, $isUpdateValidation = false)
    {
        // Validate input
        $rules = [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
        ];

        if ($isUpdateValidation === false) {
            $rules['title'] = 'required|min:3|max:250';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Set response variables
            $this->apiResponseContent["success"] = false;
            $this->apiResponseContent["message"] = "There are validation errors.";
            $this->apiResponseContent["errors"] = $validator->errors();
            $this->apiResponseStatusCode = 422;

            return false;
        }

        return true;
    }

    public function uploadArticleImage($request)
    {
        $imagePath = '';

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageFileName = 'img-' . time() . '-' . rand(1000, 9999) . '.' . $extension;
            $articleImagesDir = 'images/articles/';
            $imagePath = $articleImagesDir . $imageFileName;
            $file->move($articleImagesDir, $imageFileName);
        }

        return $imagePath;
    }

    public function proccessArticleTags($request, $article)
    {
        // Proccess tags
        $tagsInput = $request->input('tags');
        $tagIds = [];

        if ($tagsInput != '') {
            $tagNames = explode(',', $tagsInput);

            foreach ($tagNames as $tagName) {
                $tagName = trim($tagName);
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }

        // Sync tags
        $article->tags()->sync($tagIds);
    }
}
