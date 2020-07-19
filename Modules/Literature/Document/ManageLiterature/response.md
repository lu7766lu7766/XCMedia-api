> 列表

```json
{
    "code": "0",
    "data": [
        {
            "id": 2,
            "cover_url": null,
            "cover_path": null,
            "title": "杰哥不要~~停",
            "region_id": 1,
            "year_id": 1,
            "views": 100,
            "score": 5.6,
            "status": "Y",
            "tags": null,
            "description": null,
            "alias": null,
            "created_at": "2020-03-26 14:21:29",
            "updated_at": "2020-03-26 14:21:29",
            "genres": [
                {
                    "id": 1,
                    "title": "動作",
                    "remark": null,
                    "image_path": null,
                    "image_url": null,
                    "status": "Y",
                    "used_type": "literature",
                    "created_at": "2020-03-26 14:19:43",
                    "updated_at": "2020-03-26 14:19:43",
                    "pivot": {
                        "genres_used_id": 2,
                        "genres_id": 1,
                        "genres_used_type": "Modules\\Literature\\Entities\\Literature"
                    }
                },
                {
                    "id": 2,
                    "title": "科幻",
                    "remark": null,
                    "image_path": null,
                    "image_url": null,
                    "status": "Y",
                    "used_type": "literature",
                    "created_at": "2020-03-26 14:20:57",
                    "updated_at": "2020-03-26 14:20:57",
                    "pivot": {
                        "genres_used_id": 2,
                        "genres_id": 2,
                        "genres_used_type": "Modules\\Literature\\Entities\\Literature"
                    }
                }
            ],
            "year": {
                "id": 1,
                "title": "2020",
                "remark": null,
                "status": "Y",
                "used_type": "literature",
                "created_at": "2020-03-26 14:19:35",
                "updated_at": "2020-03-26 14:19:35"
            },
            "editor_files": []
        },
        {
            "id": 1,
            "cover_url": "literature/cover//vvtZsNV6UaRyZ2F1RyJH2zq1VJ5PEnZps4ZltVwP.png",
            "cover_path": "http://localhost/storage/literature/cover//vvtZsNV6UaRyZ2F1RyJH2zq1VJ5PEnZps4ZltVwP.png",
            "title": "小敏老師的課後輔導",
            "region_id": 1,
            "year_id": 1,
            "views": 100,
            "score": 5.6,
            "status": "Y",
            "tags": null,
            "description": null,
            "alias": null,
            "created_at": "2020-03-26 14:20:01",
            "updated_at": "2020-03-26 14:20:01",
            "genres": [
                {
                    "id": 1,
                    "title": "動作",
                    "remark": null,
                    "image_path": null,
                    "image_url": null,
                    "status": "Y",
                    "used_type": "literature",
                    "created_at": "2020-03-26 14:19:43",
                    "updated_at": "2020-03-26 14:19:43",
                    "pivot": {
                        "genres_used_id": 1,
                        "genres_id": 1,
                        "genres_used_type": "Modules\\Literature\\Entities\\Literature"
                    }
                }
            ],
            "year": {
                "id": 1,
                "title": "2020",
                "remark": null,
                "status": "Y",
                "used_type": "literature",
                "created_at": "2020-03-26 14:19:35",
                "updated_at": "2020-03-26 14:19:35"
            },
            "editor_files": [
                {
                    "id": 1,
                    "file_path": "editor_files/DtY3T9Aj6rKxZCBuWqanfzHKqMuIubjf71iDRJQw.jpeg",
                    "file_url": "http://localhost/storage/editor_files/DtY3T9Aj6rKxZCBuWqanfzHKqMuIubjf71iDRJQw.jpeg",
                    "created_at": "2020-03-25 19:24:52",
                    "updated_at": "2020-03-25 19:24:52",
                    "pivot": {
                        "used_id": 1,
                        "editor_file_id": 1,
                        "used_type": "Modules\\Literature\\Entities\\Literature"
                    }
                }
            ]
        }
    ]
}
```

> 新增

```json
{
    "code": "0",
    "data": {
        "title": "杰哥不要~~停",
        "status": "Y",
        "alias": null,
        "tags": null,
        "description": null,
        "year_id": 1,
        "views": 100,
        "score": 5.6,
        "region_id": 1,
        "updated_at": "2020-03-26 14:21:29",
        "created_at": "2020-03-26 14:21:29",
        "id": 2,
        "year": {
            "id": 1,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "literature",
            "created_at": "2020-03-26 14:19:35",
            "updated_at": "2020-03-26 14:19:35"
        },
        "region": {
            "id": 1,
            "name": "台灣",
            "status": "Y",
            "note": "SWAG讚",
            "used_type": "literature",
            "created_at": "2020-03-26 14:19:30",
            "updated_at": "2020-03-26 14:19:30"
        },
        "genres": [
            {
                "id": 1,
                "title": "動作",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "literature",
                "created_at": "2020-03-26 14:19:43",
                "updated_at": "2020-03-26 14:19:43",
                "pivot": {
                    "genres_used_id": 2,
                    "genres_id": 1,
                    "genres_used_type": "Modules\\Literature\\Entities\\Literature"
                }
            },
            {
                "id": 2,
                "title": "科幻",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "literature",
                "created_at": "2020-03-26 14:20:57",
                "updated_at": "2020-03-26 14:20:57",
                "pivot": {
                    "genres_used_id": 2,
                    "genres_id": 2,
                    "genres_used_type": "Modules\\Literature\\Entities\\Literature"
                }
            }
        ],
        "editor_files": []
    }
}
```

> 編輯

```json
{
    "code": "0",
    "data": {
        "id": 2,
        "cover_url": null,
        "cover_path": null,
        "title": "杰哥不要~~停",
        "region_id": 1,
        "year_id": 1,
        "views": 100,
        "score": 5.6,
        "status": "Y",
        "tags": "杰哥,不要,不要停",
        "description": "請勇敢說不!",
        "alias": null,
        "created_at": "2020-03-26 14:21:29",
        "updated_at": "2020-03-26 14:31:37",
        "year": {
            "id": 1,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "literature",
            "created_at": "2020-03-26 14:19:35",
            "updated_at": "2020-03-26 14:19:35"
        },
        "region": {
            "id": 1,
            "name": "台灣",
            "status": "Y",
            "note": "SWAG讚",
            "used_type": "literature",
            "created_at": "2020-03-26 14:19:30",
            "updated_at": "2020-03-26 14:19:30"
        },
        "genres": [
            {
                "id": 1,
                "title": "動作",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "literature",
                "created_at": "2020-03-26 14:19:43",
                "updated_at": "2020-03-26 14:19:43",
                "pivot": {
                    "genres_used_id": 2,
                    "genres_id": 1,
                    "genres_used_type": "Modules\\Literature\\Entities\\Literature"
                }
            }
        ],
        "editor_files": []
    }
}
```

> 刪除

```json
{
    "code": "0",
    "data": {
        "id": 1,
        "cover_url": "literature/cover//vvtZsNV6UaRyZ2F1RyJH2zq1VJ5PEnZps4ZltVwP.png",
        "cover_path": "http://localhost/storage/literature/cover//vvtZsNV6UaRyZ2F1RyJH2zq1VJ5PEnZps4ZltVwP.png",
        "title": "小敏老師的課後輔導",
        "region_id": 1,
        "year_id": 1,
        "views": 100,
        "score": 5.6,
        "status": "Y",
        "tags": null,
        "description": null,
        "alias": null,
        "created_at": "2020-03-26 14:20:01",
        "updated_at": "2020-03-26 14:20:01"
    }
}
```

> 總數

```json
{
    "data": "1",
    "code": "0"
}
```

> 集數/新增

```json
{
    "code": "0",
    "data": {
        "title": "1. 強人鎖男",
        "open_at": "2020-03-10 00:00:00",
        "content": "有天小明走在路上 然後就被杰哥強人鎖男了",
        "status": "Y",
        "literature_id": 2,
        "updated_at": "2020-03-26 15:01:06",
        "created_at": "2020-03-26 15:01:06",
        "id": 1
    }
}
```

> 集數/總數

```json
{
    "data": "1",
    "code": "0"
}
```

> 集數/列表

```json
{
    "code": "0",
    "data": [
        {
            "id": 5,
            "title": "5. 男男自娛",
            "open_at": "2020-03-10 00:00:00",
            "views": 0,
            "status": "Y",
            "literature_id": 2,
            "content": "結果杰哥決意離開小明!!\n小明與阿力現在只得男男自娛",
            "created_at": "2020-03-26 15:06:32",
            "updated_at": "2020-03-26 15:06:32",
            "literature": {
                "id": 2,
                "cover_url": null,
                "cover_path": null,
                "title": "杰哥不要~~停",
                "region_id": 1,
                "year_id": 1,
                "views": 0,
                "status": "Y",
                "tags": "杰哥,不要,不要停",
                "description": "請勇敢說不!",
                "alias": null,
                "created_at": "2020-03-26 14:21:29",
                "updated_at": "2020-03-26 14:31:37"
            }
        },
        {
            "id": 4,
            "title": "4. 男分男捨",
            "open_at": "2020-03-10 00:00:00",
            "views": 0,
            "status": "Y",
            "literature_id": 2,
            "content": "唉 小明左擁杰哥 右摟阿力 男分男捨啊!",
            "created_at": "2020-03-26 15:05:34",
            "updated_at": "2020-03-26 15:05:34",
            "literature": {
                "id": 2,
                "cover_url": null,
                "cover_path": null,
                "title": "杰哥不要~~停",
                "region_id": 1,
                "year_id": 1,
                "views": 0,
                "status": "Y",
                "tags": "杰哥,不要,不要停",
                "description": "請勇敢說不!",
                "alias": null,
                "created_at": "2020-03-26 14:21:29",
                "updated_at": "2020-03-26 14:31:37"
            }
        },
        {
            "id": 3,
            "title": "3. 左右為男",
            "open_at": "2020-03-10 00:00:00",
            "views": 0,
            "status": "Y",
            "literature_id": 2,
            "content": "原本以為小明與杰哥就此過著快樂小日子 沒想到就在某一天出現了阿力! 怎麼辦!! 小明現在左右為男!",
            "created_at": "2020-03-26 15:04:40",
            "updated_at": "2020-03-26 15:04:40",
            "literature": {
                "id": 2,
                "cover_url": null,
                "cover_path": null,
                "title": "杰哥不要~~停",
                "region_id": 1,
                "year_id": 1,
                "views": 0,
                "status": "Y",
                "tags": "杰哥,不要,不要停",
                "description": "請勇敢說不!",
                "alias": null,
                "created_at": "2020-03-26 14:21:29",
                "updated_at": "2020-03-26 14:31:37"
            }
        },
        {
            "id": 2,
            "title": "2. 男上加男",
            "open_at": "2020-03-10 00:00:00",
            "views": 0,
            "status": "Y",
            "literature_id": 2,
            "content": "於是小明與杰哥 就一起男上加男",
            "created_at": "2020-03-26 15:03:04",
            "updated_at": "2020-03-26 15:03:04",
            "literature": {
                "id": 2,
                "cover_url": null,
                "cover_path": null,
                "title": "杰哥不要~~停",
                "region_id": 1,
                "year_id": 1,
                "views": 0,
                "status": "Y",
                "tags": "杰哥,不要,不要停",
                "description": "請勇敢說不!",
                "alias": null,
                "created_at": "2020-03-26 14:21:29",
                "updated_at": "2020-03-26 14:31:37"
            }
        },
        {
            "id": 1,
            "title": "1. 強人鎖男",
            "open_at": "2020-03-10 00:00:00",
            "views": 0,
            "status": "Y",
            "literature_id": 2,
            "content": "有天小明走在路上 然後就被杰哥強人鎖男了",
            "created_at": "2020-03-26 15:01:06",
            "updated_at": "2020-03-26 15:01:06",
            "literature": {
                "id": 2,
                "cover_url": null,
                "cover_path": null,
                "title": "杰哥不要~~停",
                "region_id": 1,
                "year_id": 1,
                "views": 0,
                "status": "Y",
                "tags": "杰哥,不要,不要停",
                "description": "請勇敢說不!",
                "alias": null,
                "created_at": "2020-03-26 14:21:29",
                "updated_at": "2020-03-26 14:31:37"
            }
        }
    ]
}
```

> 集數/編輯

```json
{
    "code": "0",
    "data": {
        "id": 2,
        "title": "1. 強人鎖男",
        "open_at": "2020-03-26 12:00:00",
        "views": 0,
        "status": "Y",
        "literature_id": 2,
        "content": "有天小明走在路上 然後就被杰哥強人鎖男了",
        "created_at": "2020-03-26 15:03:04",
        "updated_at": "2020-03-26 15:26:03"
    }
}
```

> 集數/刪除

```json
{
    "code": "0",
    "data": {
        "id": 6,
        "title": "6. 終效男鹿",
        "open_at": "2020-03-10 00:00:00",
        "views": 0,
        "status": "Y",
        "literature_id": 2,
        "content": "一條路 直直撞",
        "created_at": "2020-03-26 15:27:37",
        "updated_at": "2020-03-26 15:27:37"
    }
}
```

## 設定選項

> 取得可用地區
```json
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "name": "台灣",
            "status": "Y",
            "note": "SWAG讚",
            "used_type": "literature",
            "created_at": "2020-03-26 14:19:30",
            "updated_at": "2020-03-26 14:19:30"
        }
    ]
}
```

> 取得可用類型
```json
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
            "used_type": "literature",
            "created_at": "2020-03-26 14:19:43",
            "updated_at": "2020-03-26 14:19:43"
        }
    ]
}
```

> 取得可用年份
```json
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "title": "2020",
            "remark": null,
            "status": "Y",
            "used_type": "literature",
            "created_at": "2020-03-26 14:19:35",
            "updated_at": "2020-03-26 14:19:35"
        }
    ]
}
```
