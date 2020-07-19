# 帳號管理

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |account/manage/index       |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  | account.manage.read           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             | account                      | string      |              |      帳號        |   x  |
|             | role_id                      | integer      |              |      角色id        |   x  |
|             | status                      | string   |    |   狀態 ,enable:開啟/disable:關閉       |   x  |
|             | page                      | integer      |         1     |      頁碼        |   x  |
|             | perpage                      | integer      |       20       |      每頁筆數        |   x  |

> 總筆數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |account/manage/index       |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  | account.manage.read           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             | account                      | string      |              |      帳號        |   x  |
|             | role_id                      | integer      |              |      角色id        |   x  |
|             | status                      | string   |    |   狀態 ,enable:開啟/disable:關閉       |   x  |

> 查詢選項

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |account/manage/options       |              |              |                     |      |
| <b>方法</b>  | GET                        |              |              |                     |      |
| <b>權限</b>  | account.manage.read           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |account/manage/create       |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  | account.manage.create           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             | account                      | string      |              |      帳號,限英數4~32字        |   o  |
|             | password                      | string      |              |      密碼,4~32字        |   o  |
|             | password_confirmation        | string      |              |      密碼確認,需與密碼相同        |   o  |
|             | display_name                      | string      |              |      限英數4~32字        |   o  |
|             | role_id                      | array      |              |      角色id(s)        |   o  |
|             | status                      | integer   |  enable  |   狀態 ,enable:開啟/disable:關閉       |   x  |
|             | remark                      | string       |              |   備註                |   x  |

> 編輯

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |account/manage/update       |              |              |                     |      |
| <b>方法</b>  | POST                        |              |              |                     |      |
| <b>權限</b>  | account.manage.update           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             | id                      | integer      |              |      帳號id        |   o  |
|             | password                      | string      |              |      密碼,4~32字,填寫才會修改        |   x  |
|             | password_confirmation        | string      |              |      密碼確認,需與密碼相同        |   x  |
|             | display_name                      | string      |              |      限英數4~32字        |   o  |
|             | role_id                      | array      |              |      角色id(s),填寫才會修改        |   x  |
|             | status                      | integer      |      enable   |  狀態 ,enable:開啟/disable:關閉       |   x  |
|             | remark                      | string       |              |   備註                |   x  |

> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |account/manage/delete/{id}      |              |              |                     |      |
| <b>方法</b>  | DELETE                        |              |              |                     |      |
| <b>權限</b>  | account.manage.del          |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             | id                      | integer      |              |      帳號id        |   o  |
