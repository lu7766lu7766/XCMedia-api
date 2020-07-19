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
                "starring": "123,456,789",  //主演
                "director": "qwe,dsa,as",  //導演
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
            "name": "test",
            "alias": "test",
            "image_path": null,
            "image_url": null,
            "episode_status": "serializing",
            "status": "Y",
            "region_id": 2,
            "years_id": 1,
            "language_id": 1,
            "starring": null,
            "director": null,
            "description": null,
            "views": 0,
            "created_at": null,
            "updated_at": null
        }
    ]
}
```

# 電影前台入口

> 最新電影列表

```
{
  "code": "0",
  "data": [
    {
      "id": 13,
      "name": "寄生上流",
      "alias": null,
      "image_path": "movie/image/ljunZxw41gJjtmrU6w9FFZV7z00qD3CzzWwiWFkV.jpeg",
      "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/ljunZxw41gJjtmrU6w9FFZV7z00qD3CzzWwiWFkV.jpeg",
      "episode_status": "serializing",
      "status": "Y",
      "region_id": 21,
      "years_id": 4,
      "language_id": 2,
      "starring": "宋康昊",
      "director": "奉俊昊",
      "description": null,
      "views": 0,
      "created_at": "2020-03-16 11:01:03",
      "updated_at": "2020-03-16 11:01:03"
    },
    {
      "id": 10,
      "name": "Little Woman",
      "alias": "她們",
      "image_path": "movie/image/jrxg0oaC7JZTjtb5l1nbgfKdBLoDsBrzs9jRM0u6.jpeg",
      "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/jrxg0oaC7JZTjtb5l1nbgfKdBLoDsBrzs9jRM0u6.jpeg",
      "episode_status": "end",
      "status": "Y",
      "region_id": 22,
      "years_id": 15,
      "language_id": 12,
      "starring": "Saoirse Una Ronan,Emma Charlotte Duerre Watson",
      "director": "Greta Celeste Gerwig",
      "description": "<p>3</p>",
      "views": 0,
      "created_at": "2020-03-04 14:35:30",
      "updated_at": "2020-03-09 18:20:23"
    },
    {
      "id": 5,
      "name": "沼澤青蛙",
      "alias": "gogo",
      "image_path": "movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
      "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
      "episode_status": "serializing",
      "status": "Y",
      "region_id": 11,
      "years_id": 15,
      "language_id": 2,
      "starring": "李奧納多皮卡丘,拉不拉多",
      "director": "史蒂芬漢堡",
      "description": "<p><img src=\"https://s3-ap-southeast-1.amazonaws.com/test-media-api/editor_files/WosfHYzgd2KAwgNs52XFEXlJal9VpdRTGccgPqkn.png\">hello</p>",
      "views": 0,
      "created_at": "2020-03-03 14:51:47",
      "updated_at": "2020-03-16 11:13:10"
    }
  ]
}
```

> 觀看數最多電影列表

```
{
  "code": "0",
  "data": [
    {
      "id": 10,
      "name": "Little Woman",
      "alias": "她們",
      "image_path": "movie/image/jrxg0oaC7JZTjtb5l1nbgfKdBLoDsBrzs9jRM0u6.jpeg",
      "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/jrxg0oaC7JZTjtb5l1nbgfKdBLoDsBrzs9jRM0u6.jpeg",
      "episode_status": "end",
      "status": "Y",
      "region_id": 22,
      "years_id": 15,
      "language_id": 12,
      "starring": "Saoirse Una Ronan,Emma Charlotte Duerre Watson",
      "director": "Greta Celeste Gerwig",
      "description": "<p>3</p>",
      "views": 10,
      "created_at": "2020-03-04 14:35:30",
      "updated_at": "2020-03-09 18:20:23"
    },
    {
      "id": 5,
      "name": "沼澤青蛙",
      "alias": "gogo",
      "image_path": "movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
      "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
      "episode_status": "serializing",
      "status": "Y",
      "region_id": 11,
      "years_id": 15,
      "language_id": 2,
      "starring": "李奧納多皮卡丘,拉不拉多",
      "director": "史蒂芬漢堡",
      "description": "<p><img src=\"https://s3-ap-southeast-1.amazonaws.com/test-media-api/editor_files/WosfHYzgd2KAwgNs52XFEXlJal9VpdRTGccgPqkn.png\">hello</p>",
      "views": 0,
      "created_at": "2020-03-03 14:51:47",
      "updated_at": "2020-03-16 11:13:10"
    },
    {
      "id": 13,
      "name": "寄生上流",
      "alias": null,
      "image_path": "movie/image/ljunZxw41gJjtmrU6w9FFZV7z00qD3CzzWwiWFkV.jpeg",
      "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/ljunZxw41gJjtmrU6w9FFZV7z00qD3CzzWwiWFkV.jpeg",
      "episode_status": "serializing",
      "status": "Y",
      "region_id": 21,
      "years_id": 4,
      "language_id": 2,
      "starring": "宋康昊",
      "director": "奉俊昊",
      "description": null,
      "views": 0,
      "created_at": "2020-03-16 11:01:03",
      "updated_at": "2020-03-16 11:01:03"
    }
  ]
}
```

> 回應數最多電影列表

```
{
  "code": "0",
  "data": [
    {
      "id": 5,
      "name": "沼澤青蛙",
      "alias": "gogo",
      "image_path": "movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
      "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
      "episode_status": "serializing",
      "status": "Y",
      "region_id": 11,
      "years_id": 15,
      "language_id": 2,
      "starring": "李奧納多皮卡丘,拉不拉多",
      "director": "史蒂芬漢堡",
      "description": "<p><img src=\"https://s3-ap-southeast-1.amazonaws.com/test-media-api/editor_files/WosfHYzgd2KAwgNs52XFEXlJal9VpdRTGccgPqkn.png\">hello</p>",
      "views": 0,
      "created_at": "2020-03-03 14:51:47",
      "updated_at": "2020-03-16 11:13:10",
      "comments_count": 3
    },
    {
      "id": 10,
      "name": "Little Woman",
      "alias": "她們",
      "image_path": "movie/image/jrxg0oaC7JZTjtb5l1nbgfKdBLoDsBrzs9jRM0u6.jpeg",
      "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/jrxg0oaC7JZTjtb5l1nbgfKdBLoDsBrzs9jRM0u6.jpeg",
      "episode_status": "end",
      "status": "Y",
      "region_id": 22,
      "years_id": 15,
      "language_id": 12,
      "starring": "Saoirse Una Ronan,Emma Charlotte Duerre Watson",
      "director": "Greta Celeste Gerwig",
      "description": "<p>3</p>",
      "views": 10,
      "created_at": "2020-03-04 14:35:30",
      "updated_at": "2020-03-09 18:20:23",
      "comments_count": 0
    },
    {
      "id": 13,
      "name": "寄生上流",
      "alias": null,
      "image_path": "movie/image/ljunZxw41gJjtmrU6w9FFZV7z00qD3CzzWwiWFkV.jpeg",
      "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/ljunZxw41gJjtmrU6w9FFZV7z00qD3CzzWwiWFkV.jpeg",
      "episode_status": "serializing",
      "status": "Y",
      "region_id": 21,
      "years_id": 4,
      "language_id": 2,
      "starring": "宋康昊",
      "director": "奉俊昊",
      "description": null,
      "views": 0,
      "created_at": "2020-03-16 11:01:03",
      "updated_at": "2020-03-16 11:01:03",
      "comments_count": 0
    }
  ]
}
```

> 電影列表總數

```
{
  "code": "0",
  "data": "3"
}
```

> 電影詳細資訊

```
{
  "code": "0",
  "data": {
    "id": 5,
    "name": "沼澤青蛙",
    "alias": "gogo",
    "image_path": "movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
    "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
    "episode_status": "serializing",
    "status": "Y",
    "region_id": 11,
    "years_id": 15,
    "language_id": 2,
    "starring": "李奧納多皮卡丘,拉不拉多",
    "director": "史蒂芬漢堡",
    "description": "<p><img src=\"https://s3-ap-southeast-1.amazonaws.com/test-media-api/editor_files/WosfHYzgd2KAwgNs52XFEXlJal9VpdRTGccgPqkn.png\">hello</p>",
    "views": 0,
    "created_at": "2020-03-03 14:51:47",
    "updated_at": "2020-03-16 11:13:10",
    "region": {
      "id": 11,
      "name": "台灣",
      "status": "Y",
      "note": null,
      "used_type": "movie",
      "created_at": "2020-02-18 16:24:16",
      "updated_at": "2020-03-04 14:24:25"
    },
    "years": {
      "id": 15,
      "title": "2019",
      "remark": "abc",
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-17 11:07:24",
      "updated_at": "2020-02-17 11:07:24"
    },
    "language": {
      "id": 2,
      "title": "中文",
      "remark": "afwef",
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-17 11:56:23",
      "updated_at": "2020-03-04 14:25:22"
    },
    "genres": [
      {
        "id": 11,
        "title": "驚悚",
        "remark": null,
        "image_path": "classified/genres/image/NKH6mW4N3OcKsiJSzpp8L7HoGotsWnnRrlfam8s2.jpeg",
        "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/classified/genres/image/NKH6mW4N3OcKsiJSzpp8L7HoGotsWnnRrlfam8s2.jpeg",
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-15 16:45:19",
        "updated_at": "2020-02-15 16:45:19",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 11,
          "genres_used_type": "movie"
        }
      },
      {
        "id": 32,
        "title": "社會",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-03-04 14:24:51",
        "updated_at": "2020-03-04 14:24:51",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 32,
          "genres_used_type": "movie"
        }
      },
      {
        "id": 33,
        "title": "搞笑",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-03-04 14:25:01",
        "updated_at": "2020-03-04 14:25:01",
        "pivot": {
          "genres_used_id": 5,
          "genres_id": 33,
          "genres_used_type": "movie"
        }
      }
    ]
  }
}
```

> 電影評論列表

```
{
  "code": "0",
  "data": {
    "id": 5,
    "name": "沼澤青蛙",
    "alias": "gogo",
    "image_path": "movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
    "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/movie/image/RFtAI01HMOLU7eab8X1sTJxDkEMG16dxFaUAn9w5.png",
    "episode_status": "serializing",
    "status": "Y",
    "region_id": 11,
    "years_id": 15,
    "language_id": 2,
    "starring": "李奧納多皮卡丘,拉不拉多",
    "director": "史蒂芬漢堡",
    "description": "<p><img src=\"https://s3-ap-southeast-1.amazonaws.com/test-media-api/editor_files/WosfHYzgd2KAwgNs52XFEXlJal9VpdRTGccgPqkn.png\">hello</p>",
    "views": 0,
    "created_at": "2020-03-03 14:51:47",
    "updated_at": "2020-03-16 11:13:10",
    "comments": [   //評論列表
      {
        "id": 17,
        "account": "summer5",  //發表評論帳號
        "pivot": {
          "commented_id": 5,
          "member_id": 17,
          "commented_type": "movie",
          "contents": "dcssa",  //評論內容
          "created_at": "2020-03-16 17:26:22",
          "updated_at": "2020-03-16 17:26:22"
        }
      },
      {
        "id": 16,
        "account": "test0220",
        "pivot": {
          "commented_id": 5,
          "member_id": 16,
          "commented_type": "movie",
          "contents": "ggggg",
          "created_at": "2020-03-15 17:26:22",
          "updated_at": "2020-03-16 17:26:22"
        }
      },
      {
        "id": 14,
        "account": "summer3",
        "pivot": {
          "commented_id": 5,
          "member_id": 14,
          "commented_type": "movie",
          "contents": "ddddd",
          "created_at": "2020-03-14 17:26:22",
          "updated_at": "2020-03-16 17:26:22"
        }
      }
    ]
  }
}
```

> 電影評論列表總筆數

```
{
  "code": "0",
  "data": "3"
}
```

> 電影影片來源

```
{
  "code": "0",
  "data": [
    {
      "id": 4,
      "title": "暢快雲",
      "remark": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-15 09:42:26",
      "updated_at": "2020-02-15 09:42:26",
      "episode": [
        {
          "id": 55,
          "title": "720P",
          "opening_time": "2020-03-15 09:39:24",
          "status": "Y",
          "views": 1,
          "media_id": "5",
          "media_type": "movie",
          "created_at": "2020-03-11 09:39:28",
          "updated_at": "2020-03-13 20:58:14",
          "sources_url": {
            "source_id": 4,
            "episode_id": 55,
            "url": "http://www.abc.com"
          }
        },
        {
          "id": 61,
          "title": "1080P",
          "opening_time": "2020-02-28 00:00:00",
          "status": "Y",
          "views": 0,
          "media_id": "5",
          "media_type": "movie",
          "created_at": "2020-03-18 14:04:16",
          "updated_at": "2020-03-18 14:04:16",
          "sources_url": {
            "source_id": 4,
            "episode_id": 61,
            "url": "http://video_point.cc"
          }
        }
      ]
    },
    {
      "id": 6,
      "title": "閃電雲",
      "remark": null,
      "status": "Y",
      "used_type": "movie",
      "created_at": "2020-02-15 16:56:34",
      "updated_at": "2020-02-15 16:56:34",
      "episode": [
        {
          "id": 61,
          "title": "1080P",
          "opening_time": "2020-02-28 00:00:00",
          "status": "Y",
          "views": 0,
          "media_id": "5",
          "media_type": "movie",
          "created_at": "2020-03-18 14:04:16",
          "updated_at": "2020-03-18 14:04:16",
          "sources_url": {
            "source_id": 6,
            "episode_id": 61,
            "url": "http://video_fish.cc"
          }
        }
      ]
    }
  ]
}
```

> 地區/類型/年份/語言選單

```
{
  "code": "0",
  "data": {
    "genres": [
      {
        "id": 11,
        "title": "驚悚",
        "remark": null,
        "image_path": "classified/genres/image/NKH6mW4N3OcKsiJSzpp8L7HoGotsWnnRrlfam8s2.jpeg",
        "image_url": "https://s3-ap-southeast-1.amazonaws.com/test-media-api/classified/genres/image/NKH6mW4N3OcKsiJSzpp8L7HoGotsWnnRrlfam8s2.jpeg",
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-15 16:45:19",
        "updated_at": "2020-02-15 16:45:19"
      },
      {
        "id": 32,
        "title": "社會",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-03-04 14:24:51",
        "updated_at": "2020-03-04 14:24:51"
      },
      {
        "id": 33,
        "title": "搞笑",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-03-04 14:25:01",
        "updated_at": "2020-03-04 14:25:01"
      },
      {
        "id": 34,
        "title": "愛情",
        "remark": null,
        "image_path": null,
        "image_url": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-03-04 14:25:08",
        "updated_at": "2020-03-04 14:25:08"
      }
    ],
    "region": [
      {
        "id": 11,
        "name": "台灣",
        "status": "Y",
        "note": null,
        "used_type": "movie",
        "created_at": "2020-02-18 16:24:16",
        "updated_at": "2020-03-04 14:24:25"
      },
      {
        "id": 22,
        "name": "日本",
        "status": "Y",
        "note": null,
        "used_type": "movie",
        "created_at": "2020-03-04 14:24:39",
        "updated_at": "2020-03-04 14:24:39"
      },
      {
        "id": 21,
        "name": "韓國",
        "status": "Y",
        "note": null,
        "used_type": "movie",
        "created_at": "2020-03-04 14:24:33",
        "updated_at": "2020-03-04 14:24:33"
      }
    ],
    "years": [
      {
        "id": 4,
        "title": "2020",
        "remark": "22",
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-17 10:59:41",
        "updated_at": "2020-02-17 11:07:15"
      },
      {
        "id": 15,
        "title": "2019",
        "remark": "abc",
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-17 11:07:24",
        "updated_at": "2020-02-17 11:07:24"
      }
    ],
    "language": [
      {
        "id": 2,
        "title": "中文",
        "remark": "afwef",
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-02-17 11:56:23",
        "updated_at": "2020-03-04 14:25:22"
      },
      {
        "id": 12,
        "title": "日文",
        "remark": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-03-04 14:25:28",
        "updated_at": "2020-03-04 14:25:28"
      },
      {
        "id": 13,
        "title": "泰文",
        "remark": null,
        "status": "Y",
        "used_type": "movie",
        "created_at": "2020-03-04 14:25:35",
        "updated_at": "2020-03-04 14:25:35"
      }
    ]
  }
```

> 是否加入最愛  

```
{
  "code": "0",
  "data": true
}
```
