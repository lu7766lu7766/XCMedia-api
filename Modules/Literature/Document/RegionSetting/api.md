# 地區設定

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |literature/region/setting         |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |LITERATURE_REGION_SETTING_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |name                         | string         |              |    名稱                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

>總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |literature/region/setting/total         |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |LITERATURE_REGION_SETTING_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |name                         | string         |              |    名稱                 |  x  |
|             |status                        | string         |              |    狀態(Y/N)                |  x  |


>新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |literature/region/setting/         |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |LITERATURE_REGION_SETTING_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |name                         | string         |              |    名稱                 |  o  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |note                        | string         |              |    備註                |  x  |

>更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |literature/region/setting/         |              |              |                     |      |
| <b>方法</b>  | PUT                        |              |              |                     |      |
| <b>權限</b>  |LITERATURE_REGION_SETTING_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                         | int         |              |    id                 |  o  |
|             |name                         | string         |              |    名稱                 |  o  |
|             |status                        | string         |              |    狀態(Y/N)                |  o  |
|             |note                        | string         |              |    備註                |  x  |



>明細

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |literature/region/setting/info         |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |LITERATURE_REGION_SETTING_UPDATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                         | int         |              |    id                 |  o  |

>刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |literature/region/setting/         |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |LITERATURE_REGION_SETTING_DELETE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                         | int         |              |    id                 |  o  |
