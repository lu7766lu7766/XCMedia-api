# 成人自拍 > 自拍管理

> 列表  

| 項目        | 內容                     | 類型     | 預設  | 說明        | 必填  |
| --------- | ---------------------- | ------ | --- | --------- | --- |
| <b>路徑</b> | manage/selfie/schedule |        |     |           |     |
| <b>方法</b> | GET                    |        |     |           |     |
| <b>權限</b> | SELFIE_SCHEDULE_READ   |        |     | -         |     |
| <b>參數</b> |                        |        |     |           |     |
|           | is_censored            | string |     | 是否有碼(Y/N) | x   |
|           | region_id              | int    |     | 地區Id      | x   |
|           | av_actress             | array  |     | 女優id      | x   |
|           | cup_id                 | int    |     | 罩杯id      | x   |
|           | years_id               | int    |     | 年份id      | x   |
|           | status                 | string |     | 狀態(Y/N)   | x   |
|           | keyword                | string |     | 關鍵字查詢     | x   |
|           | page                   | int    | 1   | 分頁        | x   |
|           | perpage                | int    | 20  | 每頁筆數      | x   |

> 總數  

| 項目        | 內容                           | 類型     | 預設  | 說明        | 必填  |
| --------- | ---------------------------- | ------ | --- | --------- | --- |
| <b>路徑</b> | manage/selfie/schedule/total |        |     |           |     |
| <b>方法</b> | GET                          |        |     |           |     |
| <b>權限</b> | SELFIE_SCHEDULE_READ         |        |     | -         |     |
| <b>參數</b> |                              |        |     |           |     |
|           | is_censored                  | string |     | 是否有碼(Y/N) | x   |
|           | region_id                    | int    |     | 地區Id      | x   |
|           | av_actress                   | array  |     | 女優id      | x   |
|           | cup_id                       | int    |     | 罩杯id      | x   |
|           | years_id                     | int    |     | 年份id      | x   |
|           | status                       | string |     | 狀態(Y/N)   | x   |
|           | keyword                      | string |     | 關鍵字查詢     | x   |

> 新增  

| 項目        | 內容                     | 類型     | 預設  | 說明        | 必填  |
| --------- | ---------------------- | ------ | --- | --------- | --- |
| <b>路徑</b> | selfie/region/setting  |        |     |           |     |
| <b>方法</b> | POST                   |        |     |           |     |
| <b>權限</b> | SELFIE_SCHEDULE_CREATE |        |     | -         |     |
| <b>參數</b> |                        |        |     |           |     |
|           | title                  | string |     | 名稱        | o   |
|           | cover                  | file   |     | 圖片        | x   |
|           | alias                  | string |     | 別名        | x   |
|           | is_censored            | string |     | 是否有碼(Y/N) | o   |
|           | region_id              | int    |     | 地區Id      | o   |
|           | av_actress_ids         | array  |     | 女優id      | o   |
|           | cup_id                 | int    |     | 罩杯id      | o   |
|           | genres_ids             | array  |     | 類型ids     | o   |
|           | years_id               | int    |     | 年份id      | x   |
|           | tags                   | array  |     | 標籤        | x   |
|           |views                   | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|           |score                   | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|           | description            | string |     | 描述        | x   |
|           | status                 | string |     | 狀態(Y/N)   | x   |

> 明細  

| 項目        | 內容                          | 類型  | 預設  | 說明  | 必填  |
| --------- | --------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/schedule/info |     |     |     |     |
| <b>方法</b> | GET                         |     |     |     |     |
| <b>權限</b> | SELFIE_SCHEDULE_UPDATE      |     |     | -   |     |
| <b>參數</b> |                             |     |     |     |     |
|           | id                          | int |     | ID  | o   |

> 更新  

| 項目        | 內容                            | 類型     | 預設  | 說明        | 必填  |
| --------- | ----------------------------- | ------ | --- | --------- | --- |
| <b>路徑</b> | manage/selfie/schedule/update |        |     |           |     |
| <b>方法</b> | POST                          |        |     |           |     |
| <b>權限</b> | SELFIE_SCHEDULE_UPDATE        |        |     | -         |     |
| <b>參數</b> |                               |        |     |           |     |
|           | id                            | int    |     | ID        | o   |
|           | title                         | string |     | 名稱        | o   |
|           | cover                         | file   |     | 圖片        | x   |
|           | alias                         | string |     | 別名        | x   |
|           | is_censored                   | string |     | 是否有碼(Y/N) | o   |
|           | region_id                     | int    |     | 地區Id      | o   |
|           | av_actress_ids                | array  |     | 女優id      | o   |
|           | cup_id                        | int    |     | 罩杯id      | o   |
|           | genres_ids                    | array  |     | 類型ids     | o   |
|           | years_id                      | int    |     | 年份id      | x   |
|           | tags                          | array  |     | 標籤        | x   |
|           |views                   | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|           |score                   | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|           | description                   | string |     | 描述        | x   |
|           | status                        | string |     | 狀態(Y/N)   | x   |
|           |remove_cover                 | boolean        |              |  刪除圖片,請送1(true)或0(false)         |  x   |

> 刪除  

| 項目        | 內容                     | 類型  | 預設  | 說明  | 必填  |
| --------- | ---------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/schedule |     |     |     |     |
| <b>方法</b> | DELETE                 |     |     |     |     |
| <b>權限</b> | SELFIE_SCHEDULE_DELETE |     |     | -   |     |
| <b>參數</b> |                        |     |     |     |     |
|           | id                     | int |     | ID  | o   |

> 類型  

| 項目        | 內容                            | 類型  | 預設  | 說明  | 必填  |
| --------- | ----------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/schedule/genres |     |     |     |     |
| <b>方法</b> | GET                           |     |     |     |     |
| <b>權限</b> | SELFIE_SCHEDULE_READ          |     |     | -   |     |
| <b>參數</b> |                               |     |     |     |     |

> 地區  

| 項目        | 內容                            | 類型  | 預設  | 說明  | 必填  |
| --------- | ----------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/schedule/region |     |     |     |     |
| <b>方法</b> | GET                           |     |     |     |     |
| <b>權限</b> | SELFIE_SCHEDULE_READ          |     |     | -   |     |
| <b>參數</b> |                               |     |     |     |     |

> 女優  

| 項目        | 內容                             | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------------------ | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/schedule/actress |     |     |     |     |
| <b>方法</b> | GET                            |     |     |     |     |
| <b>權限</b> | SELFIE_SCHEDULE_READ           |     |     | -   |     |
| <b>參數</b> |                                |     |     |     |     |

> 罩杯  

| 項目        | 內容                         | 類型  | 預設  | 說明  | 必填  |
| --------- | -------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/schedule/cup |     |     |     |     |
| <b>方法</b> | GET                        |     |     |     |     |
| <b>權限</b> | SELFIE_SCHEDULE_READ       |     |     | -   |     |
| <b>參數</b> |                            |     |     |     |     |

> 年份  

| 項目        | 內容                           | 類型  | 預設  | 說明  | 必填  |
| --------- | ---------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/schedule/years |     |     |     |     |
| <b>方法</b> | GET                          |     |     |     |     |
| <b>權限</b> | SELFIE_SCHEDULE_READ         |     |     | -   |     |
| <b>參數</b> |                              |     |     |     |     |

> 狀態  

| 項目        | 內容                            | 類型  | 預設  | 說明  | 必填  |
| --------- | ----------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/schedule/status |     |     |     |     |
| <b>方法</b> | GET                           |     |     |     |     |
| <b>權限</b> | SELFIE_SCHEDULE_READ          |     |     | -   |     |
| <b>參數</b> |                               |     |     |     |     |
