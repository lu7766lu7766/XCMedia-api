# 戲劇管理

> 列表/批次新增

```
{
    "code": "0",
    "data": [
        {
            "id": 2,
            "title": "動漫標題",//名稱
            "alias": "動漫別名",//別名
            "image_path": "anime/image/el5zVUz1RDQFW20nLi2qtEX5w8bpdQIh579pwO07.png",//圖片位置
            "image_url": "http://localhost/storage/anime/image/el5zVUz1RDQFW20nLi2qtEX5w8bpdQIh579pwO07.png",//圖片連結
            "episode_status": "serializing",//集數狀態
            "status": "Y",//狀態
            "starring": "主演A", //主演
            "director": "導演A", //導演
            "region_id": 1,//地區id
            "years_id": 1, //年份id
            "language_id": 1, //語言id
            "description": "動漫描述", //描述
            "views": 0, //瀏覽率
            "score": "5.3", //評分
            "created_at": "2020-02-20 15:36:52",
            "updated_at": "2020-02-20 15:36:52",
            "years": { //年份
                "id": 1,
                "title": "2020", //名稱
                "remark": null, //備註
                "status": "Y", //狀態
                "used_type": "anime",
                "created_at": null,
                "updated_at": null
            },
            "region": {
                "id": 1,
                "name": "中國", //名稱
                "status": "Y", //備註
                "note": null, //狀態
                "used_type": "anime",
                "created_at": null,
                "updated_at": null
            },
            "language": {
                "id": 1,
                "title": "英文", //名稱
                "remark": null, //備註
                "status": "Y", //狀態
                "used_type": "anime",
                "created_at": null,
                "updated_at": null
            },
            "genres": [
                {
                    "id": 1,
                    "title": "動作", //名稱
                    "remark": null, //備註
                    "image_path": null,//圖片位置
                    "image_url": null,//圖片連結
                    "status": "Y", //狀態
                    "used_type": "anime",
                    "created_at": null,
                    "updated_at": null,
                    "pivot": {
                        "genres_used_id": 2,
                        "genres_id": 1,
                        "genres_used_type": "Modules\\Anime\\Entities\\Anime"
                    }
                }
            ],
            "editor_files": [  //編輯器檔案
                {
                    "id": 2,
                    "file_path": "editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png",//檔案位置
                    "file_url": "http://localhost/storage/editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png", //檔案連結
                    "created_at": "2020-02-20 15:36:27",
                    "updated_at": "2020-02-20 15:36:27",
                    "pivot": {
                        "used_id": 2,
                        "editor_file_id": 2,
                        "used_type": "Modules\\Anime\\Entities\\Anime"
                    }
                }
            ]
        }
    ]
}
```

> 總數

```
{
    "data": "1",
    "code": "0"
}
```

> 新增

```
{
    "code": "0",
    "data": {
        "title": "動漫標題",
        "alias": "動漫別名",
        "episode_status": "serializing",
        "status": "Y",
        "starring": "主演A",
        "director": "導演A",
        "description": "動漫描述",
        "views": 0, //瀏覽率
        "score": "5.3", //評分
        "image_path": "anime/image/el5zVUz1RDQFW20nLi2qtEX5w8bpdQIh579pwO07.png",
        "image_url": "http://localhost/storage/anime/image/el5zVUz1RDQFW20nLi2qtEX5w8bpdQIh579pwO07.png",
        "region_id": 1,
        "years_id": 1,
        "language_id": 1,
        "updated_at": "2020-02-20 15:36:52",
        "created_at": "2020-02-20 15:36:52",
        "id": 2,
        "years": {
            "id": 1,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        "region": {
            "id": 1,
            "name": "中國",
            "status": "Y",
            "note": null,
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        "language": {
            "id": 1,
            "title": "英文",
            "remark": null,
            "status": "Y",
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        "genres": [
            {
                "id": 1,
                "title": "動作",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "anime",
                "created_at": null,
                "updated_at": null,
                "pivot": {
                    "genres_used_id": 2,
                    "genres_id": 1,
                    "genres_used_type": "Modules\\Anime\\Entities\\Anime"
                }
            }
        ],
        "editor_files": [
            {
                "id": 2,
                "file_path": "editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png",
                "file_url": "http://localhost/storage/editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png",
                "created_at": "2020-02-20 15:36:27",
                "updated_at": "2020-02-20 15:36:27",
                "pivot": {
                    "used_id": 2,
                    "editor_file_id": 2,
                    "used_type": "Modules\\Anime\\Entities\\Anime"
                }
            }
        ]
    }
}
```

> 編輯頁面資訊

```
{
    "code": "0",
    "data": {
        "id": 2,
        "title": "動漫標題",
        "alias": "動漫別名",
        "image_path": "anime/image/el5zVUz1RDQFW20nLi2qtEX5w8bpdQIh579pwO07.png",
        "image_url": "http://localhost/storage/anime/image/el5zVUz1RDQFW20nLi2qtEX5w8bpdQIh579pwO07.png",
        "episode_status": "serializing",
        "status": "Y",
        "starring": "主演A",
        "director": "導演A",
        "region_id": 1,
        "years_id": 1,
        "language_id": 1,
        "description": "動漫描述",
        "views": 0, //瀏覽率
        "score": "5.3", //評分
        "created_at": "2020-02-20 15:36:52",
        "updated_at": "2020-02-20 15:36:52",
        "years": {
            "id": 1,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        "region": {
            "id": 1,
            "name": "中國",
            "status": "Y",
            "note": null,
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        "language": {
            "id": 1,
            "title": "英文",
            "remark": null,
            "status": "Y",
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        "genres": [
            {
                "id": 1,
                "title": "動作",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "anime",
                "created_at": null,
                "updated_at": null,
                "pivot": {
                    "genres_used_id": 2,
                    "genres_id": 1,
                    "genres_used_type": "Modules\\Anime\\Entities\\Anime"
                }
            }
        ],
        "editor_files": [
            {
                "id": 2,
                "file_path": "editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png",
                "file_url": "http://localhost/storage/editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png",
                "created_at": "2020-02-20 15:36:27",
                "updated_at": "2020-02-20 15:36:27",
                "pivot": {
                    "used_id": 2,
                    "editor_file_id": 2,
                    "used_type": "Modules\\Anime\\Entities\\Anime"
                }
            }
        ]
    }
}
```

> 更新

```
{
    "code": "0",
    "data": {
        "id": 2,
        "title": "動漫標題2",
        "alias": "動漫別名2",
        "image_path": "anime/image/el5zVUz1RDQFW20nLi2qtEX5w8bpdQIh579pwO07.png",
        "image_url": "http://localhost/storage/anime/image/el5zVUz1RDQFW20nLi2qtEX5w8bpdQIh579pwO07.png",
        "episode_status": "end",
        "status": "Y",
        "starring": "主演A2",
        "director": "導演A2",
        "region_id": 2,
        "years_id": 2,
        "language_id": 2,
        "description": "動漫描述2",
        "views": 0, //瀏覽率
        "score": "5.3", //評分
        "created_at": "2020-02-20 15:36:52",
        "updated_at": "2020-02-20 15:48:07",
        "years": {
            "id": 2,
            "title": "2019",
            "remark": null,
            "status": "Y",
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        "region": {
            "id": 2,
            "name": "日本",
            "status": "Y",
            "note": null,
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        "language": {
            "id": 2,
            "title": "中文",
            "remark": null,
            "status": "Y",
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        "genres": [
            {
                "id": 1,
                "title": "動作",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "anime",
                "created_at": null,
                "updated_at": null,
                "pivot": {
                    "genres_used_id": 2,
                    "genres_id": 1,
                    "genres_used_type": "Modules\\Anime\\Entities\\Anime"
                }
            }
        ],
        "editor_files": [
            {
                "id": 2,
                "file_path": "editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png",
                "file_url": "http://localhost/storage/editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png",
                "created_at": "2020-02-20 15:36:27",
                "updated_at": "2020-02-20 15:36:27",
                "pivot": {
                    "used_id": 2,
                    "editor_file_id": 2,
                    "used_type": "Modules\\Anime\\Entities\\Anime"
                }
            }
        ]
    }
}
```

> 刪除

```
{
    "code": "0",
    "data": {
        "id": 1,
        "title": "動漫標題",
        "alias": "動漫別名",
        "image_path": "anime/image/nR21gW3Wzx0uK3K8Z2KjYHa4wmxppi6aGLFJP2cz.png",
        "image_url": "http://localhost/storage/anime/image/nR21gW3Wzx0uK3K8Z2KjYHa4wmxppi6aGLFJP2cz.png",
        "episode_status": "serializing",
        "status": "Y",
        "starring": "主演A",
        "director": "導演A",
        "region_id": 1,
        "years_id": 1,
        "language_id": 1,
        "description": "動漫描述",
        "views": 0, //瀏覽率
        "score": "5.3", //評分
        "created_at": "2020-02-20 15:35:47",
        "updated_at": "2020-02-20 15:35:47"
    }
}
```
> 編輯器圖片上傳

```
{
    "code": "0",
    "data": {
        "file_path": "editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png",
        "file_url": "http://localhost/storage/editor_files/z7I1G7pmDDmpJQUVgTKnKbzvPPuMKBu30tPxaEp7.png",
        "updated_at": "2020-02-20 15:36:27",
        "created_at": "2020-02-20 15:36:27",
        "id": 2
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

# 集數設定

> 列表/新增/編輯/更新

```
{
    "code": "0",
    "data": [
        {
            "id": 5,
            "title": "動漫集數1",//名稱
            "opening_time": "2020-01-01 00:00:02", //開放時間
            "status": "Y", //狀態
            "views": 0, //瀏覽次數
            "media_id": "2",  // 影音id
            "media_type": "Modules\\Anime\\Entities\\Anime",//影音類型
            "created_at": "2020-02-20 16:26:34",
            "updated_at": "2020-02-20 16:26:34",
            "sources": [ //來源
                {
                    "id": 1,
                    "title": "來源A",//名稱
                    "remark": null, //備註
                    "status": "Y", //狀態
                    "used_type": "anime",
                    "created_at": null,
                    "updated_at": null,
                    "sources_url": { //來源連結
                        "episode_id": 5,
                        "source_id": 1,
                        "url": "http://google.com"//連結
                    }
                }
            ]
        }
    ]
}
```

> 總數/刪除

```
{
    "data": "1",
    "code": "0"
}
```

# 設定選項

> 取得集數狀態
```
{
     "code": "0",
        "data": [
            "serializing",  //連載中
            "end"  //完結
        ]
}
```

> 取得地區
```
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "name": "中國",
            "status": "Y",
            "note": null,
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 2,
            "name": "日本",
            "status": "Y",
            "note": null,
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        }
    ]
}
```

> 取得年份/語言/來源
```
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 2,
            "title": "2019",
            "remark": null,
            "status": "Y",
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        }
    ]
}
```

> 取得類型
```
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "title": "動作",
            "remark": null,
            "image_path": null,
            "image_url": null,
            "status": "Y",
            "used_type": "anime",
            "created_at": null,
            "updated_at": null
        }
    ]
}
```
