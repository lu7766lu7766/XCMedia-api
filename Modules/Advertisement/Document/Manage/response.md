# 廣告管理

> 列表

```
{
   "code": "0",
      "data": [
          {
              "id": 1,
              "type_id": 2, //類型id
              "title": "2qweqweqwe",  //標題
              "url": null,  //連結
              "image_path": "advertisement/image/n4XkKlg4ZCVhpwF6J3Iz98NAlKbXYWau77NyiejF.jpeg", //圖片位置
              "image_url": "http://localhost/storage/advertisement/image/n4XkKlg4ZCVhpwF6J3Iz98NAlKbXYWau77NyiejF.jpeg", //圖片連結
              "is_blank": "N",  //是否另開視窗
              "status": "Y", //狀態
              "created_at": "2020-01-09 16:44:11",
              "updated_at": "2020-01-09 18:38:42",
              "hits": 0,  //點擊次數
              "type": {//類型
                  "id": 2,
                  "name": "首頁-分隔區塊"  //類型名稱
              },
              "branches": [  //站台
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
                          "published_source_id": 1,
                          "branch_id": 1,
                          "published_source_type": "Modules\\Advertisement\\Entities\\Advertisement"
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
           "title": "test",
           "url": null,
           "is_blank": "N",
           "status": "Y",
           "image_path": "advertisement/image/wYwR0eKaykxMLA3bvpCN0GqS5sHxXAIJYbYi2Xuk.jpeg",
           "image_url": "http://localhost/storage/advertisement/image/wYwR0eKaykxMLA3bvpCN0GqS5sHxXAIJYbYi2Xuk.jpeg",
           "type_id": 1,
           "updated_at": "2020-01-09 19:02:35",
           "created_at": "2020-01-09 19:02:35",
           "id": 3,
           "type": {
               "id": 1,
               "name": "首頁-輪播區塊"
           },
           "branches": [
               {
                   "id": 1,
                   "name": "qq",
                   "code": "qq666",
                   "domain": "qq.cc",
                   "status": "Y",
                   "created_at": "2020-01-08 16:20:07",
                   "updated_at": "2020-01-08 16:20:07",
                   "deleted_at": null,
                   "pivot": {
                       "published_source_id": 3,
                       "branch_id": 1,
                       "published_source_type": "Modules\\Advertisement\\Entities\\Advertisement"
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
           "type_id": 2,
           "title": "2qweqweqwe",
           "url": null,
           "image_path": "advertisement/image/n4XkKlg4ZCVhpwF6J3Iz98NAlKbXYWau77NyiejF.jpeg",
           "image_url": "http://localhost/storage/advertisement/image/n4XkKlg4ZCVhpwF6J3Iz98NAlKbXYWau77NyiejF.jpeg",
           "is_blank": "N",
           "status": "Y",
           "created_at": "2020-01-09 16:44:11",
           "updated_at": "2020-01-09 18:38:42",
           "hits": 0,
           "type": {
               "id": 2,
               "name": "首頁-分隔區塊"
           },
           "branches": [
               {
                   "id": 1,
                   "name": "qq",
                   "code": "qq666",
                   "domain": "qq.cc",
                   "status": "Y",
                   "created_at": "2020-01-08 16:20:07",
                   "updated_at": "2020-01-08 16:20:07",
                   "deleted_at": null,
                   "pivot": {
                       "published_source_id": 1,
                       "branch_id": 1,
                       "published_source_type": "Modules\\Advertisement\\Entities\\Advertisement"
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
            "type_id": 2,
            "title": "2qweqweqwe",
            "url": null,
            "image_path": "advertisement/image/n4XkKlg4ZCVhpwF6J3Iz98NAlKbXYWau77NyiejF.jpeg",
            "image_url": "http://localhost/storage/advertisement/image/n4XkKlg4ZCVhpwF6J3Iz98NAlKbXYWau77NyiejF.jpeg",
            "is_blank": "N",
            "status": "Y",
            "created_at": "2020-01-09 16:44:11",
            "updated_at": "2020-01-09 18:38:42",
            "type": {
                "id": 2,
                "name": "首頁-分隔區塊"
            },
            "branches": [
                {
                    "id": 1,
                    "name": "qq",
                    "code": "qq666",
                    "domain": "qq.cc",
                    "status": "Y",
                    "created_at": "2020-01-08 16:20:07",
                    "updated_at": "2020-01-08 16:20:07",
                    "deleted_at": null,
                    "pivot": {
                        "published_source_id": 1,
                        "branch_id": 1,
                        "published_source_type": "Modules\\Advertisement\\Entities\\Advertisement"
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

> 類型列表

```
{
    "code": "0",
        "data": [
            {
                "id": 1,
                "name": "首頁-輪播區塊"
            },
            {
                "id": 2,
                "name": "首頁-分隔區塊"
            },
            {
                "id": 3,
                "name": "列表-上方區塊"
            },
            {
                "id": 4,
                "name": "列表-下方區塊"
            },
            {
                "id": 5,
                "name": "內頁-右方區塊"
            },
            {
                "id": 6,
                "name": "內頁-分隔區塊"
            }
        ]
}
```
