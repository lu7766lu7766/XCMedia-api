# 成人視頻 > 視頻管理

> 列表  

| 項目        | 內容                            | 類型     | 預設  | 說明      | 必填  |
| --------- | ----------------------------- | ------ | --- | ------- | --- |
| <b>路徑</b> | manage/adult_video            |        |     |         |     |
| <b>方法</b> | GET                           |        |     |         |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_READ |        |     | -       |     |
| <b>參數</b> |                               |        |     |         |     |
|           | region_id                     | int    |     | 地區id    | x   |
|           | av_actress_ids                | array  |     | 女優ids   | x   |
|           | cup_id                        | int    |     | 罩杯id    | x   |
|           | years_id                      | int    |     | 年分id    | x   |
|           | status                        | string |     | 狀態(Y/N) | x   |
|           | keyword                       | string |     | 關鍵字     | x   |
|           | page                          | int    | 1   | 分頁      | x   |
|           | perpage                       | int    | 20  | 每頁筆數    | x   |

> 總數  

| 項目        | 內容                            | 類型     | 預設  | 說明      | 必填  |
| --------- |:----------------------------- |:------:| --- |:-------:|:---:|
| <b>路徑</b> | manage/adult_video/total      |        |     |         |     |
| <b>方法</b> | GET                           |        |     |         |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_READ |        |     | -       |     |
| <b>參數</b> |                               |        |     |         |     |
|           | region_id                     | int    |     | 地區id    | x   |
|           | av_actress_ids                | array  |     | 女優ids   | x   |
|           | cup_id                        | int    |     | 罩杯id    | x   |
|           | years_id                      | int    |     | 年分id    | x   |
|           | status                        | string |     | 狀態(Y/N) | x   |
|           | keyword                       | string |     | 關鍵字     | x   |

> 創建  

| 項目        | 內容                              | 類型     | 預設  | 說明      | 必填  |
| --------- | ------------------------------- | ------ | --- | ------- |:---:|
| <b>路徑</b> | manage/adult_video              |        |     |         |     |
| <b>方法</b> | POST                            |        |     |         |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_CREATE |        |     | -       |     |
| <b>參數</b> |                                 |        |     |         |     |
|           | title                           | string |     | 名稱      | o   |
|           | cover                           | image  |     | 圖片      | x   |
|           | alias                           | string |     | 別名      | x   |
|           | region_id                       | int    |     | 地區id    | o   |
|           | av_actress_ids                  | array  |     | 女優ids   | o   |
|           | cup_id                          | int    |     | 罩杯id    | o   |
|           | genres_ids                      | array  |     | 類型ids   | o   |
|           | years_id                        | int    |     | 年分id    | o   |
|           | tags                            | array  |     | 標籤      | x   |
|           | status                          | string |     | 狀態(Y/N) | o   |
|           | description                     | string |     | 描述      | x   |
|           |views                   | int  |       0     |    瀏覽次數(人氣 )   |  x  |
|           |score                   | float  |      0  |   評分(0.0 ~ 10.0)    |  x  |
|           | editor_image_ids                | array  |     | 編輯器id   | x   |

> 明細  

| 項目        | 內容                              | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------------------- | --- | --- | --- |:---:|
| <b>路徑</b> | manage/adult_video/info         |     |     |     |     |
| <b>方法</b> | GET                             |     |     |     |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_CREATE |     |     | -   |     |
| <b>參數</b> |                                 |     |     |     |     |
|           | id                              | int |     | id  | o   |

> 更新  

| 項目        | 內容                              | 類型     | 預設  | 說明      | 必填  |
| --------- | ------------------------------- | ------ | --- | ------- |:---:|
| <b>路徑</b> | manage/adult_video/update       |        |     |         |     |
| <b>方法</b> | POST                            |        |     |         |     |
| <b>權限</b> | VIDEO_AV_ACTRESS_SETTING_UPDATE |        |     | -       |     |
| <b>參數</b> |                                 |        |     |         |     |
|           | id                              | int    |     | id      | o   |
|           | title                           | string |     | 名稱      | o   |
|           | cover                           | image  |     | 圖片      | x   |
|           | alias                           | string |     | 別名      | x   |
|           | region_id                       | int    |     | 地區id    | o   |
|           | av_actress_ids                  | array  |     | 女優ids   | o   |
|           | cup_id                          | int    |     | 罩杯id    | o   |
|           | genres_ids                      | array  |     | 類型ids   | o   |
|           | years_id                        | int    |     | 年分id    | o   |
|           | tags                            | array  |     | 標籤      | x   |
|           | status                          | string |     | 狀態(Y/N) | o   |
|           | description                     | string |     | 描述      | x   |
|           |views                   | int  |       0     |    瀏覽次數(人氣 )   |  x  |
|           |score                   | float  |      0  |   評分(0.0 ~ 10.0)    |  x  |
|           | editor_image_ids                | array  |     | 編輯器id   | x   |
|             |remove_image                 | boolean        |              |  刪除圖片,請送1(true)或0(false)         |  x   |

> 刪除  

| 項目        | 內容                              | 類型  | 預設  | 說明  | 必填  |
| --------- |:------------------------------- |:---:|:---:|:---:|:---:|
| <b>路徑</b> | manage/adult_video              |     |     |     |     |
| <b>方法</b> | DELETE                          |     |     |     |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_DELETE |     |     | -   |     |
| <b>參數</b> |                                 |     |     |     |     |
|           | id                              | int |     | id  | o   |

> 地區  

| 項目        | 內容                            | 類型  | 預設  | 說明  | 必填  |
| --------- |:----------------------------- |:---:|:---:|:---:|:---:|
| <b>路徑</b> | manage/adult_video/region     |     |     |     |     |
| <b>方法</b> | GET                           |     |     |     |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_READ |     |     | -   |     |
| <b>參數</b> |                               |     |     |     |     |

> 女優  

| 項目        | 內容                            | 類型  | 預設  | 說明  | 必填  |
| --------- |:----------------------------- |:---:|:---:|:---:|:---:|
| <b>路徑</b> | manage/adult_video/actress    |     |     |     |     |
| <b>方法</b> | GET                           |     |     |     |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_READ |     |     | -   |     |
| <b>參數</b> |                               |     |     |     |     |

> 罩杯  

| 項目        | 內容                            | 類型  | 預設  | 說明  | 必填  |
| --------- |:----------------------------- |:---:|:---:|:---:|:---:|
| <b>路徑</b> | manage/adult_video/cup        |     |     |     |     |
| <b>方法</b> | GET                           |     |     |     |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_READ |     |     | -   |     |
| <b>參數</b> |                               |     |     |     |     |

> 類型  

| 項目        | 內容                            | 類型  | 預設  | 說明  | 必填  |
| --------- |:----------------------------- |:---:|:---:|:---:|:---:|
| <b>路徑</b> | manage/adult_video/genres     |     |     |     |     |
| <b>方法</b> | GET                           |     |     |     |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_READ |     |     | -   |     |
| <b>參數</b> |                               |     |     |     |     |

> 年分  

| 項目        | 內容                            | 類型  | 預設  | 說明  | 必填  |
| --------- |:----------------------------- |:---:|:---:|:---:|:---:|
| <b>路徑</b> | manage/adult_video/years      |     |     |     |     |
| <b>方法</b> | GET                           |     |     |     |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_READ |     |     | -   |     |
| <b>參數</b> |                               |     |     |     |     |

> 編輯器上傳  

| 項目        | 內容                            | 類型   | 預設  | 說明  | 必填  |
| --------- |:----------------------------- |:----:|:---:|:---:|:---:|
| <b>路徑</b> | manage/adult_video/upload     |      |     |     |     |
| <b>方法</b> | POST                          |      |     |     |     |
| <b>權限</b> | VIDEO_ADULT_VIDEO_MANAGE_READ |      |     | -   |     |
| <b>參數</b> |                               |      |     |     |     |
|           | image                         | file |     |     | o   |
