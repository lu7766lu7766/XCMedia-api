# 說書管理

> 列表

```
{
    "code": "0",
    "data": [
        {
            "id": 2,
            "title": "說書說書",//名稱
            "cover_path": "storytelling/cover/VpPXILWkw8wxmGNVjHNPyfBrbOgqwmwnLsc5OgQH.png",//封面位置
            "cover_url": "http://localhost/storage/storytelling/cover/VpPXILWkw8wxmGNVjHNPyfBrbOgqwmwnLsc5OgQH.png",//封面url
            "alias": "說書aaaa",//別名
            "region_id": 3,//地區id
            "years_id": 3,//年分id
            "tags": [//標籤
                "ggg"
            ],
            "description": "66666666666666",//描述
            "status": "Y",//狀態
            "views": 0,//觀看次數
            "score": 5.3//評分
            "created_at": "2020-03-13 15:23:07",
            "updated_at": "2020-03-13 15:23:07",
            "years": {//年分
                "id": 3,
                "title": "2020",
                "remark": null,
                "status": "Y",
                "used_type": "storytelling",
                "created_at": null,
                "updated_at": null
            },
            "region": {//地區
                "id": 3,
                "name": "台灣",
                "status": "Y",
                "note": null,
                "used_type": "storytelling",
                "created_at": null,
                "updated_at": null
            },
            "genres": [//類型
                {
                    "id": 3,
                    "title": "成人",//名稱
                    "remark": null,//備註
                    "image_path": null,
                    "image_url": null,
                    "status": "Y",
                    "used_type": "storytelling",
                    "created_at": null,
                    "updated_at": null,
                    "pivot": {
                        "genres_used_id": 2,
                        "genres_id": 3,
                        "genres_used_type": "Modules\\Storytelling\\Entities\\Storytelling"
                    }
                }
            ],
            "editor_files": [//編輯器檔案
                {
                    "id": 3,
                    "file_path": "editor_files/tRZbwhgE1xSF0th0Hm99mbRuJ7ZV79wVXUVmSg5K.png",
                    "file_url": "http://localhost/storage/editor_files/tRZbwhgE1xSF0th0Hm99mbRuJ7ZV79wVXUVmSg5K.png",
                    "created_at": "2020-03-12 11:42:25",
                    "updated_at": "2020-03-12 11:42:25",
                    "pivot": {
                        "used_id": 2,
                        "editor_file_id": 3,
                        "used_type": "Modules\\Storytelling\\Entities\\Storytelling"
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
        "title": "說書說書",
        "alias": "說書aaaa",
        "status": "Y",
        "description": "66666666666666",
        "tags": [
            "ggg"
        ],
        "cover_path": "storytelling/cover/VpPXILWkw8wxmGNVjHNPyfBrbOgqwmwnLsc5OgQH.png",
        "cover_url": "http://localhost/storage/storytelling/cover/VpPXILWkw8wxmGNVjHNPyfBrbOgqwmwnLsc5OgQH.png",
        "region_id": 3,
        "years_id": 3,
        "views": 0,//觀看次數
        "score": 5.3//評分
        "updated_at": "2020-03-13 15:23:07",
        "created_at": "2020-03-13 15:23:07",
        "id": 2,
        "years": {
            "id": 3,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "storytelling",
            "created_at": null,
            "updated_at": null
        },
        "region": {
            "id": 3,
            "name": "台灣",
            "status": "Y",
            "note": null,
            "used_type": "storytelling",
            "created_at": null,
            "updated_at": null
        },
        "genres": [
            {
                "id": 3,
                "title": "成人",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "storytelling",
                "created_at": null,
                "updated_at": null,
                "pivot": {
                    "genres_used_id": 2,
                    "genres_id": 3,
                    "genres_used_type": "Modules\\Storytelling\\Entities\\Storytelling"
                }
            }
        ],
        "editor_files": [
            {
                "id": 3,
                "file_path": "editor_files/tRZbwhgE1xSF0th0Hm99mbRuJ7ZV79wVXUVmSg5K.png",
                "file_url": "http://localhost/storage/editor_files/tRZbwhgE1xSF0th0Hm99mbRuJ7ZV79wVXUVmSg5K.png",
                "created_at": "2020-03-12 11:42:25",
                "updated_at": "2020-03-12 11:42:25",
                "pivot": {
                    "used_id": 2,
                    "editor_file_id": 3,
                    "used_type": "Modules\\Storytelling\\Entities\\Storytelling"
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
        "id": 1,
        "title": "說書說書",
        "cover_path": "storytelling/cover/6xcO7mQZa9Ypgv68h0ymVTG6BRvIId1JbDRFCuT6.png",
        "cover_url": "http://localhost/storage/storytelling/cover/6xcO7mQZa9Ypgv68h0ymVTG6BRvIId1JbDRFCuT6.png",
        "alias": "說書aaaa",
        "region_id": 3,
        "years_id": 3,
        "tags": [
            "ggg"
        ],
        "description": "66666666666666",
        "status": "Y",
        "views": 0,//觀看次數
        "score": 5.3//評分
        "created_at": "2020-03-13 12:08:30",
        "updated_at": "2020-03-13 12:08:30",
        "years": {
            "id": 3,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "storytelling",
            "created_at": null,
            "updated_at": null
        },
        "region": {
            "id": 3,
            "name": "台灣",
            "status": "Y",
            "note": null,
            "used_type": "storytelling",
            "created_at": null,
            "updated_at": null
        },
        "genres": [
            {
                "id": 3,
                "title": "成人",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "storytelling",
                "created_at": null,
                "updated_at": null,
                "pivot": {
                    "genres_used_id": 1,
                    "genres_id": 3,
                    "genres_used_type": "Modules\\Storytelling\\Entities\\Storytelling"
                }
            }
        ],
        "editor_files": [
            {
                "id": 3,
                "file_path": "editor_files/tRZbwhgE1xSF0th0Hm99mbRuJ7ZV79wVXUVmSg5K.png",
                "file_url": "http://localhost/storage/editor_files/tRZbwhgE1xSF0th0Hm99mbRuJ7ZV79wVXUVmSg5K.png",
                "created_at": "2020-03-12 11:42:25",
                "updated_at": "2020-03-12 11:42:25",
                "pivot": {
                    "used_id": 1,
                    "editor_file_id": 3,
                    "used_type": "Modules\\Storytelling\\Entities\\Storytelling"
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
        "id": 1,
        "title": "說書update",
        "cover_path": "storytelling/cover/EyMMdASJvkbLePdKdRLYCPbaTghrtj7M3yYlEXPl.png",
        "cover_url": "http://localhost/storage/storytelling/cover/EyMMdASJvkbLePdKdRLYCPbaTghrtj7M3yYlEXPl.png",
        "alias": "22222",
        "region_id": 4,
        "years_id": 4,
        "tags": [
            "a1",
            "a2"
        ],
        "description": "555555",
        "status": "N",
        "views": 0,//觀看次數
        "score": 5.3//評分
        "created_at": "2020-03-13 12:08:30",
        "updated_at": "2020-03-13 15:49:55",
        "years": {
            "id": 4,
            "title": "2222",
            "remark": null,
            "status": "Y",
            "used_type": "storytelling",
            "created_at": null,
            "updated_at": null
        },
        "region": {
            "id": 4,
            "name": "TW",
            "status": "Y",
            "note": null,
            "used_type": "storytelling",
            "created_at": null,
            "updated_at": null
        },
        "genres": [
            {
                "id": 4,
                "title": "test",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "storytelling",
                "created_at": null,
                "updated_at": null,
                "pivot": {
                    "genres_used_id": 1,
                    "genres_id": 4,
                    "genres_used_type": "Modules\\Storytelling\\Entities\\Storytelling"
                }
            }
        ],
        "editor_files": [
            {
                "id": 3,
                "file_path": "editor_files/tRZbwhgE1xSF0th0Hm99mbRuJ7ZV79wVXUVmSg5K.png",
                "file_url": "http://localhost/storage/editor_files/tRZbwhgE1xSF0th0Hm99mbRuJ7ZV79wVXUVmSg5K.png",
                "created_at": "2020-03-12 11:42:25",
                "updated_at": "2020-03-12 11:42:25",
                "pivot": {
                    "used_id": 1,
                    "editor_file_id": 3,
                    "used_type": "Modules\\Storytelling\\Entities\\Storytelling"
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
        "id": 2,
        "title": "說書說書",
        "cover_path": "storytelling/cover/VpPXILWkw8wxmGNVjHNPyfBrbOgqwmwnLsc5OgQH.png",
        "cover_url": "http://localhost/storage/storytelling/cover/VpPXILWkw8wxmGNVjHNPyfBrbOgqwmwnLsc5OgQH.png",
        "alias": "說書aaaa",
        "region_id": 3,
        "years_id": 3,
        "tags": [
            "ggg"
        ],
        "description": "66666666666666",
        "status": "Y",
        "views": 0,//觀看次數
        "score": 5.3//評分
        "created_at": "2020-03-13 15:23:07",
        "updated_at": "2020-03-13 15:23:07"
    }
}
```
> 編輯器圖片上傳

```
{
    "code": "0",
    "data": {
        "file_path": "editor_files/5X1cCOcgKM1sX9FOdcmXYLCIOQVvmwRzGwstuTZ8.png",
        "file_url": "http://localhost/storage/editor_files/5X1cCOcgKM1sX9FOdcmXYLCIOQVvmwRzGwstuTZ8.png",
        "updated_at": "2020-03-13 15:57:46",
        "created_at": "2020-03-13 15:57:46",
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

# 語音設定
> 列表

```
{
    "code": "0",
    "data": [
        {
            "id": 3,//語音id
            "original_file_name": "sample.mp3",//原始檔名
            "file_path": "storytelling/audio/1vr7rVAtRHLQ6ddnu58LZLMiKZOfeuKvAUcN8oNC.mpga",//音檔位置
            "file_url": "http://localhost/storage/storytelling/audio/1vr7rVAtRHLQ6ddnu58LZLMiKZOfeuKvAUcN8oNC.mpga",//音檔url
            "storytelling_id": 1,//說書id
            "created_at": "2020-03-13 14:42:26",
            "updated_at": "2020-03-13 14:42:26"
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
        "original_file_name": "sample.mp3",
        "file_path": "storytelling/audio/5N9e6237RBRwnr4b28D55mPH8JE8Z1AntFzRJ8px.mpga",
        "file_url": "http://localhost/storage/storytelling/audio/5N9e6237RBRwnr4b28D55mPH8JE8Z1AntFzRJ8px.mpga",
        "storytelling_id": 1,
        "updated_at": "2020-03-13 16:02:30",
        "created_at": "2020-03-13 16:02:30",
        "id": 5
    }
}
```


> 刪除

```
{
    "code": "0",
    "data": {
        "id": 5,
        "original_file_name": "sample.mp3",
        "file_path": "storytelling/audio/5N9e6237RBRwnr4b28D55mPH8JE8Z1AntFzRJ8px.mpga",
        "file_url": "http://localhost/storage/storytelling/audio/5N9e6237RBRwnr4b28D55mPH8JE8Z1AntFzRJ8px.mpga",
        "storytelling_id": 1,
        "created_at": "2020-03-13 16:02:30",
        "updated_at": "2020-03-13 16:02:30"
    }
}
```

# 設定選項


> 取得地區
```
{
     "code": "0",
        "data": [
            {
                "id": 3,
                "name": "台灣",
                "status": "Y",
                "note": null,
                "used_type": "storytelling",
                "created_at": null,
                "updated_at": null
            }
        ]
}
```

> 取得年份
```
{
     "code": "0",
        "data": [
            {
                "id": 3,
                "title": "2020",
                "remark": null,
                "status": "Y",
                "used_type": "storytelling",
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
                "id": 3,
                "title": "成人",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "storytelling",
                "created_at": null,
                "updated_at": null
            }
        ]
}
```
