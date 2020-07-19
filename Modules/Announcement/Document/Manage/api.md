# 公告管理

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |announcement/manage          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANNOUNCEMENT_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    公告標題                 |  x  |
|             |marquee_switch                | string         |              |    跑馬燈狀態(Y/N)                |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |announcement/manage/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANNOUNCEMENT_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    公告標題                 |  x  |
|             |marquee_switch                | string         |              |    跑馬燈狀態(Y/N)                |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |announcement/manage          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANNOUNCEMENT_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    公告標題(max:50)          |  o |
|             |contents                      | string         |              |   公告內文           | o  |
|             |marquee_switch                | string         |              |    跑馬燈狀態(Y/N)                |  o  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |branches                      | array         |              |    站台id                |  o  |
|             |image_ids                     | array         |              |    圖片id                |  x  |


> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |announcement/manage/edit          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANNOUNCEMENT_UPDATE           |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    公告id          |  o |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |announcement/manage          |              |              |                     |      |
| <b>方法</b>  | PUT                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANNOUNCEMENT_UPDATE           |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    公告id          |  o |
|             |title                         | string         |              |    公告標題(max:50)          |  o |
|             |contents                      | string         |              |   公告內文           | o  |
|             |marquee_switch                | string         |              |    跑馬燈狀態(Y/N)                |  o  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |branches                      | array         |              |    站台id                |  o  |
|             |image_ids                     | array         |              |    圖片id                |  x  |


> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |announcement/manage          |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANNOUNCEMENT_DELETE          |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    公告id          |  o |


> 站台列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |announcement/manage/options/branch          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANNOUNCEMENT_CREATE|MANAGE_ANNOUNCEMENT_UPDATE    |              |              |          -          |      |


> 圖片上傳

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |announcement/manage/image/upload          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANNOUNCEMENT_CREATE|MANAGE_ANNOUNCEMENT_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image                         |         |              |    圖片          |  o |

> 圖片刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |announcement/manage/image/remove          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_ANNOUNCEMENT_CREATE|MANAGE_ANNOUNCEMENT_UPDATE    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |image_id                         |         |              |    圖片id          |  o |

