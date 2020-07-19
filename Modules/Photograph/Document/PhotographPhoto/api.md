# 成人寫真 > 寫真管理 >圖片管理新增

> 列表

| 項目        | 內容                      | 類型  | 預設  | 說明     | 必填  |
| --------- | ----------------------- | --- | --- | ------ | --- |
| <b>路徑</b> | manage/photograph/photo |     |     |        |     |
| <b>方法</b> | GET                     |     |     |        |     |
| <b>權限</b> | PHOTOGRAPH_PHOTO_READ   |     |     | -      |     |
| <b>參數</b> |                         |     |     |        |     |
|           | photography_id          | int |     | 寫真管理id | o   |

> 新增

| 項目        | 內容                      | 類型   | 預設  | 說明     | 必填  |
| --------- | ----------------------- | ---- | --- | ------ | --- |
| <b>路徑</b> | manage/photograph/photo |      |     |        |     |
| <b>方法</b> | POST                    |      |     |        |     |
| <b>權限</b> | PHOTOGRAPH_PHOTO_CREATE |      |     | -      |     |
| <b>參數</b> |                         |      |     |        |     |
|           | photography_id          | int  |     | 寫真管理id | o   |
|           | file                    | file |     | 封面     | x   |

> 刪除

| 項目        | 內容                      | 類型  | 預設  | 說明  | 必填  |
| --------- | ----------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/photograph/photo |     |     |     |     |
| <b>方法</b> | DELETE                  |     |     |     |     |
| <b>權限</b> | PHOTOGRAPH_PHOTO_DELETE |     |     | -   |     |
| <b>參數</b> |                         |     |     |     |     |
|           | id                      | int |     | ID  | o   |
