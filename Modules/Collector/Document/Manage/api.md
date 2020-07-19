# 採集設定

> 列表

| 項目        | 內容                       | 類型     | 預設  | 說明      | 必填  |
| --------- | ------------------------ | ------ | --- | ------- | --- |
| <b>路徑</b> | collector_setting/manage |        |     |         |     |
| <b>方法</b> | GET                      |        |     |         |     |
| <b>權限</b> | MANAGE_COLLECTOR_READ    |        |     | -       |     |
| <b>參數</b> |                          |        |     |         |     |
|           | status                   | string |     | 狀態(Y/N) | x   |
|           | page                     | int    | 1   | 分頁      | x   |
|           | perpage                  | int    | 20  | 每頁筆數    | x   |
|           | keyword                  | string |     | 關鍵字     | x   |

> 總數

| 項目        | 內容                             | 類型     | 預設  | 說明      | 必填  |
| --------- | ------------------------------ | ------ | --- | ------- | --- |
| <b>路徑</b> | collector_setting/manage/total |        |     |         |     |
| <b>方法</b> | GET                            |        |     |         |     |
| <b>權限</b> | MANAGE_COLLECTOR_READ          |        |     | -       |     |
| <b>參數</b> |                                |        |     |         |     |
|           | status                         | string |     | 狀態(Y/N) | x   |

> 新增

| 項目        | 內容                       | 類型    | 預設                                            | 說明      | 必填  |
| --------- | ------------------------ | ----- | --------------------------------------------- | ------- | --- |
| <b>路徑</b> | collector_setting/manage |       |                                               |         |     |
| <b>方法</b> | POST                     |       |                                               |         |     |
| <b>權限</b> | MANAGE_COLLECTOR_CREATE  |       |                                               | -       |     |
| <b>參數</b> |                          |       |                                               |         |     |
|           | source_id                | int   |                                               |         | o   |
|           | type_ids                 | array | 類型id(type_ids[0]:1,type_ids[1]:2....)         |         | o   |
|           | platform_ids             | array | 平台id(platform_ids[0]:1,platform_ids[1]:2....) |         | o   |
|           | status                   | int   |                                               | 狀態(Y/N) | o   |

> 編輯

| 項目        | 內容                            | 類型  | 預設  | 說明  | 必填  |
| --------- | ----------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | collector_setting/manage/edit |     |     |     |     |
| <b>方法</b> | GET                           |     |     |     |     |
| <b>權限</b> | MANAGE_COLLECTOR_UPDATE       |     |     | -   |     |
| <b>參數</b> |                               |     |     |     |     |
|           | id                            | int |     |     | o   |

> 更新

| 項目            | 內容                                             | 類型    | 預設                                            | 說明      | 必填  |
| ------------- | ---------------------------------------------- | ----- | --------------------------------------------- | ------- | --- |
| <b>路徑</b>     | collector_setting/manage                       |       |                                               |         |     |
| <b>方法</b>     | PUT                                            |       |                                               |         |     |
| <b>權限</b>     | MANAGE_COLLECTOR_UPDATE                        |       |                                               | -       |     |
| <b>header</b> | Content-Type:application/x-www-form-urlencoded |       |                                               | -       |     |
| <b>參數</b>     |                                                |       |                                               |         |     |
|               | id                                             | int   |                                               | id      | o   |
|               | source_id                                      | int   |                                               |         | o   |
|               | type_ids                                       | array | 類型id(type_ids[0]:1,type_ids[1]:2....)         |         | o   |
|               | platform_ids                                   | array | 平台id(platform_ids[0]:1,platform_ids[1]:2....) |         | o   |
|               | status                                         | int   |                                               | 狀態(Y/N) | o   |

> 刪除

| 項目            | 內容                                             | 類型  | 預設  | 說明  | 必填  |
| ------------- | ---------------------------------------------- | --- | --- | --- | --- |
| <b>路徑</b>     | collector_setting/manage                       |     |     |     |     |
| <b>方法</b>     | DELETE                                         |     |     |     |     |
| <b>權限</b>     | MANAGE_COLLECTOR_DELETE                        |     |     | -   |     |
| <b>header</b> | Content-Type:application/x-www-form-urlencoded |     |     | -   |     |
| <b>參數</b>     |                                                |     |     |     |     |
|               | id                                             | int |     | id  | o   |

> 取得資源列表

| 項目        | 內容                                  | 類型  | 預設  | 說明  | 必填  |
| --------- | ----------------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | collector_setting/manage/get_source |     |     |     |     |
| <b>方法</b> | GET                                 |     |     |     |     |

> 取得類型列表

| 項目        | 內容                                | 類型  | 預設  | 說明  | 必填  |
| --------- | --------------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | collector_setting/manage/get_type |     |     |     |     |
| <b>方法</b> | GET                               |     |     |     |     |

> 取得平台列表

| 項目        | 內容                                    | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------------------------- | --- | --- | --- | --- |
| <b>路徑</b> | collector_setting/manage/get_platform |     |     |     |     |
| <b>方法</b> | GET                                   |     |     |     |     |
