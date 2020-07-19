# 節點 api Response

> 取得角色列表

```
{
    "data": [
        {
            "id": 2,
            "display_name": "系統管理員",
            "description": "描述資訊",
            "code": "SYSTEM_MG",
            "enable": "Y",
            "public": "Y",
            "created_at": "2019-06-26 16:35:06",
            "updated_at": "2019-06-26 16:35:06"
        },
        {
            "id": 2,
            "display_name": "系統管理員",// 名稱
            "description": "描述資訊",
            "code": "SYSTEM_MG",// 代碼
            "enable": "Y",// 啟用/停用
            "public": "Y",// 是否公開使用
            "created_at": "2019-06-26 16:35:06",
            "updated_at": "2019-06-26 16:35:06"
        }
    ],
    "code": 0  
}
```

> 取得角色總筆數

```
{
    "data": "2",
    "code": 200  
}
```

> 取得角色資訊

```
{
    "data": {
        "id": 2,
        "display_name": "系統管理員",// 名稱
        "description": "描述資訊",
        "code": "SYSTEM_MG",// 代碼
        "enable": "Y",// 啟用/停用
        "public": "Y",// 是否公開使用
        "created_at": "2019-06-26 16:35:06",
        "updated_at": "2019-06-26 16:35:06"
    },
    "code": 0    
}
```

> 新增角色
```
{
  "code": "0",
  "data": {
    "display_name": "員工",
    "description": "描述資訊",
    "code": "CUSTOM",
    "enable": "Y",
    "updated_at": "2019-12-17 13:29:46",
    "created_at": "2019-12-17 13:29:46",
    "id": 4
  }
}
```

> 編輯角色(成功回傳該筆資料)

```
{
    "data": {
        "id": 2,
        "display_name": "系統管理員",// 名稱
        "description": "描述資訊",
        "code": "SYSTEM_MG",// 代碼
        "enable": "Y",// 啟用/停用
        "public": "Y",// 是否公開使用
        "created_at": "2019-06-26 16:35:06",
        "updated_at": "2019-06-26 16:35:06"
    },
    "code": 0    
}
```

> 刪除角色

```
{
    "data": "1", // 刪除的筆數 , 1表示有1筆資料被刪除
    "code": 0    
}
```

> 公開角色合法節點
```
{
  "code": "0",
  "data": [
    {
      "id": 1,
      "display_name": "角色設定",
      "code": "ROLE_CUSTOM_MANAGE",
      "enable": "Y",
      "display": "Y",
      "public": "Y",
      "created_at": "2019-12-19 15:38:47",
      "updated_at": "2019-12-19 15:38:47",
      "nodes": [
        {
          "id": 1,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-查詢",
          "code": "ROLE_CUSTOM_MANAGE_READ",
          "path": "role.custom.manage.read",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 2,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-新增",
          "code": "ROLE_CUSTOM_MANAGE_CREATE",
          "path": "role.custom.manage.create",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 3,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-編輯",
          "code": "ROLE_CUSTOM_MANAGE_UPDATE",
          "path": "role.custom.manage.update",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 4,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-刪除",
          "code": "ROLE_CUSTOM_MANAGE_DEL",
          "path": "role.custom.manage.del",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 5,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-權限",
          "code": "PUBLIC_ROLE_AUTHORIZATION",
          "path": "role.public.authorization",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        }
      ]
    },
    {
      "id": 2,
      "display_name": "帳號管理",
      "code": "ACCOUNT_MANAGE",
      "enable": "Y",
      "display": "Y",
      "public": "Y",
      "created_at": "2019-12-19 15:38:47",
      "updated_at": "2019-12-19 15:38:47",
      "nodes": [
        {
          "id": 6,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號管理-查詢",
          "code": "ACCOUNT_MANAGE_READ",
          "path": "account.manage.read",
          "node_group_id": 2,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 7,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號管理-新增",
          "code": "ACCOUNT_MANAGE_CREATE",
          "path": "account.manage.create",
          "node_group_id": 2,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 8,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號管理-編輯",
          "code": "ACCOUNT_MANAGE_UPDATE",
          "path": "account.manage.update",
          "node_group_id": 2,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 9,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號管理-刪除",
          "code": "ACCOUNT_MANAGE_DEL",
          "path": "account.manage.del",
          "node_group_id": 2,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        }
      ]
    },
    {
      "id": 3,
      "display_name": "帳號登入歷程",
      "code": "ACCOUNT_LOGIN_HISTORY",
      "enable": "Y",
      "display": "Y",
      "public": "Y",
      "created_at": "2019-12-19 15:38:47",
      "updated_at": "2019-12-19 15:38:47",
      "nodes": [
        {
          "id": 10,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號登入歷程-查詢",
          "code": "ACCOUNT_LOGIN_HISTORY",
          "path": "account.login.history",
          "node_group_id": 3,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        }
      ]
    }
  ]
}
```
> 角色設定-角色權限讀取
```
{
  "code": "0",
  "data": [
    {
      "id": 1,
      "display_name": "角色設定",
      "code": "ROLE_CUSTOM_MANAGE",
      "enable": "Y",
      "display": "Y",
      "public": "Y",
      "created_at": "2019-12-19 15:38:47",
      "updated_at": "2019-12-19 15:38:47",
      "nodes": [
        {
          "id": 1,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-查詢",
          "code": "ROLE_CUSTOM_MANAGE_READ",
          "path": "role.custom.manage.read",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 2,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-新增",
          "code": "ROLE_CUSTOM_MANAGE_CREATE",
          "path": "role.custom.manage.create",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 3,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-編輯",
          "code": "ROLE_CUSTOM_MANAGE_UPDATE",
          "path": "role.custom.manage.update",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 4,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-刪除",
          "code": "ROLE_CUSTOM_MANAGE_DEL",
          "path": "role.custom.manage.del",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 5,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "角色設定-權限",
          "code": "PUBLIC_ROLE_AUTHORIZATION",
          "path": "role.public.authorization",
          "node_group_id": 1,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        }
      ]
    },
    {
      "id": 2,
      "display_name": "帳號管理",
      "code": "ACCOUNT_MANAGE",
      "enable": "Y",
      "display": "Y",
      "public": "Y",
      "created_at": "2019-12-19 15:38:47",
      "updated_at": "2019-12-19 15:38:47",
      "nodes": [
        {
          "id": 6,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號管理-查詢",
          "code": "ACCOUNT_MANAGE_READ",
          "path": "account.manage.read",
          "node_group_id": 2,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 7,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號管理-新增",
          "code": "ACCOUNT_MANAGE_CREATE",
          "path": "account.manage.create",
          "node_group_id": 2,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 8,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號管理-編輯",
          "code": "ACCOUNT_MANAGE_UPDATE",
          "path": "account.manage.update",
          "node_group_id": 2,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        },
        {
          "id": 9,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號管理-刪除",
          "code": "ACCOUNT_MANAGE_DEL",
          "path": "account.manage.del",
          "node_group_id": 2,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        }
      ]
    },
    {
      "id": 3,
      "display_name": "帳號登入歷程",
      "code": "ACCOUNT_LOGIN_HISTORY",
      "enable": "Y",
      "display": "Y",
      "public": "Y",
      "created_at": "2019-12-19 15:38:47",
      "updated_at": "2019-12-19 15:38:47",
      "nodes": [
        {
          "id": 10,
          "enable": "Y",
          "display": "Y",
          "public": "Y",
          "display_name": "帳號登入歷程-查詢",
          "code": "ACCOUNT_LOGIN_HISTORY",
          "path": "account.login.history",
          "node_group_id": 3,
          "created_at": "2019-12-19 15:38:47",
          "updated_at": "2019-12-19 15:38:47"
        }
      ]
    }
  ]
}
```

> 角色綁定節點
```
{
    "data": {
        "attached": [ // 新綁定
            3 // 節點id
        ],
        "detached": { // 解綁
            "1": 2 // 1號角色邦定節點2號
        },
        "updated": [ // 更新綁定
            1 // 節點id
        ]
    },
    "code": 200
}
```
