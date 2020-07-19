# 站台管理

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |branch/manage          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_BRANCH_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |name                         | string         |              |    站台名稱                 |  x  |
|             |status                       | string         |              |    狀態(Y/N)                |  x  |
|             |page                         | int         |       1       |  分頁                   |   x  |
|             |perpage                      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |branch/manage/total          |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_BRANCH_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |name                         | string         |              |    站台名稱                 |  x  |
|             |status                       | string         |              |    狀態(Y/N)                |  x  |


> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |branch/manage          |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_BRANCH_CREATE           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |name                         | string         |              |    站台名稱(max:30)          |  o |
|             |code                         | string         |              |   站台代碼(max:30)           | o  |
|             |domain                       | string         |              |    網域(max:255)            | o  |
|             |status                       | string         |              |    狀態(Y/N)                | o  |
|             |is_register                       | string         |              | 是否開放會員註冊(Y/N)                |  o  |
|             |remark                       | string         |              |    備註                |  x  |



> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |branch/manage          |              |              |                     |      |
| <b>方法</b>  | PUT                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_BRANCH_UPDATE           |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    站台id          |  o |
|             |name                         | string         |              |    站台名稱(max:30)          |  o |
|             |domain                       | string         |              |    網域(max:255)            | o  |
|             |status                       | string         |              |    狀態(Y/N)                | o  |
|             |is_register                       | string         |              | 是否開放會員註冊(Y/N)                |  o  |
|             |remark                       | string         |              |    備註                |  x  |


> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |branch/manage          |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_BRANCH_DELETE          |              |              |          -          |      |
| <b>header</b>|Content-Type:application/x-www-form-urlencoded     |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id                           | int         |              |    站台id          |  o |
