# 會員管理

> 列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |member/manage/list          |              |              |                     |      |
| <b>方法</b>  | post                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_MEMBER_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |branch_id    | int         |              |    站台id                    |  x  |
|             |status       | string         |              |    狀態(enable/disable)   |  x  |
|             |keyword      | string         |              |    帳號.電話.信箱關鍵字查詢  |  x  |
|             |page         | int         |       1       |  分頁                   |   x  |
|             |perpage      | int         |      20       |  每頁筆數                |   x  |

> 總數

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |member/manage/total          |              |              |                     |      |
| <b>方法</b>  | post                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_MEMBER_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |branch_id    | int         |              |    站台id                    |  x  |
|             |status       | string         |              |    狀態(enable:啟用/disable:停用)   |  x  |
|             |keyword      | string         |              |    帳號.電話.信箱關鍵字查詢  |  x  |

> 詳細資訊

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |member/manage/profile          |              |              |                     |      |
| <b>方法</b>  | post                        |              |              |                     |      |
| <b>權限</b>  |MANAGE_MEMBER_READ           |              |              |          -          |      |
| <b>參數</b>  |                             |              |              |                     |      |
|             |id    | int         |              |    會員id                    |  o  |

> 新增

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |member/manage/create          |         |              |                     |      |
| <b>方法</b>  | post                        |         |              |                     |      |
| <b>權限</b>  |MANAGE_MEMBER_CREATE           |        |              |          -          |      |
| <b>參數</b>  |                             |        |              |                     |      |
|             |branch_id    | int         |        |    站台id                    |  o  |
|             |account    | string         |        |    帳號(4~23英數字串)      |  o  |
|             |display_name    | string         |         |  暱稱      |  o  |
|             |password    | string         |       |   密碼(4~23字串)         |  o  |
|             |phone    | string         |      |    電話號碼                    | x  |
|             |phone_approve    | string  |   |    電話驗證(Y:已驗證/N:待驗證)     | x  |
|             |mail    | string         |      |    信箱                    | x  |
|             |mail_approve    | string  |   |    信箱驗證(Y:已驗證/N:待驗證)     | x  |
|             |status    | string  |   |    狀態(enable:啟用/disable:停用)     | o  |
|             |remark    | string  |   |    備註     | x  |

> 更新

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |member/manage/update          |         |              |                     |      |
| <b>方法</b>  | post                        |         |              |                     |      |
| <b>權限</b>  |MANAGE_MEMBER_UPDATE           |        |              |          -          |      |
| <b>參數</b>  |                             |        |              |                     |      |
|             |id    | int         |        |    會員id                    |  o  |
|             |display_name    | string         |         |  暱稱      |  o  |
|             |password    | string         |       |   密碼(4~23字串)         |  o  |
|             |phone    | string         |      |    電話號碼                    | x  |
|             |phone_approve    | string  |   |    電話驗證(Y:已驗證/N:待驗證)     | x  |
|             |mail    | string         |      |    信箱                    | x  |
|             |mail_approve    | string  |   |    信箱驗證(Y:已驗證/N:待驗證)     | x  |
|             |status    | string  |   |    狀態(enable:啟用/disable:停用)     | o  |
|             |remark    | string  |   |    備註     | x  |

> 刪除

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |member/manage/delete          |         |              |                     |      |
| <b>方法</b>  | post                        |         |              |                     |      |
| <b>權限</b>  |MANAGE_MEMBER_DELETE           |        |              |          -          |      |
| <b>參數</b>  |                             |        |              |                     |      |
|             |id    | int         |        |    會員id                    |  o  |

> 狀態選項列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |member/manage/options/status          |         |              |                     |      |
| <b>方法</b>  | get                        |         |              |                     |      |
| <b>權限</b>  |MANAGE_MEMBER_READ or MANAGE_MEMBER_CREATE or MANAGE_MEMBER_UPDATE           |        |              |          -          |      |
| <b>參數</b>  |                             |        |              |                     |      |

> 站台選項列表

| 項目         | 內容                         | 類型         | 預設         | 說明                  | 必填  |
|-------------|-----------------------------|--------------|--------------|---------------------|-------|
| <b>路徑</b>  |member/manage/options/branch          |         |              |                     |      |
| <b>方法</b>  | get                        |         |              |                     |      |
| <b>權限</b>  |MANAGE_MEMBER_READ or MANAGE_MEMBER_CREATE or MANAGE_MEMBER_UPDATE           |        |              |          -          |      |
| <b>參數</b>  |                             |        |              |                     |      |
