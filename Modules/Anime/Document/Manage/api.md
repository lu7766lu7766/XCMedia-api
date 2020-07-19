# 動漫管理

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage        |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱(max:50)                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |years_id                     | int         |              |    年份id                 |  x  |
|             |region_id                     | int         |              |    地區id                 |  x  |
|             |episode_status                | string    |         |    集數狀態(連載中:serializing,完結:end)                 |  x  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱(max:50)                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |years_id                     | int         |              |    年份id                 |  x  |
|             |region_id                     | int         |              |    地區id                 |  x  |
|             |episode_status                | string    |         |    集數狀態(連載中:serializing,完結:end)                 |  x  |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱(max:50)                 |  o |
|             |image                         | file         |              |    圖片                 |  x  |
|             |alias                         | string         |              |    別名(max:50)                 |  x |
|             |episode_status                | string    |         |    集數狀態(連載中:serializing,完結:end)                 |  x  |
|             |starring                      | string   |              |    主演(max:255)                 |  x |
|             |director                      | string   |              |    導演(max:255)                 |  x |
|             |region_id                     | int         |              |    地區id                 |  o  |
|             |genre_ids                     | array         |              |    類型id                 |  o  |
|             |years_id                     | int         |              |    年份id                 |  o  |
|             |language_id                     | int         |              |    語言id                 |  o  |
|             |description                        | string  |              |    描述                |  x  |
|             |views                        | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|             |score                        | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |editor_image_ids        | array         |              |    圖片id                |  x  |


> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/edit          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                         | int         |              |    動漫id                 |  o |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/update        |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    動漫id          |  o |
|             |title                         | string         |              |    名稱(max:50)                 |  o |
|             |image                         | file         |              |    圖片                 |  x  |
|             |alias                         | string         |              |    別名(max:50)                 |  x |
|             |episode_status                | string    |         |    集數狀態(連載中:serializing,完結:end)                 |  x  |
|             |starring                      | string   |              |    主演(max:255)                 |  x |
|             |director                      | string   |              |    導演(max:255)                 |  x |
|             |region_id                     | int         |              |    地區id                 |  o  |
|             |genre_ids                     | array         |              |    類型id                 |  o  |
|             |years_id                     | int         |              |    年份id                 |  o  |
|             |language_id                     | int         |              |    語言id                 |  o  |
|             |description                        | string  |              |    描述                |  x  |
|             |views                        | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|             |score                        | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |editor_image_ids        | array         |              |    圖片id                |  x  |
|             |remove_image                 | boolean        |              |   刪除圖片,請送1(true)或0(false)         |  x   |



> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage        |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_DELETE          |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    動漫id          |  o |


> 編輯器圖片上傳

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/image/upload         |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_CREATE|MANAGE_ANIME_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image                         |         |              |    圖片          |  o |

> 編輯器圖片刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/image/remove        |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_CREATE|MANAGE_ANIME_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image_id                         |         |              |    圖片id          |  o |

# 集數設定


> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/episode        |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_EPISODE_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |episode_owner_id          | int         |              |  動漫id                 |  o  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/episode/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_EPISODE_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |episode_owner_id          | int         |              |  動漫id                 |  o  |


> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/episode         |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_EPISODE_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |episode_owner_id          | int         |              |  動漫id                 |  o  |
|             |title                         | string         |              |    名稱(max:50)                 |  o |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |opening_time                  | string    |              |   開放時間(yyyy-mm-dd hh:ii:ss) |  o |
|             |sources_url                  | array         |              |    來源,陣列格式:[source id(key) => source url(value)]|  x|



> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/episode/edit          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_EPISODE_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |episode_owner_id          | int         |              |  動漫id                 |  o  |
|             |episode_id                         | int         |              |   集數id                 |  o |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/episode/update        |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_EPISODE_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |episode_owner_id          | int         |              |  動漫id                 |  o  |
|             |episode_id                         | int         |              |   集數id                 |  o |
|             |title                         | string         |              |    名稱(max:50)                 |  o |
|             |status                        | string  |              |    狀態(Y/N)                |  o  |
|             |opening_time                  | string    |              |   開放時間(yyyy-mm-dd hh:ii:ss) |  o |
|             |sources_url                  | array         |              |    來源,陣列格式:[source id(key) => source url(value)]|  x|



> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/episode        |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_EPISODE_DELETE          |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |episode_owner_id          | int         |              |  動漫id                 |  o  |
|             |episode_id                         | int         |              |   集數id                 |  o |

> 批次新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/episode/batch   |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANIME_EPISODE_CREATE  |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |episode_owner_id             | int          |              | 動漫id               |  o  |
|             |source_id                    | int          |              | 來源id               |  o |
|             |opening_time                 | string       |              | 開放時間(yyyy-mm-dd hh:ii:ss) |  o |
|             |status                       | string       |              | 狀態(Y/N)            |  o |
|             |data                         | array        |              | 新增內容,格式如下      |  o  |

## 新增內容格式
data[0][name]: 集數名稱1<br>
data[0][url]: 網址1<br>
data[1][name]: 集數名稱2<br>
data[1][url]: 網址2<br>
...以此類推



# 設定選項


> 取得集數狀態

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/options/episode_status       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |

> 取得地區

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/options/get_region       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |


> 取得年份

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/options/get_years       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |

> 取得語言

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/options/get_language       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |

> 取得類型

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/options/get_genres       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |

> 取得來源

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/manage/episode/options/get_source       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
