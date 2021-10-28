# My Articles - Simple REST API Project

## Task
- Simple REST API for Articles and Tags

## API Endpoints

### Articles

#### - Get All Articles
##### Request
```
GET /api/articles
```
##### Response
Status Code: 200 OK
```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Article one",
            "content": "Lorem ipsum...",
            "image": "images/articles/article1.jpg",
            "tags": [
                "simple",
                "nice",
                "good"
            ]
        },
        {
            "id": 2,
            "title": "Article two",
            "content": "Lorem ipsum...",
            "image": "images/articles/article2.jpg",
            "tags": [
                "interesting",
                "viral"
            ]
        }
    ],
    "message": ""
}
```

#### - Create Article
##### Request
```
POST /api/articles

{
    "title": "Hello world",
    "content": "Lorem ipsum...",
    "image": ...,
    "tags": "hello,world,good,tags"
}
```
##### Response
Status Code: 201 Created
```
{
    "success": true,
    "data": {
        "id": 19,
        "title": "Hello world",
        "content": "Lorem ipsum...",
        "image": "images/articles/img-1635413832-5323.jpg",
        "tags": [
            "hello",
            "world",
            "good",
            "tags"
        ]
    },
    "message": "The article has been created successfully!"
}
```

#### - Get Article By Id
##### Request
```
GET /api/articles/1
```
##### Response
Status Code: 200 OK
```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Article one",
            "content": "Lorem ipsum...",
            "image": "images/articles/article1.jpg",
            "tags": [
                "simple",
                "nice",
                "good"
            ]
        }
    ],
    "message": ""
}
```

#### - Update Article By Id
##### Request
```
PATCH /api/articles/1

{
    "title": "New title for article one",
    "tags": "new,tags,here"
}
```
##### Response
Status Code: 200 OK
```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "New title for article one",
            "content": "Lorem ipsum...",
            "image": "images/articles/article1.jpg",
            "tags": [
                "new",
                "tags",
                "here"
            ]
        }
    ],
    "message": ""
}
```

#### - Delete Article By Id
##### Request
```
DELETE /api/articles/1
```
##### Response
Status Code: 200 OK
```
{
    "success": true,
    "data": [],
    "message": "The article has been successfully deleted!"
}
```

#### - Get All Articles By Filter With Tags
##### Request
```
GET /api/articles?tags=interesting,viral
```
##### Response
Status Code: 200 OK
```
{
    "success": true,
    "data": [
        {
            "id": 2,
            "title": "Article two",
            "content": "Lorem ipsum...",
            "image": "images/articles/article2.jpg",
            "tags": [
                "interesting",
                "viral"
            ]
        }
    ],
    "message": ""
}
```


### Tags

#### - Get All Tags
##### Request
```
GET /api/tags
```
##### Response
Status Code: 200 OK
```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "good"
        },
        {
            "id": 2,
            "name": "nice"
        }
    ],
    "message": ""
}
```

#### - Create Tag
##### Request
```
POST /api/tags

{
    "name": "interesting"
}
```
##### Response
Status Code: 201 Created
```
{
    "success": true,
    "data": {
        "id": 5,
        "name": "interesting"
    },
    "message": "The tag has been created successfully!"
}
```

#### - Get Tag By Id
##### Request
```
GET /api/tags/5
```
##### Response
Status Code: 200 OK
```
{
    "success": true,
    "data": [
        {
            "id": 5,
            "name": "interesting",
        }
    ],
    "message": ""
}
```

#### - Update Tag By Id
##### Request
```
PATCH /api/tags/5

{
    "name": "viral"
}
```
##### Response
Status Code: 200 OK
```
{
    "success": true,
    "data": [
        {
            "id": 5,
            "name": "viral"
        }
    ],
    "message": ""
}
```

#### - Delete Tag By Id
##### Request
```
DELETE /api/tags/1
```
##### Response
Status Code: 200 OK
```
{
    "success": true,
    "data": [],
    "message": "The tag has been successfully deleted!"
}
```
