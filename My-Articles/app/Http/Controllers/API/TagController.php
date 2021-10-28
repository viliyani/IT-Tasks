<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TagController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::select(['id', 'name'])->get();

        // Response
        $this->apiResponseContent['data'] = $tags;

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
        $isValidInput = $this->checkIsValidTagInput($request);

        if ($isValidInput === false) {
            return $this->sendResponse();
        }

        // Create tag
        $tag = Tag::firstOrCreate([
            'name' => $request->input('name'),
        ]);

        // Response
        $this->apiResponseContent['data'] = $tag->getTagData();
        $this->apiResponseContent['message'] = 'The tag has been created successfully!';
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
        // Get tag if exist
        $tag = $this->getTagIfExist($id);

        if ($tag === null) {
            return $this->sendResponse();
        }

        // Response
        $this->apiResponseContent['data'] = $tag->getTagData();

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
        // Get tag if exist
        $tag = $this->getTagIfExist($id);

        if ($tag === null) {
            return $this->sendResponse();
        }

        // Validate
        $isValidInput = $this->checkIsValidTagInput($request);

        if ($isValidInput === false) {
            return $this->sendResponse();
        }

        // Update value
        $tag->name = $request->input('name');
        $tag->save();

        // Response
        $this->apiResponseContent['data'] = $tag->getTagData();
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
        // Get tag if exist
        $tag = $this->getTagIfExist($id);

        if ($tag === null) {
            return $this->sendResponse();
        }

        // Destroy the tag
        $tag->delete();

        // Response
        $this->apiResponseContent['message'] = 'The tag has been successfully deleted!';
        $this->apiResponseStatusCode = 200;

        return $this->sendResponse();
    }

    // ## Custom Helper Methods
    public function getTagIfExist($id)
    {
        $tag = Tag::find($id);

        if ($tag === null) {
            // Set response variables
            $this->apiResponseContent['success'] = false;
            $this->apiResponseContent['message'] = 'Tag not found!';
            $this->apiResponseStatusCode = 404;
        }

        return $tag;
    }

    public function checkIsValidTagInput($request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
        ]);

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
}
