# 採集設定

> 列表

```
{
    "code": "0",
       "data": [
           {
               "id": 11,
               "collector_source_id": 1,  //資源id
               "status": "N", //狀態
               "created_at": "2020-05-07 16:19:11",
               "updated_at": "2020-05-07 16:19:11",
               "type": [ //類型
                   {
                       "id": 2,
                       "title": "连续剧", //類型名稱
                       "status": "Y",  //狀態
                       "created_at": "2020-05-06 20:25:43",
                       "updated_at": "2020-05-06 20:25:43",
                       "pivot": {
                           "setting_id": 11,
                           "type_id": 2
                       }
                   }
               ],
               "platform": [  //平台
                   {
                       "id": 1,
                       "title": "爱奇艺",  //名稱
                       "code": "qiyi",  //代碼
                       "status": "Y",  //狀態
                       "created_at": "2020-05-06 20:25:43",
                       "updated_at": "2020-05-06 20:25:43",
                       "pivot": {
                           "setting_id": 11,
                           "platform_id": 1
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
          "status": "N",
          "collector_source_id": 1,
          "updated_at": "2020-05-07 16:34:55",
          "created_at": "2020-05-07 16:34:55",
          "id": 12,
          "type": [
              {
                  "id": 2,
                  "title": "连续剧",
                  "status": "Y",
                  "created_at": "2020-05-06 20:25:43",
                  "updated_at": "2020-05-06 20:25:43",
                  "pivot": {
                      "setting_id": 12,
                      "type_id": 2
                  }
              }
          ],
          "platform": [
              {
                  "id": 1,
                  "title": "爱奇艺",
                  "code": "qiyi",
                  "status": "Y",
                  "created_at": "2020-05-06 20:25:43",
                  "updated_at": "2020-05-06 20:25:43",
                  "pivot": {
                      "setting_id": 12,
                      "platform_id": 1
                  }
              }
          ]
      }
}
```

> 編輯

```
{
   "code": "0",
      "data": {
          "status": "N",
          "collector_source_id": 1,
          "updated_at": "2020-05-07 16:34:55",
          "created_at": "2020-05-07 16:34:55",
          "id": 12,
          "type": [
              {
                  "id": 2,
                  "title": "连续剧",
                  "status": "Y",
                  "created_at": "2020-05-06 20:25:43",
                  "updated_at": "2020-05-06 20:25:43",
                  "pivot": {
                      "setting_id": 12,
                      "type_id": 2
                  }
              }
          ],
          "platform": [
              {
                  "id": 1,
                  "title": "爱奇艺",
                  "code": "qiyi",
                  "status": "Y",
                  "created_at": "2020-05-06 20:25:43",
                  "updated_at": "2020-05-06 20:25:43",
                  "pivot": {
                      "setting_id": 12,
                      "platform_id": 1
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
          "status": "N",
          "collector_source_id": 1,
          "updated_at": "2020-05-07 16:34:55",
          "created_at": "2020-05-07 16:34:55",
          "id": 12,
          "type": [
              {
                  "id": 2,
                  "title": "连续剧",
                  "status": "Y",
                  "created_at": "2020-05-06 20:25:43",
                  "updated_at": "2020-05-06 20:25:43",
                  "pivot": {
                      "setting_id": 12,
                      "type_id": 2
                  }
              }
          ],
          "platform": [
              {
                  "id": 1,
                  "title": "爱奇艺",
                  "code": "qiyi",
                  "status": "Y",
                  "created_at": "2020-05-06 20:25:43",
                  "updated_at": "2020-05-06 20:25:43",
                  "pivot": {
                      "setting_id": 12,
                      "platform_id": 1
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

> 取得資源列表

```
{
     "data": [
           {
               "id": 1,
               "title": "摩拜资源",  //名稱
               "url": "http://mbaijx.com/api.php/provide/vod/at/xml/",  //連結
               "status": "Y",  //狀態
               "created_at": "2020-05-06 20:25:43",
               "updated_at": "2020-05-06 20:25:43"
           },
           {
               "id": 3,
               "title": "萌果资源",
               "url": "http://api.awu1k.cn/api.php/provide/vod/at/xml/ ",
               "status": "Y",
               "created_at": "2020-05-07 16:12:15",
               "updated_at": "2020-05-07 16:12:15"
           }
       ]
}
```

> 取得類型列表

```
{
     "code": "0",
        "data": [
            {
                "id": 1,
                "title": "电影",
                "code": "movie",
                "status": "Y",
                "created_at": "2020-05-08 20:27:13",
                "updated_at": "2020-05-08 20:27:13"
            },
            {
                "id": 2,
                "title": "连续剧",
                "code": "drama",
                "status": "Y",
                "created_at": "2020-05-08 20:27:13",
                "updated_at": "2020-05-08 20:27:13"
            },
            {
                "id": 3,
                "title": "综艺",
                "code": "variety",
                "status": "Y",
                "created_at": "2020-05-08 20:27:13",
                "updated_at": "2020-05-08 20:27:13"
            },
            {
                "id": 4,
                "title": "动漫",
                "code": "anime",
                "status": "Y",
                "created_at": "2020-05-08 20:27:13",
                "updated_at": "2020-05-08 20:27:13"
            }
        ]
}
```


> 取得類型列表

```
{
     "code": "0",
        "data": [
            {
                "id": 1,
                "title": "爱奇艺",
                "code": "qiyi",
                "status": "Y",
                "created_at": "2020-05-08 20:27:13",
                "updated_at": "2020-05-08 20:27:13"
            },
            {
                "id": 2,
                "title": "腾讯",
                "code": "qq",
                "status": "Y",
                "created_at": "2020-05-08 20:27:13",
                "updated_at": "2020-05-08 20:27:13"
            },
            {
                "id": 3,
                "title": "搜狐",
                "code": "sohu",
                "status": "Y",
                "created_at": "2020-05-08 20:27:13",
                "updated_at": "2020-05-08 20:27:13"
            },
            {
                "id": 4,
                "title": "芒果",
                "code": "mgtv",
                "status": "Y",
                "created_at": "2020-05-08 20:27:13",
                "updated_at": "2020-05-08 20:27:13"
            },
            {
                "id": 5,
                "title": "优酷",
                "code": "youku",
                "status": "Y",
                "created_at": "2020-05-08 20:27:13",
                "updated_at": "2020-05-08 20:27:13"
            },
            {
                "id": 11,
                "title": "pptv",
                "code": "pptv",
                "status": "Y",
                "created_at": "2020-05-09 20:57:39",
                "updated_at": "2020-05-09 20:57:39"
            },
            {
                "id": 12,
                "title": "wasu",
                "code": "wasu",
                "status": "Y",
                "created_at": "2020-05-09 20:57:46",
                "updated_at": "2020-05-09 20:57:46"
            },
            {
                "id": 13,
                "title": "funshion",
                "code": "funshion",
                "status": "Y",
                "created_at": "2020-05-09 20:57:46",
                "updated_at": "2020-05-09 20:57:46"
            },
            {
                "id": 14,
                "title": "letv",
                "code": "letv",
                "status": "Y",
                "created_at": "2020-05-09 20:57:49",
                "updated_at": "2020-05-09 20:57:49"
            }
        ]
}
```
