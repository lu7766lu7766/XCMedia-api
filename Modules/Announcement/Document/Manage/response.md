# 公告管理

> 列表

```
{
         "code": "0",
            "data": [
                {
                    "id": 9,
                    "title": "ee",  //公告標題
                    "contents": "123123", //公告內容
                    "marquee_switch": "Y",  //使否開啟跑馬燈
                    "status": "Y",  //狀態
                    "created_at": "2020-01-13 14:45:05",
                    "updated_at": "2020-01-13 14:45:05",
                    "branches": [  //發佈站台
                        {
                            "id": 1,
                            "name": "qq",  //站台名稱
                            "code": "qq666",  //站台代碼
                            "domain": "qq.cc",  //站台網域
                            "status": "Y",  //狀態
                            "created_at": "2020-01-08 16:20:07",
                            "updated_at": "2020-01-08 16:20:07",
                            "deleted_at": null,
                            "pivot": {
                                "published_source_id": 9,
                                "branch_id": 1,
                                "published_source_type": "Modules\\Announcement\\Entities\\Announcement"
                            }
                        }
                    ],
                    "editor_files": [  //文字編輯器圖片
                        {
                            "id": 2,
                            "file_path": "editorFiles/mVivWJBz6UvOmgGhRBM66hYZFIM7HoYo1C5KkNfZ.jpeg",  //圖片位置
                            "file_url": "http://localhost/storage/editorFiles/mVivWJBz6UvOmgGhRBM66hYZFIM7HoYo1C5KkNfZ.jpeg", //圖片連結(前端請使用此欄位)
                            "created_at": "2020-01-13 14:37:46",
                            "updated_at": "2020-01-13 14:37:46",
                            "pivot": {
                                "used_id": 9,
                                "editor_file_id": 2,
                                "used_type": "Modules\\Announcement\\Entities\\Announcement"
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
   "data": "2"
}
```


> 新增

```
{
    "code": "0",
       "data": {
           "title": "ee",
           "contents": "123123",
           "marquee_switch": "Y",
           "status": "Y",
           "updated_at": "2020-01-07 18:25:27",
           "created_at": "2020-01-07 18:25:27",
           "id": 18,
           "branches": [  //發佈站台
               {
                   "id": 1,
                   "name": "qq",  
                   "code": "qq666",  
                   "domain": "qq.cc",  
                   "status": "Y",  
                   "created_at": "2020-01-07 12:59:05",
                   "updated_at": "2020-01-07 12:59:05",
                   "deleted_at": null,
                   "pivot": {
                       "published_source_id": 18,
                       "branch_id": 1,
                       "published_source_type": "Modules\\Announcement\\Entities\\Announcement"
                   }
               },
               {
                   "id": 2,
                   "name": "qq2",
                   "code": "qq6662",
                   "domain": "qq.cc",
                   "status": "Y",
                   "created_at": "2020-01-07 12:59:08",
                   "updated_at": "2020-01-07 12:59:08",
                   "deleted_at": null,
                   "pivot": {
                       "published_source_id": 18,
                       "branch_id": 2,
                       "published_source_type": "Modules\\Announcement\\Entities\\Announcement"
                   }
               }
           ],           
           "editor_files": [  
               {
                   "id": 2,
                   "file_path": "editorFiles/mVivWJBz6UvOmgGhRBM66hYZFIM7HoYo1C5KkNfZ.jpeg", 
                   "file_url": "http://localhost/storage/editorFiles/mVivWJBz6UvOmgGhRBM66hYZFIM7HoYo1C5KkNfZ.jpeg",
                   "created_at": "2020-01-13 14:37:46",
                   "updated_at": "2020-01-13 14:37:46",
                   "pivot": {
                       "used_id": 9,
                       "editor_file_id": 2,
                       "used_type": "Modules\\Announcement\\Entities\\Announcement"
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
           "id": 16,
           "title": "ee",
           "contents": "123123",
           "marquee_switch": "Y",
           "status": "Y",
           "created_at": "2020-01-07 18:23:58",
           "updated_at": "2020-01-07 18:23:58",
           "branches": [
               {
                   "id": 1,
                   "name": "qq",
                   "code": "qq666",
                   "domain": "qq.cc",
                   "status": "Y",
                   "created_at": "2020-01-07 12:59:05",
                   "updated_at": "2020-01-07 12:59:05",
                   "deleted_at": null,
                   "pivot": {
                       "published_source_id": 16,
                       "branch_id": 1,
                       "published_source_type": "Modules\\Announcement\\Entities\\Announcement"
                   }
               },
               {
                   "id": 2,
                   "name": "qq2",
                   "code": "qq6662",
                   "domain": "qq.cc",
                   "status": "Y",
                   "created_at": "2020-01-07 12:59:08",
                   "updated_at": "2020-01-07 12:59:08",
                   "deleted_at": null,
                   "pivot": {
                       "published_source_id": 16,
                       "branch_id": 2,
                       "published_source_type": "Modules\\Announcement\\Entities\\Announcement"
                   }
               }
           ],           
           "editor_files": [  
               {
                   "id": 2,
                   "file_path": "editorFiles/mVivWJBz6UvOmgGhRBM66hYZFIM7HoYo1C5KkNfZ.jpeg", 
                   "file_url": "http://localhost/storage/editorFiles/mVivWJBz6UvOmgGhRBM66hYZFIM7HoYo1C5KkNfZ.jpeg",
                   "created_at": "2020-01-13 14:37:46",
                   "updated_at": "2020-01-13 14:37:46",
                   "pivot": {
                       "used_id": 9,
                       "editor_file_id": 2,
                       "used_type": "Modules\\Announcement\\Entities\\Announcement"
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
           "id": 16,
           "title": "eedddd",
           "contents": "123123",
           "marquee_switch": "Y",
           "status": "Y",
           "created_at": "2020-01-07 18:23:58",
           "updated_at": "2020-01-07 18:27:32",
           "branches": [
               {
                   "id": 1,
                   "name": "qq",
                   "code": "qq666",
                   "domain": "qq.cc",
                   "status": "Y",
                   "created_at": "2020-01-07 12:59:05",
                   "updated_at": "2020-01-07 12:59:05",
                   "deleted_at": null,
                   "pivot": {
                       "published_source_id": 16,
                       "branch_id": 1,
                       "published_source_type": "Modules\\Announcement\\Entities\\Announcement"
                   }
               }
           ],           
           "editor_files": [  
               {
                   "id": 2,
                   "file_path": "editorFiles/mVivWJBz6UvOmgGhRBM66hYZFIM7HoYo1C5KkNfZ.jpeg", 
                   "file_url": "http://localhost/storage/editorFiles/mVivWJBz6UvOmgGhRBM66hYZFIM7HoYo1C5KkNfZ.jpeg",
                   "created_at": "2020-01-13 14:37:46",
                   "updated_at": "2020-01-13 14:37:46",
                   "pivot": {
                       "used_id": 9,
                       "editor_file_id": 2,
                       "used_type": "Modules\\Announcement\\Entities\\Announcement"
                   }
               }
           ]
       }
}
```

> 刪除

```
{
    "data": "1",
      "code": "0"
}
```

> 站台列表

```
{
    "code": "0",
        "data": [
            {
                "id": 2,
                "name": "qq2",  //站台名稱
                "code": "qq6662",   //站台代碼
                "domain": "qq.cc",  //站台網域
                "status": "Y",  //站台狀態
                "created_at": "2020-01-07 12:59:08",
                "updated_at": "2020-01-07 12:59:08",
                "deleted_at": null
            },
            {
                "id": 1,
                "name": "qq",
                "code": "qq666",
                "domain": "qq.cc",
                "status": "Y",
                "created_at": "2020-01-07 12:59:05",
                "updated_at": "2020-01-07 12:59:05",
                "deleted_at": null
            }
        ]
}
```

> 圖片上傳

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

> 圖片刪除

```
{
    "data": "1",
      "code": "0"
}
```
