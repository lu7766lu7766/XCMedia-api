# 電影管理

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage        |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |name                         | string         |              |    名稱(max:50)                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |years_id                     | int         |              |    年份id                 |  x  |
|             |region_id                     | int         |              |    地區id                 |  x  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |name                         | string         |              |    名稱(max:50)                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |years_id                     | int         |              |    年份id                 |  x  |
|             |region_id                     | int         |              |    地區id                 |  x  |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |name                         | string         |              |    名稱(max:50)                 |  o |
|             |cover                         | file         |              |    圖片                 |  x  |
|             |alias                         | string         |              |    別名(max:50)                 |  x |
|             |episode_status                | string    |         |    劇集狀態(連載中:serializing,完結:end)     |  x  |
|             |region_id                     | int         |              |    地區id                 |  o  |
|             |genre_ids                     | array         |              |    類型id                 |  o  |
|             |years_id                     | int         |              |    年份id                 |  o  |
|             |tags                         | array         |              |    標籤                 |  o  |
|             |description                        | string  |              |    描述                |  x  |
|             |views                        | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|             |score                        | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |image_ids        | array         |              |    圖片id                |  x  |


> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/edit          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                         | int         |              |    戲劇id                 |  o |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/update        |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                         |              |              |                     |      |
|             |id                       | int         |              |    漫畫id          |  o |
|             |name                    | string         |              |    名稱(max:50)                 |  o |
|             |cover                    | file         |              |    圖片                 |  x  |
|             |alias                     | string         |              |    別名(max:50)                 |  x |
|             |episode_status            | string    |     |    劇集狀態(連載中:serializing,完結:end)      |  x  |
|             |region_id                     | int         |              |    地區id                 |  o  |
|             |genre_ids                     | array         |              |    類型id                 |  o  |
|             |years_id                     | int         |              |    年份id                 |  o  |
|             |tags                         | array         |              |    標籤                 |  o  |
|             |description                        | string  |              |    描述                |  x  |
|             |views                        | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|             |score                        | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |image_ids        | array         |              |    圖片id                |  x  |
|             |remove_cover                 | boolean        |              |   刪除圖片,請送1(true)或0(false)         |  x   |



> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage        |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_DELETE          |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    戲劇id          |  o |


> 編輯器圖片上傳

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/image/upload         |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_CREATE|MANAGE_COMIC_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image                         |         |              |    圖片          |  o |

> 編輯器圖片刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/image/remove        |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_CREATE|MANAGE_COMIC_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image_id                         |         |              |    圖片id          |  o |

# 集數設定


> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/episode        |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_EPISODE_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |comic_id          | int         |              |  漫畫id                 |  o  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/episode/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_EPISODE_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |comic_id          | int         |              |  漫畫id                 |  o  |


> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/episode         |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_EPISODE_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |comic_id          | int         |              |  漫畫id                 |  o  |
|             |title                         | string         |              |    名稱(max:50)                 |  o |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |opening_time                  | string    |              |   開放時間(yyyy-mm-dd hh:ii:ss) |  o |
|             |image_ids                  | array         |              |    圖片,陣列格式  |  x|



> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/episode/edit          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_EPISODE_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                         | int         |              |   集數id                 |  o |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/episode/update        |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_EPISODE_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                         | int         |              |   集數id                 |  o |
|             |title                         | string         |              |    名稱(max:50)                 |  o |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |opening_time                  | string    |              |   開放時間(yyyy-mm-dd hh:ii:ss) |  o |
|             |image_ids                  | array         |              |    圖片,陣列格式|  x|



> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/episode        |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_EPISODE_DELETE          |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                         | int         |              |   集數id                 |  o |

> 漫畫圖片上傳

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/episode/image/upload   |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_EPISODE_CREATE 或 MANAGE_COMIC_EPISODE_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image                         | file         |              |   檔案                 |  o |

> 漫畫圖片刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/episode/image/remove   |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_COMIC_EPISODE_CREATE 或 MANAGE_COMIC_EPISODE_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image_id                         | int         |              |   圖片id                 |  o |




# 設定選項

> 取得地區

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/options/get_region       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |


> 取得年份

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/options/get_years       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |

> 取得類型

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |comic/manage/options/get_genres       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
