# 類型設定

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |storytelling/genres/setting        |              |              |                     |      |
| <b>方法</b>  | GET                         |              |              |                     |      |
| <b>權限</b>  |STORYTELLING_GENRES_SETTING_READ   |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                        | string       |              |    名稱              |  x   |
|             |status                       | string       |              |    狀態(Y/N)         |  x   |
|             |page                         | int          |       1      |  分頁                |  x   |
|             |perpage                      | int          |      20      |  每頁筆數             |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |storytelling/genres/setting/total   |              |              |                     |      |
| <b>方法</b>  | GET                         |              |              |                     |      |
| <b>權限</b>  |STORYTELLING_GENRES_SETTING_READ    |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                        | string       |              |    名稱              |  x   |
|             |status                       | string       |              |    狀態(Y/N)         |  x   |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |storytelling/genres/setting         |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |STORYTELLING_GENRES_SETTING_CREATE  |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                        | string       |              |    名稱(max:50)      |  o   |
|             |status                       | string       |              |    狀態(Y/N)         |  o   |
|             |remark                       | string       |              |    備註              |  x   |
|             |image                        | image        |              |    圖片              |  x   |


> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |storytelling/genres/setting/edit    |              |              |                     |      |
| <b>方法</b>  | GET                         |              |              |                     |      |
| <b>權限</b>  |STORYTELLING_GENRES_SETTING_UPDATE  |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int          |              |         id          |  o   |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |storytelling/genres/setting/update  |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |STORYTELLING_GENRES_SETTING_UPDATE  |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int          |              |         id          |   o  |
|             |title                        | string       |              |      名稱(max:50)    |   o  |
|             |status                       | string       |              |      狀態(Y/N)       |   o  |
|             |remark                       | string       |              |         備註         |   x  |
|             |image                        | image        |              |         圖片         |  x   |
|             |remove_image                 | boolean        |              |   刪除圖片,請送1(true)或0(false)       |  x   |


> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |storytelling/genres/setting         |              |              |                     |      |
| <b>方法</b>  | DELETE                      |              |              |                     |      |
| <b>權限</b>  |STORYTELLING_GENRES_SETTING_DELETE  |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int          |              |         id          |   o  |
