# 會員

> 註冊

```
{
    "code": "0",
    "data": {
        "account": "6554654d",
        "status": "enable",
        "branch_id": 1,
        "updated_at": "2020-02-15 15:45:18",
        "created_at": "2020-02-15 15:45:18",
        "id": 3
    }
}
```

> 取得註冊驗證碼

```
{
   "code": "0",
      "data": {
          "connect_success": true,
          "http_status_code": 200,
          "api_result_success": true,
          "body": {
              "Message": "OK",
              "Code": "OK",
              "RequestId": "",
              "BizId": ""
          },
          "code": "OK",  //與message同為ok時即為成功
          "message": "OK",//與code同為ok時即為成功
          "request_id": "",
          "biz_id": ""
      }
}
```

> 登出

```
{
    "code": "0",
    "data": true
}
```

> 帳號明細  

```
{
    "code": "0",
    "data": {
        "id": 1,
        "branch_id": 1,
        "account": "test",
        "display_name": null,
        "status": "enable",
        "mail": "a888@gmail.com",
        "mail_approve": "N",
        "phone": "098555414014",
        "phone_approve": "N",
        "remark": null,
        "created_at": null,
        "updated_at": "2020-02-18 19:17:39",
        "deleted_at": null
    }
}
```



> 更新帳號  

```
{
    "code": "0",
    "data": {
        "id": 1,
        "branch_id": 1,
        "account": "test",
        "display_name": null,
        "status": "enable",
        "mail": "a004@gmail.com",
        "mail_approve": "N",
        "phone": "1013456487",
        "phone_approve": "N",
        "remark": null,
        "created_at": null,
        "updated_at": "2020-02-18 19:20:34",
        "deleted_at": null
    }
}
```


> 更新密碼  

```
{
    "code": "0",
    "data": {
        "id": 1,
        "branch_id": 1,
        "account": "test",
        "display_name": null,
        "status": "enable",
        "mail": "a004@gmail.com",
        "mail_approve": "N",
        "phone": "1013456487",
        "phone_approve": "N",
        "remark": null,
        "created_at": null,
        "updated_at": "2020-02-18 19:20:34",
        "deleted_at": null
    }
}
```



# 我的收藏

> 列表  


```
{
     "code": "0",
        "data": [
            {
                "id": 36,
                "member_id": 1,  //會員id
                "media_id": 2,  //影音id
                "media_type": "variety",  //影音類型
                "media": { //影音
                    "id": 2,
                    "title": "qwe123123",  //名稱
                    "alias": "qqwe",  //別名
                    "image_path": null,  //圖片位置
                    "image_url": null,  //圖片連結
                    "episode_status": "end",  //劇集狀態(serializing:連載中，end:完結)
                    "status": "Y",  //狀態
                    "host": "123,456,789",  //主持
                    "guest": "qwe,dsa,as",   //來賓
                    "region_id": 2,  //地區id
                    "years_id": 21,  // 年份id
                    "language_id": 6,  //語言id
                    "description": "6666789",//描述
                    "views": 0,  //觀看次數
                    "created_at": "2020-02-17 19:17:29",
                    "updated_at": "2020-02-17 19:17:29"
                }
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

> 刪除

```
{
   "code": "0",
   "data": "1"
}
```


> 刪除全部收藏

```
{
   "code": "0",
   "data": "2"
}
```

> 觀看記錄清單(戲劇/電影/動漫/綜藝)

```
{
    "code": "0",
    "data": [
        {
            "id": 1,
            "member_id": 1,
            "media_id": 1,
            "media_type": "episode",
            "created_at": null,
            "updated_at": null,
            "read_able": null,
            "media": {
                "id": 1,
                "title": "test", //影片集數名稱
                "opening_time": "2020-03-06 15:45:21",
                "status": "Y",
                "views": 0,
                "media_id": "1",
                "media_type": "drama",
                "created_at": "2020-03-06 15:45:31",
                "updated_at": "2020-03-06 15:45:39",
                "sources": [
                    {
                        "id": 2,
                        "title": "5",
                        "remark": null,
                        "status": "Y",
                        "used_type": "anime",
                        "created_at": "2020-02-03 16:57:01",
                        "updated_at": "2020-02-03 16:57:01",
                        "sources_url": {
                            "episode_id": 1,
                            "source_id": 2,
                            "url": "1111" //來源網址
                        }
                    }
                ],
                "episode_able": null,
                "media": {
                    "id": 1,
                    "title": "test",//節目表名稱
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
                }
            }
        }
}
```

> 觀看記錄總數(戲劇/電影/動漫/綜藝)

```
{
    "data": "1",
    "code": "0"
}
```

> 觀看記錄總數類型

```
{
    "code": "0",
    "data": [
        "movie",
        "drama",
        "anime",
        "variety"
    ]
}
```

> 清除觀看記錄
```
{
    "data": "1",
    "code": "0"
}
```

>新增觀看紀錄

```
    "code": "0",
    "data": {
        "id": 3,
        "title": "123",
        "opening_time": "2020-03-06 15:53:01",
        "status": "Y",
        "views": 1,
        "media_id": "2",
        "media_type": "drama",
        "created_at": "2020-03-06 15:53:01",
        "updated_at": "2020-03-06 15:53:01",
        "series": {
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
    }
```

>是否為收藏

```
    "code": "0",
       "data": {
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
           "my_favorite": [
               {
                   "id": 40,
                   "member_id": 1,
                   "media_id": 3,
                   "media_type": "drama",
                   "media": {
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
                       "views": 44,
                       "created_at": "2020-02-14 17:13:55",
                       "updated_at": "2020-03-23 11:11:31"
                   }
               }
           ]
       }
```

