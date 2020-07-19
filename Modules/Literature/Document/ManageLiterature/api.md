# 成人文學-文學管理

## 權限

+ MANAGE_LITERATURE
+ MANAGE_LITERATURE_READ
+ MANAGE_LITERATURE_CREATE
+ MANAGE_LITERATURE_UPDATE
+ MANAGE_LITERATURE_DELETE
+ MANAGE_LITERATURE_VOLUME
+ MANAGE_LITERATURE_VOLUME_READ
+ MANAGE_LITERATURE_VOLUME_CREATE
+ MANAGE_LITERATURE_VOLUME_UPDATE
+ MANAGE_LITERATURE_VOLUME_DELETE

> 文學列表

|     項目      |內容                    |類型        |預設    |說明         |必填    |
|:-----------:|:---------------------|:---------|:-----|:----------|:-----|
|  <b>路徑</b>  |literature/manage/    |          |      |           |      |
|  <b>方法</b>  |GET                   |          |      |           |      |
|  <b>權限</b>  |                      |          |      |           |      |
|              |MANAGE_LITERATURE_READ|           |     |           |      |  
|  <b>參數</b>  |                      |          |      |           |      |
|             |region_id             |int       |      |地區id       |x     |
|             |year_id               |int       |      |年份id       |x     |
|             |genres_ids            |int[]     |      |類型id[]     |x     |
|             |title                 |string    |      |標題         |x     |
|             |status                |string    |      |狀態(Y\N)    |x     |
|             |page                  |int       |1     |頁數         |x     |
|             |perpage               |int       |20    |一頁幾筆       |x     |
> 新增文學

|     項目      |內容                    |類型        |預設    |說明                   |必填    |
|:-----------:|:---------------------|:---------|:-----|:--------------------|:-----|
|  <b>路徑</b>  |literature/manage/    |          |      |                     |      |
|  <b>方法</b>  |POST                  |          |      |                     |      |
|  <b>權限</b>  |                      |          |      |                     |      |
|              |MANAGE_LITERATURE_CREATE|           |     |           |      |
|  <b>參數</b>  |                      |          |      |                     |      |
|             |cover                 |file      |      |封面圖片,最大解析度500x500    |x     |
|             |title                 |string    |      |標題,最多20字             |o     |
|             |region_id             |int       |      |地區id                 |o     |
|             |genres_ids            |int[]     |      |類型id[]               |o     |
|             |year_id               |int       |      |年份id                 |o     |
|             |description           |string    |      |描述內容                 |x     |
|             |views                 | int  |       0     |    瀏覽次數(人氣 )   |  x  |
|             |score                 | float  |      0  |   評分(0.0 ~ 10.0)   |  x  |
|             |alias                 |string    |      |別名,最多20字             |x     |
|             |tags                  |string    |      |標籤列表,以`,`隔開          |x     |
|             |image_ids             |int[]     |      |編輯器圖片id[]            |x     |
|             |status                |string    |      |狀態(Y\N)              |o     |
> 文學總數

|     項目      |內容                         |類型        |預設    |說明         |必填    |
|:-----------:|:--------------------------|:---------|:-----|:----------|:-----|
|  <b>路徑</b>  |literature/manage/count    |          |      |           |      |
|  <b>方法</b>  |GET                        |          |      |           |      |
|  <b>權限</b>  |                           |          |      |           |      |
|              |MANAGE_LITERATURE_READ     |           |     |           |      |
|  <b>參數</b>  |                           |          |      |           |      |
|             |region_id                  |int       |      |地區id       |x     |
|             |year_id                    |int       |      |年份id       |x     |
|             |genres_ids                 |int[]     |      |類型id[]     |x     |
|             |title                      |string    |      |標題         |x     |
|             |status                     |string    |      |狀態(Y\N)    |x     |
> 刪除文學

|     項目      |內容                    |類型     |預設    |說明    |必填    |
|:-----------:|:---------------------|:------|:-----|:-----|:-----|
|  <b>路徑</b>  |literature/manage/    |       |      |      |      |
|  <b>方法</b>  |DELETE                |       |      |      |      |
|              |MANAGE_LITERATURE_DELETE|           |     |           |      |
|  <b>權限</b>  |                      |       |      |      |      |
|  <b>參數</b>  |                      |       |      |      |      |
|             |id                    |int    |      |id    |o     |
> 編輯文學

|     項目      |內容                          |類型        |預設    |說明                   |必填    |
|:-----------:|:---------------------------|:---------|:-----|:--------------------|:-----|
|  <b>路徑</b>  |literature/manage/update    |          |      |                     |      |
|  <b>方法</b>  |POST                        |          |      |                     |      |
|  <b>權限</b>  |                            |          |      |                     |      |
|              |MANAGE_LITERATURE_UPDATE    |           |     |           |      |
|  <b>參數</b>  |                            |          |      |                     |      |
|             |id                          |int       |      |id                   |o     |
|             |cover                       |file      |      |封面圖片,最大解析度500x500    |x     |
|             |title                       |string    |      |標題,最多20字             |o     |
|             |region_id                   |int       |      |地區id                 |o     |
|             |genres_ids                  |int[]     |      |類型id[]               |o     |
|             |year_id                     |int       |      |年份id                 |o     |
|             |status                      |string    |      |狀態(Y\N)              |o     |
|             |description                 |string    |      |描述內容                 |x     |
|             |views                 | int  |       0     |    瀏覽次數(人氣 )   |  x  |
|             |score                 | float  |      0  |   評分(0.0 ~ 10.0)   |  x  |
|             |alias                       |string    |      |別名,最多20字             |x     |
|             |tags                        |string    |      |標籤列表,以`,`隔開          |x     |
|             |image_ids                   |int[]     |      |編輯器圖片id[]            |x     |
|             |remove_cover                |boolean   |false |是否刪除原有封面           |x    |

### 集數

> 新增集數

|     項目      |內容                           |類型        |預設    |說明           |必填    |
|:-----------:|:----------------------------|:---------|:-----|:------------|:-----|
|  <b>路徑</b>  |literature/manage/volume/    |          |      |             |      |
|  <b>方法</b>  |POST                         |          |      |             |      |
|  <b>權限</b>  |                             |          |      |             |      |
|              |MANAGE_LITERATURE_VOLUME_CREATE|       |      |             |      |
|  <b>參數</b>  |                             |          |      |             |      |
|             |literature_id                |int       |      |集數所屬文學的id    |o     |
|             |title                        |string    |      |標題           |o     |
|             |content                      |string    |      |內容           |x     |
|             |open_at                      |string    |      |開放時間         |o     |
|             |status                       |string    |      |狀態(Y\N)      |o     |
|             |image_ids                    |int[]     |      |編輯器圖片id[]    |x     |

> 集數總數

|     項目      |內容                                |類型     |預設    |說明           |必填    |
|:-----------:|:---------------------------------|:------|:-----|:------------|:-----|
|  <b>路徑</b>  |literature/manage/volume/count    |       |      |             |      |
|  <b>方法</b>  |GET                               |       |      |             |      |
|  <b>權限</b>  |                                  |       |      |             |      |
|              |MANAGE_LITERATURE_VOLUME_READ     |       |      |             |      |
|  <b>參數</b>  |                                  |       |      |             |      |
|             |literature_id                     |int    |      |集數所屬文學的id    |o     |

> 刪除集數

|     項目      |內容                           |類型     |預設    |說明           |必填    |
|:-----------:|:----------------------------|:------|:-----|:------------|:-----|
|  <b>路徑</b>  |literature/manage/volume/    |       |      |             |      |
|  <b>方法</b>  |DELETE                       |       |      |             |      |
|  <b>權限</b>  |                             |       |      |             |      |
|              |MANAGE_LITERATURE_VOLUME_DELETE|       |      |             |      |
|  <b>參數</b>  |                             |       |      |             |      |
|             |id                           |int    |      |id           |o     |
|             |literature_id                |int    |      |集數所屬文學的id    |o     |

> 集數列表

|     項目      |內容                           |類型     |預設    |說明           |必填    |
|:-----------:|:----------------------------|:------|:-----|:------------|:-----|
|  <b>路徑</b>  |literature/manage/volume/    |       |      |             |      |
|  <b>方法</b>  |GET                          |       |      |             |      |
|  <b>權限</b>  |                             |       |      |             |      |
|              |MANAGE_LITERATURE_VOLUME_READ|       |      |             |      |
|  <b>參數</b>  |                             |       |      |             |      |
|             |id                           |int    |      |id           |o     |
|             |literature_id                |int    |      |集數所屬文學的id    |o     |
|             |page                         |int    |1     |頁數           |x     |
|             |perpage                      |int    |20    |一頁幾筆         |x     |

> 更新集數

|     項目      |內容                                 |類型        |預設    |說明           |必填    |
|:-----------:|:----------------------------------|:---------|:-----|:------------|:-----|
|  <b>路徑</b>  |literature/manage/volume/         |          |      |             |      |
|  <b>方法</b>  |PUT                               |          |      |             |      |
|  <b>權限</b>  |                                   |          |      |             |      |
|              |MANAGE_LITERATURE_VOLUME_UPDATE    |       |      |             |      |
|  <b>參數</b>  |                                   |          |      |             |      |
|             |id                                 |int       |      |id           |o     |
|             |literature_id                      |int       |      |集數所屬文學的id    |o     |
|             |content                            |string    |      |內容           |x     |
|             |open_at                            |string    |      |開放時間         |o     |
|             |status                             |string    |      |狀態(Y\N)      |x     |
|             |image_ids                          |int[]     |      |編輯器圖片id[]    |x     |

### 編輯器

> 文學-上傳編輯器圖片

|     項目      |內容                                |類型      |預設    |說明    |必填    |
|:-----------:|:---------------------------------|:-------|:-----|:-----|:-----|
|  <b>路徑</b>  |literature/manage/image          |        |      |      |      |
|  <b>方法</b>  |POST                              |        |      |      |      |
|  <b>權限</b>  |                                  |        |      |      |      |
|              |MANAGE_LITERATURE_CREATE   |       |      |             |      |
|              |MANAGE_LITERATURE_UPDATE     |       |      |             |      |
|  <b>參數</b>  |                                  |        |      |      |      |
|             |image                             |file    |      |圖片    |o     |

> 文學-刪除編輯器圖片

|     項目      |內容                                |類型     |預設    |說明      |必填    |
|:-----------:|:---------------------------------|:------|:-----|:-------|:-----|
|  <b>路徑</b>  |literature/manage/image          |       |      |        |      |
|  <b>方法</b>  |DELETE                            |       |      |        |      |
|  <b>權限</b>  |                                  |       |      |        |      |
|              |MANAGE_LITERATURE_CREATE   |       |      |             |      |
|              |MANAGE_LITERATURE_UPDATE     |       |      |             |      |
|  <b>參數</b>  |                                  |       |      |        |      |
|             |image_id                          |int    |      |圖片id    |o     |

> 集數-上傳編輯器圖片

|     項目      |內容                                |類型      |預設    |說明    |必填    |
|:-----------:|:---------------------------------|:-------|:-----|:-----|:-----|
|  <b>路徑</b>  |literature/manage/volume/image    |        |      |      |      |
|  <b>方法</b>  |POST                              |        |      |      |      |
|  <b>權限</b>  |                                  |        |      |      |      |
|              |MANAGE_LITERATURE_VOLUME_CREATE   |       |      |             |      |
|              |MANAGE_LITERATURE_VOLUME_UPDATE     |       |      |             |      |
|  <b>參數</b>  |                                  |        |      |      |      |
|             |image                             |file    |      |圖片    |o     |

> 集數-刪除編輯器圖片

|     項目      |內容                                |類型     |預設    |說明      |必填    |
|:-----------:|:---------------------------------|:------|:-----|:-------|:-----|
|  <b>路徑</b>  |literature/manage/volume/image    |       |      |        |      |
|  <b>方法</b>  |DELETE                            |       |      |        |      |
|  <b>權限</b>  |                                  |       |      |        |      |
|              |MANAGE_LITERATURE_VOLUME_CREATE   |       |      |             |      |
|              |MANAGE_LITERATURE_VOLUME_UPDATE     |       |      |             |      |
|  <b>參數</b>  |                                  |       |      |        |      |
|             |image_id                          |int    |      |圖片id    |o     |


## 設定選項

> 取得可用的地區

|     項目      |內容                                  |類型     |預設    |說明      |必填    |
|:-----------:|:--------------------------------------|:------|:-----|:-------|:-----|
|  <b>路徑</b>  |literature/manage/options/get_region  |       |      |        |      |
|  <b>方法</b>  |GET                                   |       |      |        |      |
|              |MANAGE_LITERATURE_READ         |       |      |             |      |

> 取得可用的年份

|     項目      |內容                                  |類型     |預設    |說明      |必填    |
|:-----------:|:--------------------------------------|:------|:-----|:-------|:-----|
|  <b>路徑</b>  |literature/manage/options/get_year  |       |      |        |      |
|  <b>方法</b>  |GET      
|              |MANAGE_LITERATURE_READ         |       |      |             |      |


> 取得可用的類型

|     項目      |內容                                  |類型     |預設    |說明      |必填    |
|:-----------:|:--------------------------------------|:------|:-----|:-------|:-----|
|  <b>路徑</b>  |literature/manage/options/get_genres  |       |      |        |      |
|  <b>方法</b>  |GET      
|              |MANAGE_LITERATURE_READ         |       |      |             |      |
