# 頁面管理

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |layout/manage          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_LAYOUT_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱                 |  x  |
|             |code                         | string         |              |    代碼                |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |layout/manage/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_LAYOUT_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱                 |  x  |
|             |code                         | string         |              |    代碼                |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |layout/manage          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_LAYOUT_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱(max:50)          |  o |
|             |contents                      | string         |              |   內文           | o  |
|             |code                         | string         |              |    代碼(max:30)                |  o  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |branches                      | array         |              |    站台id                |  o  |
|             |image_ids                     | array         |              |    圖片id                |  x  |


> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |layout/manage/edit          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_LAYOUT_UPDATE           |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    公告id          |  o |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |layout/manage          |              |              |                     |      |
| <b>方法</b>  | PUT                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_LAYOUT_UPDATE           |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    公告id          |  o |
|             |title                         | string         |              |    名稱(max:50)          |  o |
|             |contents                      | string         |              |   內文           | o  |
|             |code                         | string         |              |    代碼(max:30)                |  o  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |branches                      | array         |              |    站台id                |  o  |
|             |image_ids                     | array         |              |    圖片id                |  x  |


> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |layout/manage          |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_LAYOUT_DELETE          |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    公告id          |  o |


> 站台列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |layout/manage/options/branch          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_LAYOUT_CREATE|MANAGE_LAYOUT_UPDATE    |              |              |          -          |      |


> 圖片上傳

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |layout/manage/image/upload          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_LAYOUT_CREATE|MANAGE_LAYOUT_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image                         |         |              |    圖片          |  o |

> 圖片刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |layout/manage/image/remove          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_LAYOUT_CREATE|MANAGE_LAYOUT_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image_id                         |         |              |    圖片id          |  o |

