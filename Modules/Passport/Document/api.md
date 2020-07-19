# 角色

### 後台API

> Password token generate
                    
|URL|請求方法|參數|參數名稱|必填|型態|備註|
|------------- | -------------|--------|-------|------|-----|-----|
|passport/login |POST|grant_type|許可類型|O|string|請填password
| | |client_id|client id|O|string|
| | |client_secret|client secret|O|string|
| | |username|user account|O|string|
| | |password|user password|O|string|

> Password token generate (member)


| 項目            | 內容                    | 類型     | 預設  | 說明        | 必填  |
| ------------- | --------------------- | ------ | --- | --------- | --- |
| <b>路徑</b>     | passport/member/login |        |     |           |     |
| <b>header</b> | Referer               | string |     | 來自哪個網站    | o   |
| <b>方法</b>     | post                  |        |     |           |     |
| <b>權限</b>     |                       |        |     | -         |     |
| <b>參數</b>     |                       |        |     |           |     |
|               | client_id             | string |     | client id | o   |
|               | client_secret         | string |     | client 密碼 | o   |
|               | username              | string |     | 帳號        | o   |
|               | password              | string |     | 密碼        | o   |
|               | device                | string |     | 登入裝置      | x   |


> Personal token generate
                    
|URL|請求方法|參數|參數名稱|必填|型態|備註|
|------------- | -------------|--------|-------|------|-----|-----|
|passport/token/personal/generate |POST(LOGIN)|||||
