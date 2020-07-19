# 說書管理

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling        |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱(max:50)                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |years_id                     | int         |              |    年份id                 |  x  |
|             |region_id                     | int         |              |    地區id                 |  x  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱(max:50)                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |years_id                     | int         |              |    年份id                 |  x  |
|             |region_id                     | int         |              |    地區id                 |  x  |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱(max:50)                 |  o |
|             |cover                         | file         |              |    圖片                 |  x  |
|             |alias                         | string         |              |    別名(max:50)                 |  x |
|             |region_id                     | int         |              |    地區id                 |  o  |
|             |genres_ids                     | array         |              |    類型id                 |  o  |
|             |years_id                     | int         |              |    年份id                 |  o  |
|             |tags                      | array         |              |    標籤                 |  x  |
|             |description                        | string  |              |    描述                |  x  |
|             |views                 | int  |       0     |    瀏覽次數(人氣 )   |  x  |
|             |score                 | float  |      0  |   評分(0.0 ~ 10.0)   |  x  |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |editor_image_ids        | array         |              |    圖片id                |  x  |


> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/info          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                         | int         |              |    說書id                 |  o |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/update        |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    說書id          |  o |
|             |title                         | string         |              |    名稱(max:50)                 |  o |
|             |cover                         | file         |              |    圖片                 |  x  |
|             |alias                         | string         |              |    別名(max:50)                 |  x |
|             |region_id                     | int         |              |    地區id                 |  o  |
|             |genres_ids                     | array         |              |    類型id                 |  o  |
|             |years_id                     | int         |              |    年份id                 |  o  |
|             |tags                      | array         |              |    標籤                 |  x  |
|             |description                        | string  |              |    描述                |  x  |
|             |views                 | int  |       0     |    瀏覽次數(人氣 )   |  x  |
|             |score                 | float  |      0  |   評分(0.0 ~ 10.0)   |  x  |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |editor_image_ids        | array         |              |    圖片id                |  x  |
|           |remove_cover                 | boolean        |              |  刪除圖片,請送1(true)或0(false)         |  x   |



> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling        |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_DELETE          |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    說書id          |  o |


> 編輯器圖片上傳

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/image/upload         |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_CREATE|MANAGE_STORYTELLING_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image                         |         |              |    圖片          |  o |

> 編輯器圖片刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/image/remove        |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_CREATE|MANAGE_STORYTELLING_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image_id                         |         |              |    圖片id          |  o |

# 語音設定


> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/audio        |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_AUDIO_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |storytelling_id          | int         |              |  說書id                 |  o  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/audio/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_AUDIO_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |storytelling_id          | int         |              |  說書id                 |  o  |


> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/audio         |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_AUDIO_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |storytelling_id          | int         |              |  說書id                 |  o  |
|             |audio                         | file         |              |    音檔                 |  o |


> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/audio        |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_STORYTELLING_AUDIO_DELETE          |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |storytelling_id          | int         |              |  說書id                 |  o  |
|             |audio_id          | int         |              |  語音id                 |  o  |


# 設定選項

> 取得地區

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/region       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |


> 取得年份

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/years       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |


> 取得類型

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |manage/storytelling/genres       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |

