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
            "title": "test",
            "alias": "test",
            "image_path": null,
            "image_url": null,
            "episode_status": "serializing",
            "status": "Y",
            "starring": null,
            "director": null,
            "region_id": 2,
            "years_id": 1,
            "language_id": 1,
            "description": null,
            "views": 0,
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 2,
            "title": "test2",
            "alias": "test2",
            "image_path": null,
            "image_url": null,
            "episode_status": "serializing",
            "status": "Y",
            "starring": null,
            "director": null,
            "region_id": 7,
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

# 戲劇

> 列表

```
{
    "code": "0",
        "data": [
            {
                "id": 3,
                "title": "qwe123123",  //名稱
                "alias": "qqwe",  //別名
                "image_path": "COahuXNP8UoGrkUuUxlaFpoEOPPjFdUpq0rQmiIl.jpeg", //圖片位置
                "image_url": "http://localhost/storage/COahuXNP8UoGrkUuUxlaFpoEOPPjFdUpq0rQmiIl.jpeg", //圖片連結
                "episode_status": "end",  //劇集狀態 (連載中:serializing,完結:end)    
                "status": "Y", //狀態
                "starring": "123,456,789",  //主演
                "director": "qwe,dsa,as",  //導演
                "region_id": 1,  
                "years_id": 4,  
                "language_id": 3,
                "description": "6666789",  //描述
                "views": 30,  //觀看數
                "created_at": "2020-02-14 17:13:55",
                "updated_at": "2020-03-16 18:18:37",               
                "comments_count": 18,  //評論數
                 "episodes": [
                               {
                                   "id": 57,
                                   "title": "qwe11",  //名稱
                                   "opening_time": "2020-01-01 00:00:02",  //開播時間
                                   "status": "Y",  //狀態
                                   "views": 0,
                                   "media_id": "3",
                                   "media_type": "drama",
                                   "created_at": "2020-03-09 16:27:37",
                                   "updated_at": "2020-03-09 16:27:37"
                               },
                               {
                                   "id": 56,
                                   "title": "qwe11",
                                   "opening_time": "2020-01-01 00:00:02",
                                   "status": "Y",
                                   "views": 0,
                                   "media_id": "3",
                                   "media_type": "drama",
                                   "created_at": "2020-03-09 16:27:36",
                                   "updated_at": "2020-03-09 16:27:36"
                               }
                           ]
            }
        ]
}
```


> 總數

```
{
        "code": "0"
     "data": "11",
}
```


> 內頁

```
{ "code": "0",
     "data": {
         "id": 3,
         "title": "qwe123123",
         "alias": "qqwe",
         "image_path": "COahuXNP8UoGrkUuUxlaFpoEOPPjFdUpq0rQmiIl.jpeg",
         "image_url": "http://localhost/storage/COahuXNP8UoGrkUuUxlaFpoEOPPjFdUpq0rQmiIl.jpeg",
         "episode_status": "end",
         "status": "Y",
         "starring": "123,456,789",
         "director": "qwe,dsa,as",
         "region_id": 1,
         "years_id": 4,
         "language_id": 3,
         "description": "6666789",
         "views": 31,
         "created_at": "2020-02-14 17:13:55",
         "updated_at": "2020-03-16 18:18:37",
         "years": {  //年份
             "id": 4,
             "title": "eee",  //名稱
             "remark": null,  //備註
             "status": "Y",  //狀態
             "used_type": "drama",
             "created_at": "2020-01-20 19:31:46",
             "updated_at": "2020-01-20 19:31:46"
         },
         "region": { //地區
             "id": 1,
             "name": "1",  //名稱
             "status": "Y",  //狀態
             "note": null,  //備註
             "used_type": "drama",
             "created_at": null,
             "updated_at": null
         },
         "genres": [  //類型
             {
                 "id": 1,
                 "title": "1",  //名稱
                 "remark": null,  //備註
                 "image_path": null,  //圖片位置
                 "image_url": null,  //圖片連結
                 "status": "Y",  //狀態
                 "used_type": "drama",
                 "created_at": null,
                 "updated_at": null,
                 "pivot": {
                     "genres_used_id": 3,
                     "genres_id": 1,
                     "genres_used_type": "drama"
                 }
             }
         ],
         "my_favorite": [ //若為空陣列表示尚未收藏
                     {
                         "id": 1,
                         "branch_id": 1,
                         "account": "test123",
                         "display_name": null,
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
                             "media_id": 3,
                             "member_id": 1,
                             "media_type": "drama"
                         }
                     }
                 ]
     }
}
```


> 選項

```
{
      "code": "0",
         "data": {
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
                     "updated_at": null
                 }
             ],
             "region": [
                 {
                     "id": 1,
                     "name": "1",
                     "status": "Y",
                     "note": null,
                     "used_type": "drama",
                     "created_at": null,
                     "updated_at": null
                 }
             ],
             "years": [
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
}
```

> 評論列表

```
{
       "code": "0",
          "data": [
              {
                  "member_id": 2,
                  "contents": "爛",  //評論內容
                  "commented_id": 3,
                  "commented_type": "drama",
                  "created_at": "2020-03-17 11:56:47",
                  "updated_at": "2020-03-17 11:56:47",
                  "member": {  //會員
                      "id": 2,
                      "branch_id": 1,
                      "account": "test321",  //帳號
                      "display_name": null,  //名稱
                      "status": "enable",  //狀態
                      "mail": null,
                      "mail_approve": "N",
                      "phone": null,
                      "phone_approve": "N",
                      "remark": null,
                      "created_at": null,
                      "updated_at": null,
                      "deleted_at": null
                  }
              }
          ]
}
```


> 評論總數

```
{
        "code": "0"
     "data": "11",
}
```


> 影片來源

```
{
     "code": "0",
         "data": [
             {
                 "id": 2,
                 "title": "eee",
                 "remark": null,
                 "status": "Y",
                 "used_type": "drama",
                 "created_at": "2020-01-20 18:13:00",
                 "updated_at": "2020-01-20 18:13:00",
                 "episode": [  //集數
                     {
                         "id": 56,
                         "title": "qwe11",  //名稱
                         "opening_time": "2020-01-01 00:00:02",  //開播時間
                         "status": "Y",  //狀態
                         "views": 0,  //觀看次數
                         "media_id": "3",
                         "media_type": "drama",
                         "created_at": "2020-03-09 16:27:36",
                         "updated_at": "2020-03-09 16:27:36",
                         "sources_url": {  //來源連結
                             "source_id": 2,
                             "episode_id": 56,
                             "url": "111"  //連結
                         }
                     }
                 ]
             }
         ]
}
```
