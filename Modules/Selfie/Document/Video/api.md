# 成人自拍 > 影片列表

> 列表  

| 項目        | 內容                  | 類型  | 預設  | 說明    | 必填  |
| --------- | ------------------- | --- | --- | ----- | --- |
| <b>路徑</b> | manage/selfie/video |     |     |       |     |
| <b>方法</b> | GET                 |     |     |       |     |
| <b>權限</b> | SELFIE_VIDEO_READ   |     |     | -     |     |
| <b>參數</b> |                     |     |     |       |     |
|           | selfie_schedule_id  | int |     | 節目表Id | o   |
|           | page                | int | 1   | 分頁    | x   |
|           | perpage             | int | 20  | 每頁筆數  | x   |

> 總數  

| 項目        | 內容                        | 類型  | 預設  | 說明    | 必填  |
| --------- | ------------------------- | --- | --- | ----- | --- |
| <b>路徑</b> | manage/selfie/video/total |     |     |       |     |
| <b>方法</b> | GET                       |     |     |       |     |
| <b>權限</b> | SELFIE_VIDEO_READ         |     |     | -     |     |
| <b>參數</b> |                           |     |     |       |     |
|           | selfie_schedule_id        | int |     | 節目表Id | o   |

> 新增  

| 項目        | 內容                  | 類型            | 預設  | 說明    | 必填  |
| --------- | ------------------- | ------------- | --- | ----- | --- |
| <b>路徑</b> | manage/selfie/video |               |     |       |     |
| <b>方法</b> | POST                |               |     |       |     |
| <b>權限</b> | SELFIE_VIDEO_CREATE |               |     | -     |     |
| <b>參數</b> |                     |               |     |       |     |
|           | selfie_schedule_id  | int           |     | 節目表Id | o   |
|           | title               | string        |     | 名稱    | o   |
|           | cover               | file          |     | 圖片    | x   |
|           | video               | file          |     | 影片上傳  | x   |
|           | release_date        | string(Y-m-d) |     | 開放時間  | x   |
|           | status              | string        |     | 狀態    | o   |

> 明細  

| 項目        | 內容                       | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------------ | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/video/info |     |     |     |     |
| <b>方法</b> | GET                      |     |     |     |     |
| <b>權限</b> | SELFIE_VIDEO_UPDATE      |     |     | -   |     |
| <b>參數</b> |                          |     |     |     |     |
|           | id                       | int |     | ID  | o   |

> 更新  

| 項目        | 內容                         | 類型            | 預設  | 說明   | 必填  |
| --------- | -------------------------- | ------------- | --- | ---- | --- |
| <b>路徑</b> | manage/selfie/video/update |               |     |      |     |
| <b>方法</b> | POST                       |               |     |      |     |
| <b>權限</b> | SELFIE_VIDEO_UPDATE        |               |     | -    |     |
| <b>參數</b> |                            |               |     |      |     |
|           | id                         | int           |     | ID   | o   |
|           | title                      | string        |     | 名稱   | o   |
|           | cover                      | file          |     | 圖片   | x   |
|           | video                      | file          |     | 影片上傳 | x   |
|           | release_date               | string(Y-m-d) |     | 開放時間 | x   |
|           | status                     | string        |     | 狀態   | o   |
|           |remove_cover                 | boolean        |              |  刪除圖片,請送1(true)或0(false)        |  x   |
|           |remove_video                 | boolean        |              |  刪除影片,請送1(true)或0(false)         |  x   |

> 刪除  

| 項目        | 內容                  | 類型  | 預設  | 說明  | 必填  |
| --------- | ------------------- | --- | --- | --- | --- |
| <b>路徑</b> | manage/selfie/video |     |     |     |     |
| <b>方法</b> | DELETE              |     |     |     |     |
| <b>權限</b> | SELFIE_VIDEO_DELETE |     |     | -   |     |
| <b>參數</b> |                     |     |     |     |     |
|           | id                  | int |     | ID  | o   |
