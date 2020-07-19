# 帳號登入歷程

> 列表

```
{
   "code": "0",
   "data": [
       {
           "account_id": 5,
           "login_ip": "172.25.0.1",
           "created_at": "2019-07-01 16:57:44",
           "updated_at": "2019-07-01 16:57:44",
           "account": { // 帳號
               "id": 5,
               "account": "funny", 帳號
               "display_name": "funny系统管理员", 帳號匿稱
               "status": "enable",
               "mail": "funny@house.cc",
               "phone": "3939889",
               "login_ip": "172.25.0.1",
               "created_at": "2019-06-28 18:04:01",
               "updated_at": "2019-07-01 16:59:23",
               "deleted_at": null,
               "roles": [ // 角色列表
                   {
                       "id": 2,
                       "display_name": "系統管理員", //角色名稱
                       "code": "SYSTEM_MG", //角色代碼
                       "enable": "Y", //狀態
                       "public": "Y", //公開狀態
                       "created_at": "2019-06-28 18:04:01",
                       "updated_at": "2019-06-28 18:04:01",
                       "pivot": {
                           "account_id": 5,
                           "role_id": 2,
                           "created_at": "2019-06-28 18:04:01",
                           "updated_at": "2019-06-28 18:04:01"
                       }
                   }
               ]
           }
       }
   ]
}
```

> 總筆數

```
{
   "code": "0",
   "data": "2"
}
```

> 查詢選項

```
{
  "code": "0",
  "data": {
    "role": [
      {
        "id": 2,
        "display_name": "系統管理員",
        "code": "SYSTEM_MG",
        "enable": "Y",
        "public": "Y",
        "created_at": "2019-06-28 18:04:01",
        "updated_at": "2019-06-28 18:04:01"
      }
    ]
  }
}
```
