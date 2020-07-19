# 來源設定

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/source/setting         |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |ANIME_SOURCE_SETTING_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/source/setting/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |ANIME_SOURCE_SETTING_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/source/setting         |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |ANIME_SOURCE_SETTING_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |title                         | string         |              |    名稱(max:50)          |  o |
|             |remark                      | string         |              |   備註           | x  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |analyze_address                        | string         |              |   解析地址                |  X  |


> 編輯頁面資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/source/setting/edit          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |ANIME_SOURCE_SETTING_UPDATE           |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    id          |  o |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/source/setting         |              |              |                     |      |
| <b>方法</b>  | PUT                        |              |              |                     |      |
| <b>權限</b>  |ANIME_SOURCE_SETTING_UPDATE           |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    id          |  o |
|             |title                         | string         |              |    名稱(max:50)          |  o |
|             |remark                      | string         |              |   備註           | x  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |analyze_address                        | string         |              |   解析地址                |  X  |


> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |anime/source/setting         |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |ANIME_SOURCE_SETTING_DELETE          |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    id          |  o |
