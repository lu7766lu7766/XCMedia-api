# 類型設定

> 列表

```
{
    "code": "0",
        "data": [
            {
                "id": 15,
                "title": "qwe123123",  //名稱
                "alias": "qqwe",  //別名
                "image_path": null,  //圖片位置
                "image_url": null,  //圖片路徑
                "episode_status": "end",  //劇集狀態
                "status": "Y",  //狀態
                "host": "123,456,789",  //主持
                "guest": "qwe,dsa,as",  //來賓
                "region_id": 1,  //地區id
                "years_id": 4,  //年份id
                "language_id": 3, //語言id
                "description": "6666789",  //描述
                "views": 0,  //觀看數
                "created_at": "2020-02-15 15:43:48",
                "updated_at": "2020-02-15 15:43:48",
                "episodes_count": 0  //集數
            }
        ]
}
```

# 客戶端

> 排行榜列表


```
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "title": "test",
            "alias": "test",
            "image_path": "test",
            "image_url": null,
            "episode_status": "serializing",
            "status": "Y",
            "host": null,
            "guest": null,
            "region_id": 16,
            "years_id": 1,
            "language_id": 1,
            "description": null,
            "views": 0,
            "created_at": null,
            "updated_at": null
        }
    ]
}
```

# 綜藝前台入口

> 最新发佈列表

```
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "title": "綜藝測試",
            "alias": "綜藝別名",
            "image_path": "8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
            "image_url": "http://localhost/storage/8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
            "episode_status": "serializing",
            "status": "Y",
            "host": null,
            "guest": null,
            "region_id": 5,
            "years_id": 6,
            "language_id": 3,
            "description": null,
            "views": 0,
            "created_at": "2020-03-16 16:23:35",
            "updated_at": "2020-03-16 16:23:35",
            "episodes": [
                {
                    "id": 7,
                    "title": "綜藝集數1",
                    "opening_time": "2020-01-01 00:00:02",
                    "status": "Y",
                    "views": 0,
                    "media_id": "1",
                    "media_type": "variety",
                    "created_at": "2020-03-17 11:33:09",
                    "updated_at": "2020-03-17 11:33:09"
                },
                {
                    "id": 8,
                    "title": "綜藝集數1",
                    "opening_time": "2020-03-03 00:00:02",
                    "status": "Y",
                    "views": 0,
                    "media_id": "1",
                    "media_type": "variety",
                    "created_at": "2020-03-17 13:39:46",
                    "updated_at": "2020-03-17 13:39:46"
                }
            ]
        }
    ]
}
```
> 最具人气列表

```
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "title": "綜藝測試",
            "alias": "綜藝別名",
            "image_path": "8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
            "image_url": "http://localhost/storage/8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
            "episode_status": "serializing",
            "status": "Y",
            "host": null,
            "guest": null,
            "region_id": 5,
            "years_id": 6,
            "language_id": 3,
            "description": null,
            "views": 0,
            "created_at": "2020-03-16 16:23:35",
            "updated_at": "2020-03-16 16:23:35",
            "episodes": [
                {
                    "id": 7,
                    "title": "綜藝集數1",
                    "opening_time": "2020-01-01 00:00:02",
                    "status": "Y",
                    "views": 0,
                    "media_id": "1",
                    "media_type": "variety",
                    "created_at": "2020-03-17 11:33:09",
                    "updated_at": "2020-03-17 11:33:09"
                },
                {
                    "id": 8,
                    "title": "綜藝集數1",
                    "opening_time": "2020-03-03 00:00:02",
                    "status": "Y",
                    "views": 0,
                    "media_id": "1",
                    "media_type": "variety",
                    "created_at": "2020-03-17 13:39:46",
                    "updated_at": "2020-03-17 13:39:46"
                }
            ]
        }
    ]
}
```

> 最多评论列表

```
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "title": "綜藝測試",
            "alias": "綜藝別名",
            "image_path": "8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
            "image_url": "http://localhost/storage/8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
            "episode_status": "serializing",
            "status": "Y",
            "host": null,
            "guest": null,
            "region_id": 5,
            "years_id": 6,
            "language_id": 3,
            "description": null,
            "views": 0,
            "created_at": "2020-03-16 16:23:35",
            "updated_at": "2020-03-16 16:23:35",
            "episodes": [
                {
                    "id": 7,
                    "title": "綜藝集數1",
                    "opening_time": "2020-01-01 00:00:02",
                    "status": "Y",
                    "views": 0,
                    "media_id": "1",
                    "media_type": "variety",
                    "created_at": "2020-03-17 11:33:09",
                    "updated_at": "2020-03-17 11:33:09"
                },
                {
                    "id": 8,
                    "title": "綜藝集數1",
                    "opening_time": "2020-03-03 00:00:02",
                    "status": "Y",
                    "views": 0,
                    "media_id": "1",
                    "media_type": "variety",
                    "created_at": "2020-03-17 13:39:46",
                    "updated_at": "2020-03-17 13:39:46"
                }
            ]
        }
    ]
}
```

> 列表總數

```
{
    "data": "1",
    "code": "0"
}
```

> 詳細資訊

```
{
    "code": "0",
    "data": {
        "id": 1,
        "title": "綜藝測試",
        "alias": "綜藝別名",
        "image_path": "8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
        "image_url": "http://localhost/storage/8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
        "episode_status": "serializing",
        "status": "Y",
        "host": null,
        "guest": null,
        "region_id": 5,
        "years_id": 6,
        "language_id": 3,
        "description": null,
        "views": 0,
        "created_at": "2020-03-16 16:23:35",
        "updated_at": "2020-03-16 16:23:35",
        "region": {//地區
            "id": 5,
            "name": "中國",
            "status": "Y",
            "note": null,
            "used_type": "variety",
            "created_at": null,
            "updated_at": null
        },
        "years": {//年份
            "id": 6,
            "title": "2019",
            "remark": "",
            "status": "Y",
            "used_type": "variety",
            "created_at": null,
            "updated_at": null
        },
        "language": {//語言
            "id": 3,
            "title": "英文",
            "remark": "",
            "status": "Y",
            "used_type": "variety",
            "created_at": null,
            "updated_at": null
        },
        "genres": [//類型
            {
                "id": 5,
                "title": "動作",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "variety",
                "created_at": null,
                "updated_at": null,
                "pivot": {
                    "genres_used_id": 1,
                    "genres_id": 5,
                    "genres_used_type": "variety"
                }
            },
            {
                "id": 6,
                "title": "科幻",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "variety",
                "created_at": null,
                "updated_at": null,
                "pivot": {
                    "genres_used_id": 1,
                    "genres_id": 6,
                    "genres_used_type": "variety"
                }
            }
        ]
    }
}
```

> 評論列表

```
{
    "code": "0",
    "data": {
        "id": 1,//綜藝id
        "title": "綜藝測試",
        "alias": "綜藝別名",
        "image_path": "8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
        "image_url": "http://localhost/storage/8tlJJYIYY4tbUipJuydzcI2UM96vZbPhmQpxusgA.png",
        "episode_status": "serializing",
        "status": "Y",
        "host": null,
        "guest": null,
        "region_id": 5,
        "years_id": 6,
        "language_id": 3,
        "description": null,
        "views": 0,
        "created_at": "2020-03-16 16:23:35",
        "updated_at": "2020-03-16 16:23:35",
        "comments": [
            {
                "id": 1,//會員id
                "branch_id": 1,
                "account": "test",//會員帳號
                "display_name": "test",//會員名稱
                "status": "enable",
                "mail": null,
                "mail_approve": "N",
                "phone": null,
                "phone_approve": "N",
                "remark": null,
                "created_at": null,
                "updated_at": null,
                "deleted_at": null,
                "pivot": {
                    "commented_id": 1,
                    "member_id": 1,
                    "commented_type": "variety",
                    "contents": "dddddddd",//評論內容
                    "created_at": "2020-03-16 21:23:35",//評論時間
                    "updated_at": null
                }
            }
        ]
    }
}
```

> 評論列表總筆數

```
{
    "data": "6",
    "code": "0"
}
```

>來源列表

```
{
    "code": "0",
    "data": [
        {
            "id": 2,
            "title": "來源B",
            "remark": null,
            "status": "Y",
            "used_type": "variety",
            "created_at": null,
            "updated_at": null,
            "episode": [
                {
                    "id": 7,
                    "title": "綜藝集數1",
                    "opening_time": "2020-01-01 00:00:02",
                    "status": "Y",
                    "views": 0,
                    "media_id": "1",
                    "media_type": "variety",
                    "created_at": "2020-03-17 11:33:09",
                    "updated_at": "2020-03-17 11:33:09",
                    "sources_url": {
                        "source_id": 2,
                        "episode_id": 7,
                        "url": "http://google.com"
                    }
                }
            ]
        },
        {
            "id": 3,
            "title": "來源C",
            "remark": "",
            "status": "Y",
            "used_type": "variety",
            "created_at": null,
            "updated_at": null,
            "episode": [
                {
                    "id": 8,
                    "title": "綜藝集數1",
                    "opening_time": "2020-03-03 00:00:02",
                    "status": "Y",
                    "views": 0,
                    "media_id": "1",
                    "media_type": "variety",
                    "created_at": "2020-03-17 13:39:46",
                    "updated_at": "2020-03-17 13:39:46",
                    "sources_url": {
                        "source_id": 3,
                        "episode_id": 8,
                        "url": "http://google.com"
                    }
                }
            ]
        }
    ]
}
```

>選單列表

```
{
    "code": "0",
    "data": {
        "genres": [//類型
            {
                "id": 5,
                "title": "動作",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "variety",
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 6,
                "title": "科幻",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "variety",
                "created_at": null,
                "updated_at": null
            }
        ],
        "region": [//地區
            {
                "id": 5,
                "name": "中國",
                "status": "Y",
                "note": null,
                "used_type": "variety",
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 6,
                "name": "日本",
                "status": "Y",
                "note": null,
                "used_type": "variety",
                "created_at": null,
                "updated_at": null
            }
        ],
        "years": [//年份
            {
                "id": 5,
                "title": "2020",
                "remark": "",
                "status": "Y",
                "used_type": "variety",
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 6,
                "title": "2019",
                "remark": "",
                "status": "Y",
                "used_type": "variety",
                "created_at": null,
                "updated_at": null
            }
        ],
        "language": [//語言
            {
                "id": 3,
                "title": "英文",
                "remark": "",
                "status": "Y",
                "used_type": "variety",
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 4,
                "title": "中文",
                "remark": "",
                "status": "Y",
                "used_type": "variety",
                "created_at": null,
                "updated_at": null
            }
        ],
        "episode_status": [//集數狀態
            "serializing",
            "end"
        ]
    }
}
```

> 是否加入最愛  

```
{
  "code": "0",
  "data": true
}
```
