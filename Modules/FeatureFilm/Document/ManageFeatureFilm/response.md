# 成人長片管理

> 新增

```json
{
    "code": "0",
    "data": {
        "title": "達克的秘密3",
        "alias": null,
        "mosaic_type": "WITH_MOSAIC",
        "tags": null,
        "views": 0,  //瀏覽率
        "score": 0,  //評分
        "description": null,
        "status": "Y",
        "open_at": null,
        "video_path": "pZ005JArTxsCCrRP9myjxZCfbTRHNHirtsadGbqN.mp4",
        "video_url": "http://localhost/storage/pZ005JArTxsCCrRP9myjxZCfbTRHNHirtsadGbqN.mp4",
        "region_id": 2,
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
            "used_type": "feature_film",
            "created_at": "2020-03-26 15:59:13",
            "updated_at": "2020-03-26 15:59:13"
        },
        "cup": {
            "id": 1,
            "size": "E",
            "status": "Y",
            "note": null,
            "used_type": "feature_film",
            "created_at": "2020-03-26 15:59:00",
            "updated_at": "2020-03-26 15:59:00"
        },
        "year": {
            "id": 2,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "feature_film",
            "created_at": "2020-03-26 15:58:24",
            "updated_at": "2020-03-26 15:58:24"
        }
    }
}
```

> 總數

```json
{
    "data": "0",
    "code": "0"
}
```

> 列表

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
            "views": 0,  //瀏覽率
            "score": 0,  //評分
            "description": null,
            "status": "Y",
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
                "used_type": "feature_film",
                "created_at": "2020-03-26 15:59:13",
                "updated_at": "2020-03-26 15:59:13"
            },
            "year": {
                "id": 2,
                "title": "2020",
                "remark": null,
                "status": "Y",
                "used_type": "feature_film",
                "created_at": "2020-03-26 15:58:24",
                "updated_at": "2020-03-26 15:58:24"
            },
            "cup": {
                "id": 1,
                "size": "E",
                "status": "Y",
                "note": null,
                "used_type": "feature_film",
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
                    "used_type": "feature_film",
                    "created_at": "2020-03-26 15:58:41",
                    "updated_at": "2020-03-26 15:58:41",
                    "pivot": {
                        "av_actress_used_id": 1,
                        "av_actress_id": 2,
                        "av_actress_used_type": "Modules\\FeatureFilm\\Entities\\FeatureFilm"
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
                    "used_type": "feature_film",
                    "created_at": "2020-03-26 15:58:32",
                    "updated_at": "2020-03-26 15:58:32",
                    "pivot": {
                        "av_actress_used_id": 1,
                        "av_actress_id": 1,
                        "av_actress_used_type": "Modules\\FeatureFilm\\Entities\\FeatureFilm"
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
                    "used_type": "feature_film",
                    "created_at": "2020-03-26 15:58:48",
                    "updated_at": "2020-03-26 15:58:48",
                    "pivot": {
                        "av_actress_used_id": 1,
                        "av_actress_id": 3,
                        "av_actress_used_type": "Modules\\FeatureFilm\\Entities\\FeatureFilm"
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
                    "used_type": "feature_film",
                    "created_at": "2020-03-26 15:59:05",
                    "updated_at": "2020-03-26 15:59:05",
                    "pivot": {
                        "genres_used_id": 1,
                        "genres_id": 3,
                        "genres_used_type": "Modules\\FeatureFilm\\Entities\\FeatureFilm"
                    }
                }
            ],
            "editor_files": []
        }
    ]
}
```

> 編輯

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
        "created_at": "2020-03-26 16:04:18",
        "updated_at": "2020-03-26 16:07:39",
        "region": {
            "id": 2,
            "name": "臺灣",
            "status": "Y",
            "note": null,
            "used_type": "feature_film",
            "created_at": "2020-03-26 15:59:13",
            "updated_at": "2020-03-26 15:59:13"
        },
        "cup": {
            "id": 1,
            "size": "E",
            "status": "Y",
            "note": null,
            "used_type": "feature_film",
            "created_at": "2020-03-26 15:59:00",
            "updated_at": "2020-03-26 15:59:00"
        },
        "year": {
            "id": 2,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "feature_film",
            "created_at": "2020-03-26 15:58:24",
            "updated_at": "2020-03-26 15:58:24"
        }
    }
}
```

> 刪除

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
        "created_at": "2020-03-26 16:04:18",
        "updated_at": "2020-03-26 16:07:39"
    }
}
```

```todo 長片-影片管理沒有response嗎
