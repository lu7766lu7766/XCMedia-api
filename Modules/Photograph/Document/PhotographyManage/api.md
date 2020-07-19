# 成人寫真 > 寫真管理

> 列表

| 項目        | 內容                     | 類型     | 預設  | 說明      | 必填  |
| --------- | ---------------------- | ------ | --- | ------- | --- |
| <b>路徑</b> | manage/photograph      |        |     |         |     |
| <b>方法</b> | GET                    |        |     |         |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_READ |        |     | -       |     |
| <b>參數</b> |                        |        |     |         |     |
|           | region_id              | int    |     | 地區id    | x   |
|           | av_actress_ids         | array  |     | 女優ids   | x   |
|           | cup_id                 | int    |     | 罩杯id    | x   |
|           | years_id               | int    |     | 年份id    | x   |
|           | status                 | string |     | 狀態(N,Y) | x   |
|           | genres_ids             | array  |     | 類型ids   | x   |
|           | keyword                | string |     | 關鍵字     | x   |
|           | page                   | int    | 1   |         | x   |
|           | perpage                | int    | 25  |         | x   |

> 總數

| 項目        | 內容                      | 類型     | 預設  | 說明      | 必填  |
| --------- | ----------------------- | ------ | --- | ------- | --- |
| <b>路徑</b> | manage/photograph/total |        |     |         |     |
| <b>方法</b> | GET                     |        |     |         |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_READ  |        |     | -       |     |
| <b>參數</b> |                         |        |     |         |     |
|           | region_id               | int    |     | 地區id    | x   |
|           | av_actress_ids          | array  |     | 女優ids   | x   |
|           | cup_id                  | int    |     | 罩杯id    | x   |
|           | years_id                | int    |     | 年份id    | x   |
|           | status                  | string |     | 狀態(N,Y) | x   |
|           | genres_ids              | array  |     | 類型ids   | x   |
|           | keyword                 | string |     | 關鍵字     | x   |

> 新增

| 項目        | 內容                       | 類型     | 預設  | 說明      | 必填  |
| --------- | ------------------------ | ------ | --- | ------- | --- |
| <b>路徑</b> | manage/photograph        |        |     |         |     |
| <b>方法</b> | POST                     |        |     |         |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_CREATE |        |     | -       |     |
| <b>參數</b> |                          |        |     |         |     |
|           | title                    | string |     | 名稱      | o   |
|           | cover                    | file   |     | 封面      | x   |
|           | alias                    | string |     | 別名      | x   |
|           | region_id                | int    |     | 地區id    | o   |
|           | av_actress_ids           | array  |     | 女優ids   | o   |
|           | cup_id                   | int    |     | 罩杯id    | o   |
|           | genres_ids               | int    |     | 類型ids   | o   |
|           | years_id                 | int    |     | 年份id    | o   |
|           | tags                     | array  |     | 標籤      | x   |
|           |views                   | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|           |score                   | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|           | description              | string |     | 描述      | x   |
|           | status                   | string |     | 狀態(Y/N) | o   |

> 更新

| 項目        | 內容                       | 類型     | 預設  | 說明      | 必填  |
| --------- | ------------------------ | ------ | --- | ------- | --- |
| <b>路徑</b> | manage/photograph/update |        |     |         |     |
| <b>方法</b> | POST                     |        |     |         |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_UPDATE |        |     | -       |     |
| <b>參數</b> |                          |        |     |         |     |
|           | id                       | int    |     | ID      | o   |
|           | title                    | string |     | 名稱      | o   |
|           | cover                    | file   |     | 封面      | x   |
|           | alias                    | string |     | 別名      | x   |
|           | region_id                | int    |     | 地區id    | o   |
|           | av_actress_ids           | array  |     | 女優ids   | o   |
|           | cup_id                   | int    |     | 罩杯id    | o   |
|           | genres_ids               | int    |     | 類型ids   | o   |
|           | years_id                 | int    |     | 年份id    | o   |
|           | tags                     | array  |     | 標籤      | x   |
|           | description              | string |     | 描述      | x   |
|           |views                   | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|           |score                   | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|           | status                   | string |     | 狀態(Y/N) | o   |
|           |remove_cover                 | boolean        |              | 刪除圖片,請送1(true)或0(false)         |  x   |

> 明細

| 項目        | 內容                       | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------------ | --- | --- | --- | --- |
| <b>路徑</b> | manage/photograph/info   |     |     |     |     |
| <b>方法</b> | GET                      |     |     |     |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_UPDATE |     |     | -   |     |
| <b>參數</b> |                          |     |     |     |     |
|           | id                       | int |     | ID  | o   |

> 刪除

| 項目        | 內容                       | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------------ | --- | --- | --- | --- |
| <b>路徑</b> | manage/photograph        |     |     |     |     |
| <b>方法</b> | DELETE                   |     |     |     |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_DELETE |     |     | -   |     |
| <b>參數</b> |                          |     |     |     |     |
|           | id                       | int |     | ID  | o   |

> 地區列表

| 項目        | 內容                       | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------------ | --- | --- | --- | --- |
| <b>路徑</b> | manage/photograph/region |     |     |     |     |
| <b>方法</b> | GET                      |     |     |     |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_READ   |     |     | -   |     |
| <b>參數</b> |                          |     |     |     |     |

> 女優列表

| 項目        | 內容                        | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/photograph/actress |     |     |     |     |
| <b>方法</b> | GET                       |     |     |     |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_READ    |     |     | -   |     |
| <b>參數</b> |                           |     |     |     |     |

> 胸罩列表

| 項目        | 內容                     | 類型  | 預設  | 說明  | 必填  |
| --------- | ---------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/photograph/cup  |     |     |     |     |
| <b>方法</b> | GET                    |     |     |     |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_READ |     |     | -   |     |
| <b>參數</b> |                        |     |     |     |     |

> 類型列表

| 項目        | 內容                       | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------------ | --- | --- | --- | --- |
| <b>路徑</b> | manage/photograph/genres |     |     |     |     |
| <b>方法</b> | GET                      |     |     |     |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_READ   |     |     | -   |     |
| <b>參數</b> |                          |     |     |     |     |

> 年分列表

| 項目        | 內容                      | 類型  | 預設  | 說明  | 必填  |
| --------- | ----------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/photograph/years |     |     |     |     |
| <b>方法</b> | GET                     |     |     |     |     |
| <b>權限</b> | PHOTOGRAPH_MANAGE_READ  |     |     | -   |     |
| <b>參數</b> |                         |     |     |     |     |
