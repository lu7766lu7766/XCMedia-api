# 戲劇管理

> 列表

```
{
     "code": "0",
        "data": [
            {
                "id": 14,
                "title": "qwe123123",  //名稱
                "alias": "qqwe",  //別名
                "image_path": null,  //圖片位置
                "image_url": null,  //圖片連結
                "episode_status": "end",  //劇集狀態
                "status": "Y",  //狀態
                "starring": "123,456,789",  //主演
                "director": "qwe,dsa,as",  //導演
                "region_id": 1,  //地區id
                "years_id": 4,  //年份id
                "language_id": 3,  //語言id
                "description": "6666789",  //描述
                "views": 0,  //瀏覽率
                "score": 0,
                "created_at": "2020-02-14 19:11:36",
                "updated_at": "2020-02-14 19:11:36",
                "years": {  //年份
                    "id": 4,
                    "title": "eee", //名稱
                    "remark": null,  //備註
                    "status": "Y",  //狀態
                    "used_type": "drama",
                    "created_at": "2020-01-20 19:31:46",
                    "updated_at": "2020-01-20 19:31:46"
                },
                "region": {
                    "id": 1,
                    "name": "1",//名稱
                    "status": "Y", //備註
                    "note": null,//狀態
                    "used_type": "drama",
                    "created_at": null,
                    "updated_at": null
                },
                "language": {
                    "id": 3,
                    "title": "eee",//名稱
                    "remark": null, //備註
                    "status": "Y",//狀態
                    "used_type": "drama",
                    "created_at": "2020-02-04 14:58:18",
                    "updated_at": "2020-02-04 14:58:18"
                },
                "genres": [
                    {
                        "id": 1,
                        "title": "1",//名稱
                        "remark": null, //備註
                        "image_path": null,//圖片位置
                        "image_url": null,//圖片連結
                        "status": "Y",//狀態
                        "used_type": "drama",
                        "created_at": null,
                        "updated_at": null,
                        "pivot": {
                            "genres_used_id": 14,
                            "genres_id": 1,
                            "genres_used_type": "Modules\\Drama\\Entities\\Drama"
                        }
                    }
                ],
                "editor_files": [  //編輯器檔案
                    {
                        "id": 1,
                        "file_path": "editor_files/zs8zl0FeiQMTI0Lm4cQFLXw3futzeswLNw0lIFzm.jpeg",  //檔案位置
                        "file_url": "http://localhost/storage/editor_files/zs8zl0FeiQMTI0Lm4cQFLXw3futzeswLNw0lIFzm.jpeg", //檔案連結
                        "created_at": "2020-02-14 17:10:29",
                        "updated_at": "2020-02-14 17:10:29",
                        "pivot": {
                            "used_id": 14,
                            "editor_file_id": 1,
                            "used_type": "Modules\\Drama\\Entities\\Drama"
                        }
                    },
                    {
                        "id": 2,
                        "file_path": "editor_files/yy9yZltOVUreaPqnEfY9ckTPFgrBpj0cBJMqYyZF.jpeg",
                        "file_url": "http://localhost/storage/editor_files/yy9yZltOVUreaPqnEfY9ckTPFgrBpj0cBJMqYyZF.jpeg",
                        "created_at": "2020-02-14 17:10:34",
                        "updated_at": "2020-02-14 17:10:34",
                        "pivot": {
                            "used_id": 14,
                            "editor_file_id": 2,
                            "used_type": "Modules\\Drama\\Entities\\Drama"
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
            "title": "qwe123123",
            "alias": "qqwe",
            "episode_status": "end",
            "status": "Y",
            "starring": "123,456,789",
            "director": "qwe,dsa,as",
            "description": "6666789",
            "image_path": null,
            "image_url": null,
            "region_id": 1,
            "years_id": 4,
            "language_id": 3,
            "updated_at": "2020-02-15 15:43:48",
            "created_at": "2020-02-15 15:43:48",
            "id": 15,
            "years": {
                "id": 4,
                "title": "eee",
                "remark": null,
                "status": "Y",
                "used_type": "drama",
                "created_at": "2020-01-20 19:31:46",
                "updated_at": "2020-01-20 19:31:46"
            },
            "region": {
                "id": 1,
                "name": "1",
                "status": "Y",
                "note": null,
                "used_type": "drama",
                "created_at": null,
                "updated_at": null
            },
            "language": {
                "id": 3,
                "title": "eee",
                "remark": null,
                "status": "Y",
                "used_type": "drama",
                "created_at": "2020-02-04 14:58:18",
                "updated_at": "2020-02-04 14:58:18"
            },
            "genres": [
                {
                    "id": 1,
                    "title": "1",
                    "remark": null,
                    "image_path": null,
                    "image_url": null,
                    "status": "Y",
                    "used_type": "drama",
                    "created_at": null,
                    "updated_at": null,
                    "pivot": {
                        "genres_used_id": 15,
                        "genres_id": 1,
                        "genres_used_type": "Modules\\Drama\\Entities\\Drama"
                    }
                }
            ],
            "editor_files": [
                {
                    "id": 1,
                    "file_path": "editor_files/zs8zl0FeiQMTI0Lm4cQFLXw3futzeswLNw0lIFzm.jpeg",
                    "file_url": "http://localhost/storage/editor_files/zs8zl0FeiQMTI0Lm4cQFLXw3futzeswLNw0lIFzm.jpeg",
                    "created_at": "2020-02-14 17:10:29",
                    "updated_at": "2020-02-14 17:10:29",
                    "pivot": {
                        "used_id": 15,
                        "editor_file_id": 1,
                        "used_type": "Modules\\Drama\\Entities\\Drama"
                    }
                },
                {
                    "id": 2,
                    "file_path": "editor_files/yy9yZltOVUreaPqnEfY9ckTPFgrBpj0cBJMqYyZF.jpeg",
                    "file_url": "http://localhost/storage/editor_files/yy9yZltOVUreaPqnEfY9ckTPFgrBpj0cBJMqYyZF.jpeg",
                    "created_at": "2020-02-14 17:10:34",
                    "updated_at": "2020-02-14 17:10:34",
                    "pivot": {
                        "used_id": 15,
                        "editor_file_id": 2,
                        "used_type": "Modules\\Drama\\Entities\\Drama"
                    }
                }
            ]
        }
}
```

> 編輯頁面資訊

```
   "code": "0",
       "data": {
           "id": 3,
           "title": "qwe123123",
           "alias": "qqwe",
           "image_path": null,
           "image_url": null,
           "episode_status": "end",
           "status": "Y",
           "starring": "123,456,789",
           "director": "qwe,dsa,as",
           "region_id": 1,
           "years_id": 4,
           "language_id": 3,
           "description": "6666789",
           "views": 0,
           "score": 0,
           "created_at": "2020-02-14 17:13:55",
           "updated_at": "2020-02-14 19:12:18",
           "years": {
               "id": 4,
               "title": "eee",
               "remark": null,
               "status": "Y",
               "used_type": "drama",
               "created_at": "2020-01-20 19:31:46",
               "updated_at": "2020-01-20 19:31:46"
           },
           "region": {
               "id": 1,
               "name": "1",
               "status": "Y",
               "note": null,
               "used_type": "drama",
               "created_at": null,
               "updated_at": null
           },
           "language": {
               "id": 3,
               "title": "eee",
               "remark": null,
               "status": "Y",
               "used_type": "drama",
               "created_at": "2020-02-04 14:58:18",
               "updated_at": "2020-02-04 14:58:18"
           },
           "genres": [
               {
                   "id": 1,
                   "title": "1",
                   "remark": null,
                   "image_path": null,
                   "image_url": null,
                   "status": "Y",
                   "used_type": "drama",
                   "created_at": null,
                   "updated_at": null,
                   "pivot": {
                       "genres_used_id": 3,
                       "genres_id": 1,
                       "genres_used_type": "Modules\\Drama\\Entities\\Drama"
                   }
               }
           ],
           "editor_files": [
               {
                   "id": 1,
                   "file_path": "editor_files/zs8zl0FeiQMTI0Lm4cQFLXw3futzeswLNw0lIFzm.jpeg",
                   "file_url": "http://localhost/storage/editor_files/zs8zl0FeiQMTI0Lm4cQFLXw3futzeswLNw0lIFzm.jpeg",
                   "created_at": "2020-02-14 17:10:29",
                   "updated_at": "2020-02-14 17:10:29",
                   "pivot": {
                       "used_id": 3,
                       "editor_file_id": 1,
                       "used_type": "Modules\\Drama\\Entities\\Drama"
                   }
               },
               {
                   "id": 2,
                   "file_path": "editor_files/yy9yZltOVUreaPqnEfY9ckTPFgrBpj0cBJMqYyZF.jpeg",
                   "file_url": "http://localhost/storage/editor_files/yy9yZltOVUreaPqnEfY9ckTPFgrBpj0cBJMqYyZF.jpeg",
                   "created_at": "2020-02-14 17:10:34",
                   "updated_at": "2020-02-14 17:10:34",
                   "pivot": {
                       "used_id": 3,
                       "editor_file_id": 2,
                       "used_type": "Modules\\Drama\\Entities\\Drama"
                   }
               }
           ]
       }
```

> 更新

```
     "code": "0",
            "data": {
                "title": "qwe123123",
                "alias": "qqwe",
                "episode_status": "end",
                "status": "Y",
                "starring": "123,456,789",
                "director": "qwe,dsa,as",
                "description": "6666789",
                "image_path": null,
                "image_url": null,
                "region_id": 1,
                "years_id": 4,
                "language_id": 3,
                "updated_at": "2020-02-15 15:43:48",
                "created_at": "2020-02-15 15:43:48",
                "id": 15,
                "years": {
                    "id": 4,
                    "title": "eee",
                    "remark": null,
                    "status": "Y",
                    "used_type": "drama",
                    "created_at": "2020-01-20 19:31:46",
                    "updated_at": "2020-01-20 19:31:46"
                },
                "region": {
                    "id": 1,
                    "name": "1",
                    "status": "Y",
                    "note": null,
                    "used_type": "drama",
                    "created_at": null,
                    "updated_at": null
                },
                "language": {
                    "id": 3,
                    "title": "eee",
                    "remark": null,
                    "status": "Y",
                    "used_type": "drama",
                    "created_at": "2020-02-04 14:58:18",
                    "updated_at": "2020-02-04 14:58:18"
                },
                "genres": [
                    {
                        "id": 1,
                        "title": "1",
                        "remark": null,
                        "image_path": null,
                        "image_url": null,
                        "status": "Y",
                        "used_type": "drama",
                        "created_at": null,
                        "updated_at": null,
                        "pivot": {
                            "genres_used_id": 15,
                            "genres_id": 1,
                            "genres_used_type": "Modules\\Drama\\Entities\\Drama"
                        }
                    }
                ],
                "editor_files": [
                    {
                        "id": 1,
                        "file_path": "editor_files/zs8zl0FeiQMTI0Lm4cQFLXw3futzeswLNw0lIFzm.jpeg",
                        "file_url": "http://localhost/storage/editor_files/zs8zl0FeiQMTI0Lm4cQFLXw3futzeswLNw0lIFzm.jpeg",
                        "created_at": "2020-02-14 17:10:29",
                        "updated_at": "2020-02-14 17:10:29",
                        "pivot": {
                            "used_id": 15,
                            "editor_file_id": 1,
                            "used_type": "Modules\\Drama\\Entities\\Drama"
                        }
                    },
                    {
                        "id": 2,
                        "file_path": "editor_files/yy9yZltOVUreaPqnEfY9ckTPFgrBpj0cBJMqYyZF.jpeg",
                        "file_url": "http://localhost/storage/editor_files/yy9yZltOVUreaPqnEfY9ckTPFgrBpj0cBJMqYyZF.jpeg",
                        "created_at": "2020-02-14 17:10:34",
                        "updated_at": "2020-02-14 17:10:34",
                        "pivot": {
                            "used_id": 15,
                            "editor_file_id": 2,
                            "used_type": "Modules\\Drama\\Entities\\Drama"
                        }
                    }
                ]
            }
```

> 刪除

```
{
   "code": "0",
       "data": {
           "id": 4,
           "title": "qwe123123",
           "alias": "qqwe",
           "image_path": "lZXGLg0q6te6iYWNt4ZIjdnGCIK2urgrQvfLE3OJ.jpeg",
           "image_url": "http://localhost/storage/lZXGLg0q6te6iYWNt4ZIjdnGCIK2urgrQvfLE3OJ.jpeg",
           "episode_status": "end",
           "status": "Y",
           "starring": "123,456,789",
           "director": "qwe,dsa,as",
           "region_id": 1,
           "years_id": 4,
           "language_id": 3,
           "description": "6666789",
           "views": 0,
           "score": 0,
           "created_at": "2020-02-14 17:14:22",
           "updated_at": "2020-02-14 17:14:22"
       }
}
```
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

# 集數設定

> 列表/新增/編輯/更新/批次更新

```
{
    "code": "0",
       "data": [
           {
               "id": 51,
               "title": "qwe11",  //名稱
               "opening_time": "2020-01-01 00:00:02",  //開放時間
               "status": "Y",  //狀態
               "views": 0,  //瀏覽次數
               "media_id": "3",  // 影音id
               "media_type": "Modules\\Drama\\Entities\\Drama",//影音類型
               "created_at": "2020-02-15 14:32:19",
               "updated_at": "2020-02-15 14:32:19",
               "sources": [  //來源
                   {
                       "id": 2,
                       "title": "eee",  //名稱
                       "remark": null,  //備註
                       "status": "Y",  //狀態
                       "used_type": "drama",
                       "created_at": "2020-01-20 18:13:00",
                       "updated_at": "2020-01-20 18:13:00",
                       "sources_url": {  //來源連結
                           "episode_id": 51,
                           "source_id": 2,
                           "url": "111"  //連結
                       }
                   },
                   {
                       "id": 5,
                       "title": "eee",
                       "remark": null,
                       "status": "Y",
                       "used_type": "drama",
                       "created_at": "2020-01-30 15:47:42",
                       "updated_at": "2020-01-30 15:47:42",
                       "sources_url": {
                           "episode_id": 51,
                           "source_id": 5,
                           "url": "2222"
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
                "name": "1",
                "status": "Y",
                "note": null,
                "used_type": "drama",
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
                "id": 4,
                "title": "eee",
                "remark": null,
                "status": "Y",
                "used_type": "drama",
                "created_at": "2020-01-20 19:31:46",
                "updated_at": "2020-01-20 19:31:46"
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
                "title": "1",
                "remark": null,
                "image_path": null,
                "image_url": null,
                "status": "Y",
                "used_type": "drama",
                "created_at": null,
                "updated_at": null
            }
        ]
}
```
