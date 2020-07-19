# 帳號管理

> 列表
```
{
    "code": "0",
    "data": [
        {
            "id": 2,
            "account": "house", // 帳號
            "display_name": "house系统管理员", // 顯示名稱
            "status": "enable", // 狀態
            "mail": "house@house.cc", 
            "phone": "3939889",
            "login_ip": "172.23.0.1", // 最後一次登入ip
            "created_at": "2019-06-26 18:33:49",
            "updated_at": "2019-06-26 18:34:46",
            "deleted_at": null,
            "remark": null,
            "roles": [ //角色
                {
                    "id": 2,
                    "display_name": "系統管理員",
                    "code": "SYSTEM_MG",
                    "enable": "Y",
                    "public": "Y",
                    "created_at": "2019-06-26 18:33:49",
                    "updated_at": "2019-06-26 18:33:49",
                    "pivot": {
                        "account_id": 2,
                        "role_id": 2,
                        "created_at": "2019-06-26 18:33:49",
                        "updated_at": "2019-06-26 18:33:49"
                    }
                }
            ]
        },
        {
            "id": 3,
            "account": "aaron",
            "display_name": "aaron系统管理员",
            "status": "enable",
            "mail": "aaron@house.cc",
            "phone": "3939889",
            "login_ip": null,
            "created_at": "2019-06-26 18:33:49",
            "updated_at": "2019-06-26 18:33:49",
            "deleted_at": null,
            "remark": null,
            "roles": [
                {
                    "id": 2,
                    "display_name": "系統管理員",
                    "code": "SYSTEM_MG",
                    "enable": "Y",
                    "public": "Y",
                    "created_at": "2019-06-26 18:33:49",
                    "updated_at": "2019-06-26 18:33:49",
                    "pivot": {
                        "account_id": 3,
                        "role_id": 2,
                        "created_at": "2019-06-26 18:33:49",
                        "updated_at": "2019-06-26 18:33:49"
                    }
                }
            ]
        },
        {
            "id": 4,
            "account": "jacc",
            "display_name": "jacc系统管理员",
            "status": "enable",
            "mail": "jacc@house.cc",
            "phone": "3939889",
            "login_ip": null,
            "created_at": "2019-06-26 18:33:49",
            "updated_at": "2019-06-26 18:33:49",
            "deleted_at": null,
            "remark": null,
            "roles": [
                {
                    "id": 2,
                    "display_name": "系統管理員",
                    "code": "SYSTEM_MG",
                    "enable": "Y",
                    "public": "Y",
                    "created_at": "2019-06-26 18:33:49",
                    "updated_at": "2019-06-26 18:33:49",
                    "pivot": {
                        "account_id": 4,
                        "role_id": 2,
                        "created_at": "2019-06-26 18:33:49",
                        "updated_at": "2019-06-26 18:33:49"
                    }
                }
            ]
        }
    ]
}
```

> 總筆數

```
{
  "data": 9,
  "code": 0
}
```

> 查詢選項

```
{
    "code": "0",
    "data": {
        "roles": [ // 角色列表
            {
                "id": 2,
                "display_name": "系統管理員",
                "code": "SYSTEM_MG",
                "enable": "Y",
                "public": "Y",
                "created_at": "2019-06-26 18:33:49",
                "updated_at": "2019-06-26 18:33:49"
            }
        ],
        "status": [
            "enable", // 啟用
            "disable" // 停用
        ]
    }
}
```

> 新增

```
{
    "code": "0",
    "data": {
        "account": "houseclone",
        "display_name": "豪斯複製人",
        "status": "enable",
        "updated_at": "2019-06-27 17:52:45",
        "created_at": "2019-06-27 17:52:45",
        "remark": null,
        "id": 12,
        "roles": [
            {
                "id": 2,
                "display_name": "系統管理員",
                "code": "SYSTEM_MG",
                "enable": "Y",
                "public": "Y",
                "created_at": "2019-06-26 18:33:49",
                "updated_at": "2019-06-26 18:33:49"
            }
        ]
    }
}
```

> 編輯

```
{
    "code": "0",
    "data": {
        "account": "houseclone",
        "display_name": "豪斯複製人",
        "status": "enable",
        "updated_at": "2019-06-27 17:52:45",
        "created_at": "2019-06-27 17:52:45",
        "remark": null,
        "id": 12,
        "roles": [
            {
                "id": 2,
                "display_name": "系統管理員",
                "code": "SYSTEM_MG",
                "enable": "Y",
                "public": "Y",
                "created_at": "2019-06-26 18:33:49",
                "updated_at": "2019-06-26 18:33:49"
            }
        ]
    }
}
```

> 刪除

```
{
  "data": 1, // 刪除的數量
  "code": 0
}
```
