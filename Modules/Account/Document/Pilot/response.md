# 登入者

> 個人檔案

```
{
    "code": "0",
    "data": {
        "id": 2,
        "account": "house",
        "display_name": "house系统管理员",
        "status": "enable",
        "mail": "house@house.cc",
        "phone": "3939889",
        "login_ip": "172.23.0.1",
        "created_at": "2019-06-26 18:33:49",
        "updated_at": "2019-06-26 18:34:46",
        "deleted_at": null,
        "cover": { // 圖像
            "id": 1,
            "account_id": 12,
            "path": "http://sms-api.house.cc/storage/account_cover/A48TxEs05ke32FZ8NZNnlAtbXtqtoRiHnF81QDPQ.jpeg",
            "created_at": "2019-07-10 20:59:34",
            "updated_at": "2019-07-10 20:59:34"
        },
        "roles": [
            {
                "id": 1,
                "display_name": "超級管理員",
                "code": "ADMIN",
                "enable": "Y",
                "public": "N",
                "created_at": "2019-07-25 14:14:08",
                "updated_at": "2019-07-25 14:14:08",
                "pivot": {
                    "account_id": 1,
                    "role_id": 1,
                    "created_at": "2019-07-25 14:14:08",
                    "updated_at": "2019-07-25 14:14:08"
                }
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
        "id": 2,
        "account": "house",
        "display_name": "豪斯bombom管理員",
        "status": "enable",
        "mail": "house@house.cc",
        "phone": "3939889",
        "login_ip": "172.23.0.1",
        "created_at": "2019-06-26 18:33:49",
        "updated_at": "2019-06-27 18:06:15",
        "deleted_at": null,
        "cover": { // 圖像
            "id": 1,
            "account_id": 12,
            "path": "http://sms-api.house.cc/storage/account_cover/A48TxEs05ke32FZ8NZNnlAtbXtqtoRiHnF81QDPQ.jpeg",
            "created_at": "2019-07-10 20:59:34",
            "updated_at": "2019-07-10 20:59:34"
        }
    }
}
```

> 節點地圖

```
{
    "code": "0",
    "data": [
        {
            "id": 1, //節點id
            "enable": "Y", // 啟用,停用
            "display": "Y", // 要不要顯示
            "public": "Y",
            "display_name": "角色設定", // 預設顯示名稱
            "code": "ROLE_CUSTOM_MANAGE", // 代號
            "created_at": "2019-06-26 18:33:49",
            "updated_at": "2019-06-26 18:33:49"
        },
        {
            "id": 2,
            "enable": "Y",
            "display": "N",
            "public": "Y",
            "display_name": "公開角色授權",
            "code": "PUBLIC_ROLE_AUTHORIZATION",
            "created_at": "2019-06-26 18:33:49",
            "updated_at": "2019-06-26 18:33:49"
        },
        {
            "id": 3,
            "enable": "Y",
            "display": "Y",
            "public": "N",
            "display_name": "帳號管理",
            "code": "ACCOUNT_MANAGE",
            "created_at": "2019-06-26 18:33:49",
            "updated_at": "2019-06-26 18:33:49"
        }
    ]
}
```
