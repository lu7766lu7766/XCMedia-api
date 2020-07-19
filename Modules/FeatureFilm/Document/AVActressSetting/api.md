# 女優設定

> 列表  

| 項目        | 內容                                   | 類型     | 預設  | 說明      | 必填  |
| --------- | ------------------------------------ | ------ | --- | ------- | --- |
| <b>路徑</b> | feature_film/av_actress/setting      |        |     |         |     |
| <b>方法</b> | GET                                  |        |     |         |     |
| <b>權限</b> | FEATURE_FILM_AV_ACTRESS_SETTING_READ |        |     | -       |     |
| <b>參數</b> |                                      |        |     |         |     |
|           | keyword                              | string |     | 名稱      | x   |
|           | status                               | string |     | 狀態(Y/N) | x   |
|           | page                                 | int    | 1   | 分頁      | x   |
|           | perpage                              | int    | 20  | 每頁筆數    | x   |

> 總數  

| 項目        | 內容                                    | 類型     | 預設  | 說明      | 必填  |
| --------- |:------------------------------------- |:------:| --- |:-------:|:---:|
| <b>路徑</b> | feature_film/av_actress/setting/total |        |     |         |     |
| <b>方法</b> | GET                                   |        |     |         |     |
| <b>權限</b> | FEATURE_FILM_AV_ACTRESS_SETTING_READ  |        |     | -       |     |
| <b>參數</b> |                                       |        |     |         |     |
|           | keyword                               | string |     | 名稱      | x   |
|           | status                                | string |     | 狀態(Y/N) | x   |

> 創建  

| 項目        | 內容                                     | 類型     | 預設  | 說明      | 必填  |
| --------- | -------------------------------------- | ------ | --- | ------- |:---:|
| <b>路徑</b> | feature_film/av_actress/setting/       |        |     |         |     |
| <b>方法</b> | POST                                   |        |     |         |     |
| <b>權限</b> | FEATURE_FILM_AV_ACTRESS_SETTING_CREATE |        |     | -       |     |
| <b>參數</b> |                                        |        |     |         |     |
|           | name                                   | string |     | 名稱      | o   |
|           | alias                                  | string |     | 別名      | x   |
|           | cover                                  | image  |     | 圖片      | x   |
|           | status                                 | string |     | 狀態(Y/N) | o   |
|           | note                                   | string |     | 備註      | x   |

> 明細  

| 項目        | 內容                                     | 類型  | 預設  | 說明  | 必填  |
| --------- | -------------------------------------- | --- | --- | --- |:---:|
| <b>路徑</b> | feature_film/av_actress/setting/info   |     |     |     |     |
| <b>方法</b> | GET                                    |     |     |     |     |
| <b>權限</b> | FEATURE_FILM_AV_ACTRESS_SETTING_UPDATE |     |     | -   |     |
| <b>參數</b> |                                        |     |     |     |     |
|           | id                                     | int |     | id  | o   |

> 更新  

| 項目        | 內容                                     | 類型     | 預設  | 說明      | 必填  |
| --------- | -------------------------------------- | ------ | --- | ------- |:---:|
| <b>路徑</b> | feature_film/av_actress/setting/update       |        |     |         |     |
| <b>方法</b> | POST                                    |        |     |         |     |
| <b>權限</b> | FEATURE_FILM_AV_ACTRESS_SETTING_UPDATE |        |     | -       |     |
| <b>參數</b> |                                        |        |     |         |     |
|           | id                                     | int    |     | id      | o   |
|           | name                                   | string |     | 名稱      | o   |
|           | alias                                  | string |     | 別名      | x   |
|           | cover                                  | image  |     | 圖片      | x   |
|           | status                                 | string |     | 狀態(Y/N) | o   |
|           | note                                   | string |     | 備註      | x   |
|           |remove_cover                 | boolean        |              |  刪除圖片,請送1(true)或0(false)         |  x   |

> 刪除  

| 項目        | 內容                                     | 類型  | 預設  | 說明  | 必填  |
| --------- |:-------------------------------------- |:---:|:---:|:---:|:---:|
| <b>路徑</b> | feature_film/av_actress/setting/       |     |     |     |     |
| <b>方法</b> | DELETE                                 |     |     |     |     |
| <b>權限</b> | FEATURE_FILM_AV_ACTRESS_SETTING_DELETE |     |     | -   |     |
| <b>參數</b> |                                        |     |     |     |     |
|           | id                                     | int |     | id  | o   |
