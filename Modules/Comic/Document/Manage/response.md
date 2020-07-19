# 漫畫管理

> 列表

```
{
  "code": "0",
  "data": [
    {
      "id": 5,
      "name": "阿拉花瓜",
      "alias": "gogo",
      "image_path": "comic/image/bIWmkame27bzhMV2zwAIYwxIskgbICXcxMkWA0QB.png",
      "image_url": "http://media_api.test/storage/comic/image/bIWmkame27bzhMV2zwAIYwxIskgbICXcxMkWA0QB.png",
      "episode_status": "serializing",
      "status": "Y",
      "region_id": 3,
      "years_id": 3,
      "tags": [
        "動物",
        "自然"
      ],
      "description": "wulala",
      "views": 0, //瀏覽率
      "score": "5.3", //評分
      "created_at": "2020-03-09 16:14:04",
      "updated_at": "2020-03-09 16:14:04",
      "region": {
        "id": 3,
        "name": "日本",
        "status": "Y",
        "note": null,
        "used_type": "comic",
        "created_at": "2020-03-09 15:48:26",
        "updated_at": "2020-03-09 15:48:29"
      },
      "years": {
        "id": 3,
        "title": "2020",
        "remark": null,
        "status": "Y",
        "used_type": "comic",
        "created_at": "2020-03-09 15:46:08",
        "updated_at": "2020-03-09 15:46:11"
      },
      "genres": [
        {
          "id": 3,
          "title": "科幻",
          "remark": null,
          "image_path": null,
          "image_url": null,
          "status": "Y",
          "used_type": "comic",
          "created_at": "2020-03-09 15:54:04",
          "updated_at": "2020-03-09 15:54:07",
          "pivot": {
            "genres_used_id": 5,
            "genres_id": 3,
            "genres_used_type": "Modules\\Comic\\Entities\\Comic"
          }
        }
      ],
      "editor_files": [
        {
          "id": 2,
          "file_path": "editor_files/MzUJ9tkFV9GcB2yYRmCRZMJfta8i1zCejj38LBe8.jpeg",
          "file_url": "http://media_api.test/storage/editor_files/MzUJ9tkFV9GcB2yYRmCRZMJfta8i1zCejj38LBe8.jpeg",
          "created_at": "2020-03-09 16:12:45",
          "updated_at": "2020-03-09 16:12:45",
          "pivot": {
            "used_id": 5,
            "editor_file_id": 2,
            "used_type": "Modules\\Comic\\Entities\\Comic"
          }
        }
      ]
    },
    {
      "id": 4,
      "name": "兔子嗚啦啦",
      "alias": "gogo",
      "image_path": "comic/image/TQrl67RbiNnjEl3BmwXV3sAn8nXaS10ywq7vg62u.png",
      "image_url": "http://media_api.test/storage/comic/image/TQrl67RbiNnjEl3BmwXV3sAn8nXaS10ywq7vg62u.png",
      "episode_status": "serializing",
      "status": "Y",
      "region_id": 3,
      "years_id": 3,
      "tags": [
        "動物",
        "自然"
      ],
      "description": "wulala",
      "views": 0, //瀏覽率
      "score": "5.3", //評分
      "created_at": "2020-03-09 16:13:33",
      "updated_at": "2020-03-09 16:13:33",
      "region": {
        "id": 3,
        "name": "日本",
        "status": "Y",
        "note": null,
        "used_type": "comic",
        "created_at": "2020-03-09 15:48:26",
        "updated_at": "2020-03-09 15:48:29"
      },
      "years": {
        "id": 3,
        "title": "2020",
        "remark": null,
        "status": "Y",
        "used_type": "comic",
        "created_at": "2020-03-09 15:46:08",
        "updated_at": "2020-03-09 15:46:11"
      },
      "genres": [
        {
          "id": 3,
          "title": "科幻",
          "remark": null,
          "image_path": null,
          "image_url": null,
          "status": "Y",
          "used_type": "comic",
          "created_at": "2020-03-09 15:54:04",
          "updated_at": "2020-03-09 15:54:07",
          "pivot": {
            "genres_used_id": 4,
            "genres_id": 3,
            "genres_used_type": "Modules\\Comic\\Entities\\Comic"
          }
        }
      ],
      "editor_files": []
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
    "region_id": 3,
    "years_id": 3,
    "name": "阿拉花瓜",
    "alias": "gogo",
    "episode_status": "serializing",
    "tags": [
      "動物",
      "自然"
    ],
    "description": "wulala",
    "views": 0, //瀏覽率
    "score": "5.3", //評分
    "status": "Y",
    "image_path": "comic/image/bIWmkame27bzhMV2zwAIYwxIskgbICXcxMkWA0QB.png",
    "image_url": "http://media_api.test/storage/comic/image/bIWmkame27bzhMV2zwAIYwxIskgbICXcxMkWA0QB.png",
    "updated_at": "2020-03-09 16:14:04",
    "created_at": "2020-03-09 16:14:04",
    "id": 5,
    "region": {
      "id": 3,
      "name": "日本",
      "status": "Y",
      "note": null,
      "used_type": "comic",
      "created_at": "2020-03-09 15:48:26",
      "updated_at": "2020-03-09 15:48:29"
    },
    "years": {
      "id": 3,
      "title": "2020",
      "remark": null,
      "status": "Y",
      "used_type": "comic",
      "created_at": "2020-03-09 15:46:08",
      "updated_at": "2020-03-09 15:46:11"
    },
    "genres": [
      {
        "id": 3,
        "title": "科幻",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "comic",
        "created_at": "2020-03-09 15:54:04",
        "updated_at": "2020-03-09 15:54:07",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 3,
          "genres_used_type": "Modules\\Comic\\Entities\\Comic"
        }
      }
    ],
    "editor_files": [
      {
        "id": 2,
        "file_path": "editor_files/MzUJ9tkFV9GcB2yYRmCRZMJfta8i1zCejj38LBe8.jpeg",
        "file_url": "http://media_api.test/storage/editor_files/MzUJ9tkFV9GcB2yYRmCRZMJfta8i1zCejj38LBe8.jpeg",
        "created_at": "2020-03-09 16:12:45",
        "updated_at": "2020-03-09 16:12:45",
        "pivot": {
          "used_id": 5,
          "editor_file_id": 2,
          "used_type": "Modules\\Comic\\Entities\\Comic"
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
    "region_id": 3,
    "years_id": 3,
    "name": "阿拉花瓜",
    "alias": "gogo",
    "episode_status": "serializing",
    "tags": [
      "動物",
      "自然"
    ],
    "description": "wulala",
    "views": 0, //瀏覽率
    "score": "5.3", //評分
    "status": "Y",
    "image_path": "comic/image/bIWmkame27bzhMV2zwAIYwxIskgbICXcxMkWA0QB.png",
    "image_url": "http://media_api.test/storage/comic/image/bIWmkame27bzhMV2zwAIYwxIskgbICXcxMkWA0QB.png",
    "updated_at": "2020-03-09 16:14:04",
    "created_at": "2020-03-09 16:14:04",
    "id": 5,
    "region": {
      "id": 3,
      "name": "日本",
      "status": "Y",
      "note": null,
      "used_type": "comic",
      "created_at": "2020-03-09 15:48:26",
      "updated_at": "2020-03-09 15:48:29"
    },
    "years": {
      "id": 3,
      "title": "2020",
      "remark": null,
      "status": "Y",
      "used_type": "comic",
      "created_at": "2020-03-09 15:46:08",
      "updated_at": "2020-03-09 15:46:11"
    },
    "genres": [
      {
        "id": 3,
        "title": "科幻",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "comic",
        "created_at": "2020-03-09 15:54:04",
        "updated_at": "2020-03-09 15:54:07",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 3,
          "genres_used_type": "Modules\\Comic\\Entities\\Comic"
        }
      }
    ],
    "editor_files": [
      {
        "id": 2,
        "file_path": "editor_files/MzUJ9tkFV9GcB2yYRmCRZMJfta8i1zCejj38LBe8.jpeg",
        "file_url": "http://media_api.test/storage/editor_files/MzUJ9tkFV9GcB2yYRmCRZMJfta8i1zCejj38LBe8.jpeg",
        "created_at": "2020-03-09 16:12:45",
        "updated_at": "2020-03-09 16:12:45",
        "pivot": {
          "used_id": 5,
          "editor_file_id": 2,
          "used_type": "Modules\\Comic\\Entities\\Comic"
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
    "region_id": 3,
    "years_id": 3,
    "name": "阿拉花瓜",
    "alias": "gogo",
    "episode_status": "serializing",
    "tags": [
      "動物",
      "自然"
    ],
    "description": "wulala",
    "status": "Y",
    "image_path": "comic/image/bIWmkame27bzhMV2zwAIYwxIskgbICXcxMkWA0QB.png",
    "image_url": "http://media_api.test/storage/comic/image/bIWmkame27bzhMV2zwAIYwxIskgbICXcxMkWA0QB.png",
    "updated_at": "2020-03-09 16:14:04",
    "created_at": "2020-03-09 16:14:04",
    "id": 5,
    "region": {
      "id": 3,
      "name": "日本",
      "status": "Y",
      "note": null,
      "used_type": "comic",
      "created_at": "2020-03-09 15:48:26",
      "updated_at": "2020-03-09 15:48:29"
    },
    "years": {
      "id": 3,
      "title": "2020",
      "remark": null,
      "status": "Y",
      "used_type": "comic",
      "created_at": "2020-03-09 15:46:08",
      "updated_at": "2020-03-09 15:46:11"
    },
    "genres": [
      {
        "id": 3,
        "title": "科幻",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "comic",
        "created_at": "2020-03-09 15:54:04",
        "updated_at": "2020-03-09 15:54:07",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 3,
          "genres_used_type": "Modules\\Comic\\Entities\\Comic"
        }
      }
    ],
    "editor_files": [
      {
        "id": 2,
        "file_path": "editor_files/MzUJ9tkFV9GcB2yYRmCRZMJfta8i1zCejj38LBe8.jpeg",
        "file_url": "http://media_api.test/storage/editor_files/MzUJ9tkFV9GcB2yYRmCRZMJfta8i1zCejj38LBe8.jpeg",
        "created_at": "2020-03-09 16:12:45",
        "updated_at": "2020-03-09 16:12:45",
        "pivot": {
          "used_id": 5,
          "editor_file_id": 2,
          "used_type": "Modules\\Comic\\Entities\\Comic"
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
    "file_path": "editor_files/YLuIHmbPatUZTUeRdMfE07qY5XTxLMTXiYjLZqAT.jpeg",
    "file_url": "http://media_api.test/storage/editor_files/YLuIHmbPatUZTUeRdMfE07qY5XTxLMTXiYjLZqAT.jpeg",
    "updated_at": "2020-03-09 16:08:05",
    "created_at": "2020-03-09 16:08:05",
    "id": 1
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

> 列表

```
{
  "code": "0",
  "data": [
    {
      "id": 2,
      "comic_id": 1,
      "title": "一肚子火",
      "opening_time": "2020-02-28 00:00:00",
      "status": "Y",
      "views": 0,
      "created_at": "2020-03-10 19:30:32",
      "updated_at": "2020-03-10 19:30:32"
    },
    {
      "id": 1,
      "comic_id": 1,
      "title": "起源",
      "opening_time": "2020-02-28 00:00:00",
      "status": "Y",
      "views": 0,
      "created_at": "2020-03-10 19:29:12",
      "updated_at": "2020-03-10 19:29:12"
    }
  ]
}
```

> 新增/編輯/更新/刪除

```
{
  "code": "0",
  "data": {
    "title": "起源",
    "opening_time": "2020-02-28 00:00:00",
    "status": "Y",
    "comic_id": 1,
    "updated_at": "2020-03-10 19:29:12",
    "created_at": "2020-03-10 19:29:12",
    "id": 1,
    "gallery": [
      {
        "id": 6,
        "name": "cat_a.png",
        "file_path": "comic/image/jDwstqxHknynQiIF4gNTmL6hP4V0dL7WDRrVqL6L.png",
        "file_url": "http://media_api.test/storage/comic/image/jDwstqxHknynQiIF4gNTmL6hP4V0dL7WDRrVqL6L.png",
        "created_at": "2020-03-10 16:38:10",
        "updated_at": "2020-03-10 16:38:10",
        "pivot": {
          "comic_episode_id": 1,
          "comic_gallery_id": 6,
          "created_at": "2020-03-10 19:29:12",
          "updated_at": "2020-03-10 19:29:12"
        }
      },
      {
        "id": 7,
        "name": "cat.png",
        "file_path": "comic/image/GO1t5ISBAQMuE4pIjMoYNWpdheWVmuFvBYCA81Fl.png",
        "file_url": "http://media_api.test/storage/comic/image/GO1t5ISBAQMuE4pIjMoYNWpdheWVmuFvBYCA81Fl.png",
        "created_at": "2020-03-10 19:18:55",
        "updated_at": "2020-03-10 19:18:55",
        "pivot": {
          "comic_episode_id": 1,
          "comic_gallery_id": 7,
          "created_at": "2020-03-10 19:29:12",
          "updated_at": "2020-03-10 19:29:12"
        }
      }
    ]
  }
}
```

> 總數

```
{
    "data": "1",
    "code": "0"
}
```

> 漫畫圖片上傳/漫畫圖片刪除

```
{
  "code": "0",
  "data": {
    "name": "cat.png",
    "file_path": "comic/image/1fIt0xhdmxu3rjmfS3OfjcS5awDvVRcQgM52Y2H3.png",
    "file_url": "http://media_api.test/storage/comic/image/1fIt0xhdmxu3rjmfS3OfjcS5awDvVRcQgM52Y2H3.png",
    "updated_at": "2020-03-10 19:19:04",
    "created_at": "2020-03-10 19:19:04",
    "id": 11
  }
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

> 取得年份/來源
```
{
     "code": "0",
        "data": [
            {
                "id": 4,
                "title": "標題",
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
