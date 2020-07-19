# 廣告管理

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |advertisement/manage          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ADVERTISEMENT_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    標題                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |type_id                        | int         |              |    類型id               |  x  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |advertisement/manage/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ADVERTISEMENT_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    標題                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |type_id                        | int         |              |    類型id               |  x  |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |advertisement/manage          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ADVERTISEMENT_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    標題(max:50)          |  o |
|             |url                           | string         |              |   連結(max:255)           | x  |
|             |branches                      | array         |              |    站台id                |  o  |
|             |is_blank                       | string         |              |    是否另開視窗(Y/N),預設為N |  o  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |type_id                        | int         |              |    類型id               |  o  |
|             |image                        | image         |              |   圖片               |  o  |



> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |advertisement/manage/edit          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ADVERTISEMENT_UPDATE           |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    廣告id          |  o |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |advertisement/manage/update          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ADVERTISEMENT_UPDATE           |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    廣告id          |  o |
|             |title                         | string         |              |    標題(max:50)          |  o |
|             |url                           | string         |              |   連結(max:255)           | x  |
|             |branches                      | array         |              |    站台id                |  o  |
|             |is_blank                       | string         |              |    是否另開視窗(Y/N),預設為N |  o  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |type_id                        | int         |              |    類型id               |  o  |
|             |image                        | image         |              |   圖片               |  x  |

> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |advertisement/manage          |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ADVERTISEMENT_DELETE          |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    廣告id          |  o |


> 站台列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |advertisement/manage/options/branch          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ADVERTISEMENT_READ|MANAGE_ADVERTISEMENT_UPDATE    |              |              |          -          |      |

> 類型列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |advertisement/manage/options/type          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
