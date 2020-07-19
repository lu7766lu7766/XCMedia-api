# 電影管理

> 列表

```
{
  "code": "0",
  "data": [
    {
      "id": 7,
      "name": "燒烤大作戰",
      "alias": "這是別名",
      "image_path": "movie/image/IS4UxLki9o1c1mGieiDRQNidowzuSfghFTUK5R3o.png",
      "image_url": "http://media_api.test/storage/movie/image/IS4UxLki9o1c1mGieiDRQNidowzuSfghFTUK5R3o.png",
      "episode_status": "serializing",
      "status": "Y",
      "region_id": 1,
      "years_id": 1,
      "language_id": 1,
      "starring": "李奧納多皮卡丘,拉不拉多",
      "director": "史蒂芬漢堡",
      "description": "hello",
      "views": 0,
      "score": "5.3",
      "created_at": "2020-02-21 17:17:29",
      "updated_at": "2020-02-21 17:17:29",
      "region": {
        "id": 1,
        "name": "TW",
        "status": "Y",
        "note": null,
        "used_type": "movie",
        "created_at": "2020-02-19 17:14:42",
        "updated_at": "2020-02-19 17:14:42"
      },
      "years": {
        "id": 1,
        "title": "2020",
        "remark": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-19 17:14:42",
        "updated_at": "2020-02-19 17:14:42"
      },
      "language": {
        "id": 1,
        "title": "TW",
        "remark": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-19 17:14:36",
        "updated_at": "2020-02-19 17:14:38"
      },
      "genres": [
        {
          "id": 1,
          "title": "劇情",
          "remark": null,
          "image_path": null,
          "image_url": null,
          "status": "Y",
          "used_type": "movie",
          "created_at": "2020-02-19 17:14:42",
          "updated_at": "2020-02-19 17:14:42",
          "pivot": {
            "genres_used_id": 7,
            "genres_id": 1,
            "genres_used_type": "Modules\\Movie\\Entities\\Movie"
          }
        },
        {
          "id": 2,
          "title": "戰爭",
          "remark": null,
          "image_path": null,
          "image_url": null,
          "status": "Y",
          "used_type": "movie",
          "created_at": "2020-02-19 17:14:42",
          "updated_at": "2020-02-19 17:14:42",
          "pivot": {
            "genres_used_id": 7,
            "genres_id": 2,
            "genres_used_type": "Modules\\Movie\\Entities\\Movie"
          }
        }
      ],
      "editor_files": [
        {
          "id": 1,
          "file_path": "editor_files/t6eSY9du6ns69XJ8PyxOcBDIjMAGmXDTQ8MeqRnb.jpeg",
          "file_url": "http://localhost/storage/editor_files/t6eSY9du6ns69XJ8PyxOcBDIjMAGmXDTQ8MeqRnb.jpeg",
          "created_at": "2020-02-19 17:12:32",
          "updated_at": "2020-02-19 17:12:32",
          "pivot": {
            "used_id": 7,
            "editor_file_id": 1,
            "used_type": "Modules\\Movie\\Entities\\Movie"
          }
        },
        {
          "id": 2,
          "file_path": "editor_files/1ihpze9nxfTZAzp0o97KthdVXDAQP50PgVnCwfOP.jpeg",
          "file_url": "http://localhost/storage/editor_files/1ihpze9nxfTZAzp0o97KthdVXDAQP50PgVnCwfOP.jpeg",
          "created_at": "2020-02-19 17:20:29",
          "updated_at": "2020-02-19 17:20:29",
          "pivot": {
            "used_id": 7,
            "editor_file_id": 2,
            "used_type": "Modules\\Movie\\Entities\\Movie"
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
  "code": "0",
  "data": "1"
}
```

> 新增

```
{
  "code": "0",
  "data": {
    "region_id": 1,
    "years_id": 1,
    "language_id": 1,
    "name": "茶六燒烤",
    "alias": "gogo",
    "starring": "李奧納多皮卡丘,拉不拉多",
    "episode_status": "serializing",
    "director": "史蒂芬漢堡",
    "description": "hello",
    "views": 0,
    "score": "5.3",
    "status": "Y",
    "updated_at": "2020-02-21 17:17:29",
    "created_at": "2020-02-21 17:17:29",
    "id": 7,
    "region": {
      "id": 1,
      "name": "TW",
      "status": "Y",
      "note": null,
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:42",
      "updated_at": "2020-02-19 17:14:42"
    },
    "years": {
      "id": 1,
      "title": "2020",
      "remark": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:42",
      "updated_at": "2020-02-19 17:14:42"
    },
    "language": {
      "id": 1,
      "title": "TW",
      "remark": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:36",
      "updated_at": "2020-02-19 17:14:38"
    },
    "genres": [
      {
        "id": 1,
        "title": "劇情",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-19 17:14:42",
        "updated_at": "2020-02-19 17:14:42",
        "pivot": {
          "genres_used_id": 7,
          "genres_id": 1,
          "genres_used_type": "Modules\\Movie\\Entities\\Movie"
        }
      },
      {
        "id": 2,
        "title": "戰爭",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-19 17:14:42",
        "updated_at": "2020-02-19 17:14:42",
        "pivot": {
          "genres_used_id": 7,
          "genres_id": 2,
          "genres_used_type": "Modules\\Movie\\Entities\\Movie"
        }
      }
    ],
    "editor_files": [
      {
        "id": 1,
        "file_path": "editor_files/t6eSY9du6ns69XJ8PyxOcBDIjMAGmXDTQ8MeqRnb.jpeg",
        "file_url": "http://localhost/storage/editor_files/t6eSY9du6ns69XJ8PyxOcBDIjMAGmXDTQ8MeqRnb.jpeg",
        "created_at": "2020-02-19 17:12:32",
        "updated_at": "2020-02-19 17:12:32",
        "pivot": {
          "used_id": 7,
          "editor_file_id": 1,
          "used_type": "Modules\\Movie\\Entities\\Movie"
        }
      },
      {
        "id": 2,
        "file_path": "editor_files/1ihpze9nxfTZAzp0o97KthdVXDAQP50PgVnCwfOP.jpeg",
        "file_url": "http://localhost/storage/editor_files/1ihpze9nxfTZAzp0o97KthdVXDAQP50PgVnCwfOP.jpeg",
        "created_at": "2020-02-19 17:20:29",
        "updated_at": "2020-02-19 17:20:29",
        "pivot": {
          "used_id": 7,
          "editor_file_id": 2,
          "used_type": "Modules\\Movie\\Entities\\Movie"
        }
      }
    ]
  }
}
```

> 詳細資訊

```
{
  "code": "0",
  "data": {
    "id": 5,
    "name": "可憐阿",
    "alias": "were",
    "image_path": "movie/image/IS4UxLki9o1c1mGieiDRQNidowzuSfghFTUK5R3o.png",
    "image_url": "http://media_api.test/storage/movie/image/IS4UxLki9o1c1mGieiDRQNidowzuSfghFTUK5R3o.png",
    "episode_status": "serializing",
    "status": "Y",
    "region_id": 1,
    "years_id": 1,
    "language_id": 1,
    "starring": "李奧納多皮卡丘,拉基",
    "director": "史蒂芬",
    "description": "hello",
    "views": 0,
    "score": "5.3",
    "created_at": "2020-02-19 17:47:01",
    "updated_at": "2020-02-19 17:48:39",
    "region": {
      "id": 1,
      "name": "TW",
      "status": "Y",
      "note": null,
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:42",
      "updated_at": "2020-02-19 17:14:42"
    },
    "years": {
      "id": 1,
      "title": "2020",
      "remark": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:42",
      "updated_at": "2020-02-19 17:14:42"
    },
    "language": {
      "id": 1,
      "title": "TW",
      "remark": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:36",
      "updated_at": "2020-02-19 17:14:38"
    },
    "genres": [
      {
        "id": 1,
        "title": "劇情",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-19 17:14:42",
        "updated_at": "2020-02-19 17:14:42",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 1,
          "genres_used_type": "Modules\\Movie\\Entities\\Movie"
        }
      },
      {
        "id": 2,
        "title": "戰爭",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-19 17:14:42",
        "updated_at": "2020-02-19 17:14:42",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 2,
          "genres_used_type": "Modules\\Movie\\Entities\\Movie"
        }
      }
    ],
    "editor_files": [
      {
        "id": 1,
        "file_path": "editor_files/t6eSY9du6ns69XJ8PyxOcBDIjMAGmXDTQ8MeqRnb.jpeg",
        "file_url": "http://localhost/storage/editor_files/t6eSY9du6ns69XJ8PyxOcBDIjMAGmXDTQ8MeqRnb.jpeg",
        "created_at": "2020-02-19 17:12:32",
        "updated_at": "2020-02-19 17:12:32",
        "pivot": {
          "used_id": 5,
          "editor_file_id": 1,
          "used_type": "Modules\\Movie\\Entities\\Movie"
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
    "id": 5,
    "name": "可憐阿",
    "alias": "were",
    "image_path": "movie/image/IS4UxLki9o1c1mGieiDRQNidowzuSfghFTUK5R3o.png",
    "image_url": "http://media_api.test/storage/movie/image/IS4UxLki9o1c1mGieiDRQNidowzuSfghFTUK5R3o.png",
    "episode_status": "serializing",
    "status": "Y",
    "region_id": 1,
    "years_id": 1,
    "language_id": 1,
    "starring": "李奧納多皮卡丘,拉基",
    "director": "史蒂芬",
    "description": "hello",
    "views": 0,
    "score": "5.3",
    "created_at": "2020-02-19 17:47:01",
    "updated_at": "2020-02-19 17:48:39",
    "region": {
      "id": 1,
      "name": "TW",
      "status": "Y",
      "note": null,
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:42",
      "updated_at": "2020-02-19 17:14:42"
    },
    "years": {
      "id": 1,
      "title": "2020",
      "remark": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:42",
      "updated_at": "2020-02-19 17:14:42"
    },
    "language": {
      "id": 1,
      "title": "TW",
      "remark": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:36",
      "updated_at": "2020-02-19 17:14:38"
    },
    "genres": [
      {
        "id": 1,
        "title": "劇情",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-19 17:14:42",
        "updated_at": "2020-02-19 17:14:42",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 1,
          "genres_used_type": "Modules\\Movie\\Entities\\Movie"
        }
      },
      {
        "id": 2,
        "title": "戰爭",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-19 17:14:42",
        "updated_at": "2020-02-19 17:14:42",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 2,
          "genres_used_type": "Modules\\Movie\\Entities\\Movie"
        }
      }
    ],
    "editor_files": [
      {
        "id": 1,
        "file_path": "editor_files/t6eSY9du6ns69XJ8PyxOcBDIjMAGmXDTQ8MeqRnb.jpeg",
        "file_url": "http://localhost/storage/editor_files/t6eSY9du6ns69XJ8PyxOcBDIjMAGmXDTQ8MeqRnb.jpeg",
        "created_at": "2020-02-19 17:12:32",
        "updated_at": "2020-02-19 17:12:32",
        "pivot": {
          "used_id": 5,
          "editor_file_id": 1,
          "used_type": "Modules\\Movie\\Entities\\Movie"
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
  "data": "1"
}
```
> 編輯器圖片上傳

```
{
  "code": "0",
  "data": {
    "file_path": "editor_files/p6WtS4qWjeSBNrV2gQoyujd6hoXcIzbR4LvdhO8r.png",
    "file_url": "http://media_api.test/storage/editor_files/p6WtS4qWjeSBNrV2gQoyujd6hoXcIzbR4LvdhO8r.png",
    "updated_at": "2020-02-21 17:18:09",
    "created_at": "2020-02-21 17:18:09",
    "id": 3
  }
}
```

> 編輯器圖片刪除

```
{
  "code": "0",
  "data": "1"
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
               "media_type": "Modules\\Movie\\Entities\\Movie",//影音類型
               "created_at": "2020-02-15 14:32:19",
               "updated_at": "2020-02-15 14:32:19",
               "sources": [  //來源
                   {
                       "id": 2,
                       "title": "eee",  //名稱
                       "remark": null,  //備註
                       "status": "Y",  //狀態
                       "used_type": "movie",
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
                       "used_type": "movie",
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
      "name": "TW",
      "status": "Y",
      "note": null,
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:42",
      "updated_at": "2020-02-19 17:14:42"
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
                "used_type": "movie",
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
      "title": "劇情",
      "remark": null,
      "image_path": null,
      "image_url": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:42",
      "updated_at": "2020-02-19 17:14:42"
    },
    {
      "id": 2,
      "title": "戰爭",
      "remark": null,
      "image_path": null,
      "image_url": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-19 17:14:42",
      "updated_at": "2020-02-19 17:14:42"
    }
  ]
}
```
