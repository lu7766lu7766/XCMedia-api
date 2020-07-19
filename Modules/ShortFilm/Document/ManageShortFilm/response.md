# 成人短片管理

> 新增短片

```json
{
    "code": "0",
    "data": {
        "title": "達克的秘密3",
        "alias": null,
        "mosaic_type": "WITH_MOSAIC",
        "tags": null,
        "description": null,
        "status": "Y",
        "open_at": null,
        "video_status": null,
        "video_path": "pZ005JArTxsCCrRP9myjxZCfbTRHNHirtsadGbqN.mp4",
        "video_url": "http://localhost/storage/pZ005JArTxsCCrRP9myjxZCfbTRHNHirtsadGbqN.mp4",
        "region_id": 2,
        "views": 0,  //瀏覽率
        "score": 0,  //評分
        "cup_id": 1,
        "year_id": 2,
        "updated_at": "2020-03-26 16:04:18",
        "created_at": "2020-03-26 16:04:18",
        "id": 1,
        "region": {
            "id": 2,
            "name": "臺灣",
            "status": "Y",
            "note": null,
            "used_type": "short_film",
            "created_at": "2020-03-26 15:59:13",
            "updated_at": "2020-03-26 15:59:13"
        },
        "cup": {
            "id": 1,
            "size": "E",
            "status": "Y",
            "note": null,
            "used_type": "short_film",
            "created_at": "2020-03-26 15:59:00",
            "updated_at": "2020-03-26 15:59:00"
        },
        "year": {
            "id": 2,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "short_film",
            "created_at": "2020-03-26 15:58:24",
            "updated_at": "2020-03-26 15:58:24"
        }
    }
}
```

> 短片總數

```json
{
    "data": "0",
    "code": "0"
}
```

> 短片列表

```json
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "title": "達克的秘密3",
            "alias": null,
            "mosaic_type": "WITH_MOSAIC",
            "region_id": 2,
            "cup_id": 1,
            "year_id": 2,
            "tags": null,
            "description": null,
            "views": 0,  //瀏覽率
            "score": 0,  //評分
            "status": "Y",
            "video_status": null,
            "cover_path": null,
            "cover_url": null,
            "video_path": "pZ005JArTxsCCrRP9myjxZCfbTRHNHirtsadGbqN.mp4",
            "video_url": "http://localhost/storage/pZ005JArTxsCCrRP9myjxZCfbTRHNHirtsadGbqN.mp4",
            "open_at": null,
            "created_at": "2020-03-26 16:04:18",
            "updated_at": "2020-03-26 16:04:18",
            "region": {
                "id": 2,
                "name": "臺灣",
                "status": "Y",
                "note": null,
                "used_type": "short_film",
                "created_at": "2020-03-26 15:59:13",
                "updated_at": "2020-03-26 15:59:13"
            },
            "year": {
                "id": 2,
                "title": "2020",
                "remark": null,
                "status": "Y",
                "used_type": "short_film",
                "created_at": "2020-03-26 15:58:24",
                "updated_at": "2020-03-26 15:58:24"
            },
            "cup": {
                "id": 1,
                "size": "E",
                "status": "Y",
                "note": null,
                "used_type": "short_film",
                "created_at": "2020-03-26 15:59:00",
                "updated_at": "2020-03-26 15:59:00"
            },
            "av_actress": [
                {
                    "id": 2,
                    "name": "三上悠亞",
                    "alias": null,
                    "image_path": null,
                    "image_url": null,
                    "status": "Y",
                    "note": null,
                    "used_type": "short_film",
                    "created_at": "2020-03-26 15:58:41",
                    "updated_at": "2020-03-26 15:58:41",
                    "pivot": {
                        "av_actress_used_id": 1,
                        "av_actress_id": 2,
                        "av_actress_used_type": "Modules\\ShortFilm\\Entities\\ShortFilm"
                    }
                },
                {
                    "id": 1,
                    "name": "明日花綺蘿",
                    "alias": null,
                    "image_path": null,
                    "image_url": null,
                    "status": "Y",
                    "note": null,
                    "used_type": "short_film",
                    "created_at": "2020-03-26 15:58:32",
                    "updated_at": "2020-03-26 15:58:32",
                    "pivot": {
                        "av_actress_used_id": 1,
                        "av_actress_id": 1,
                        "av_actress_used_type": "Modules\\ShortFilm\\Entities\\ShortFilm"
                    }
                },
                {
                    "id": 3,
                    "name": "杰哥",
                    "alias": null,
                    "image_path": null,
                    "image_url": null,
                    "status": "Y",
                    "note": null,
                    "used_type": "short_film",
                    "created_at": "2020-03-26 15:58:48",
                    "updated_at": "2020-03-26 15:58:48",
                    "pivot": {
                        "av_actress_used_id": 1,
                        "av_actress_id": 3,
                        "av_actress_used_type": "Modules\\ShortFilm\\Entities\\ShortFilm"
                    }
                }
            ],
            "genres": [
                {
                    "id": 3,
                    "title": "動作",
                    "remark": null,
                    "image_path": null,
                    "image_url": null,
                    "status": "Y",
                    "used_type": "short_film",
                    "created_at": "2020-03-26 15:59:05",
                    "updated_at": "2020-03-26 15:59:05",
                    "pivot": {
                        "genres_used_id": 1,
                        "genres_id": 3,
                        "genres_used_type": "Modules\\ShortFilm\\Entities\\ShortFilm"
                    }
                }
            ],
            "editor_files": []
        }
    ]
}
```

> 編輯短片

```json
{
    "code": "0",
    "data": {
        "id": 1,
        "title": "達克的秘密",
        "alias": null,
        "mosaic_type": "WITH_MOSAIC",
        "region_id": 2,
        "cup_id": 1,
        "year_id": 2,
        "tags": null,
        "description": "我是達克我6",
        "status": "Y",
        "video_status": null,
        "views": 0,  //瀏覽率
        "score": 0,  //評分
        "cover_path": null,
        "cover_url": null,
        "video_path": "giax6RPemNfbneUzpVK2rixmfeFznU3YS4lGoyiC.mp4",
        "video_url": "http://localhost/storage/giax6RPemNfbneUzpVK2rixmfeFznU3YS4lGoyiC.mp4",
        "open_at": null,
        "created_at": "2020-03-26 16:04:18",
        "updated_at": "2020-03-26 16:07:39",
        "region": {
            "id": 2,
            "name": "臺灣",
            "status": "Y",
            "note": null,
            "used_type": "short_film",
            "created_at": "2020-03-26 15:59:13",
            "updated_at": "2020-03-26 15:59:13"
        },
        "cup": {
            "id": 1,
            "size": "E",
            "status": "Y",
            "note": null,
            "used_type": "short_film",
            "created_at": "2020-03-26 15:59:00",
            "updated_at": "2020-03-26 15:59:00"
        },
        "year": {
            "id": 2,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "short_film",
            "created_at": "2020-03-26 15:58:24",
            "updated_at": "2020-03-26 15:58:24"
        }
    }
}
```

> 刪除短片

```json
{
    "code": "0",
    "data": {
        "id": 1,
        "title": "達克的秘密",
        "alias": null,
        "mosaic_type": "WITH_MOSAIC",
        "region_id": 2,
        "cup_id": 1,
        "year_id": 2,
        "tags": null,
        "description": "我是達克我6",
        "views": 0,  //瀏覽率
        "score": 0,  //評分
        "status": "Y",
        "cover_path": null,
        "cover_url": null,
        "video_path": "giax6RPemNfbneUzpVK2rixmfeFznU3YS4lGoyiC.mp4",
        "video_url": "http://localhost/storage/giax6RPemNfbneUzpVK2rixmfeFznU3YS4lGoyiC.mp4",
        "open_at": null,
        "video_status": null,
        "created_at": "2020-03-26 16:04:18",
        "updated_at": "2020-03-26 16:07:39"
    }
}
```
# 編輯器

> 編輯器圖片上傳

```
{
    "code": "0",
       "data": {
           "image_path": "files/HhX7TUoXalKaEcSsGfhUI5L9d9hMUfSqxJSa5uSM.jpeg",  //圖片位置
           "image_url": "http://localhost/storage/files/HhX7TUoXalKaEcSsGfhUI5L9d9hMUfSqxJSa5uSM.jpeg",  //圖片連結
           "updated_at": "2020-01-10 18:52:58",
           "created_at": "2020-01-10 18:52:58",
           "id": 5
       }
}
```

> 編輯器圖片刪除

```
{
    "data": "1",
      "code": "0"
}
```
