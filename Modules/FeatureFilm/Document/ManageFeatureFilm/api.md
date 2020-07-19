# 長片管理

## 權限列表

+ MANAGE_FEATURE_FILM 
+ MANAGE_FEATURE_FILM_READ
+ MANAGE_FEATURE_FILM_CREATE
+ MANAGE_FEATURE_FILM_UPDATE
+ MANAGE_FEATURE_FILM_DELETE
+ MANAGE_FEATURE_FILM_VIDEO 

> 新增長片

|     項目      |內容                      |類型        |預設    |說明                                |必填    |
|:-----------:|:--------------------------|:---------|:-----|:---------------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/        |          |      |                                  |      |
|  <b>方法</b>  |POST                      |          |      |                                  |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_CREATE  |          |      |                                  |      |
|  <b>參數</b>  |                          |          |      |                                  |      |
|              |title                     |string    |      |標題,最大20字                          |o     |
|              |cover                     |file      |      |封面圖片,最大解析263x300                  |x     |
|              |alias                     |string    |      |別名,最大20字                          |x     |
|              |mosaic_type               |string    |      |片種,(WITH_MOSAIC有碼/NO_MOSAIC無碼)    |o     |
|              |region_id                 |int       |      |地區id                              |o     |
|              |av_actress_ids            |int[]     |      |女優id[]                            |o     |
|              |cup_id                    |int       |      |罩杯id                              |o     |
|              |genres_ids                |int[]     |      |類型id[]                            |o     |
|              |year_id                   |int       |      |年份id                              |o     |
|              |tags                      |string    |      |標籤列表 以`,`串成字串                     |x     |
|              |description               |string    |      |長片描述, html格式                      |x     |
|              |views                        | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|              |score                        | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|              |status                    |string    |      |狀態(Y\N)                           |o     |
|              |image_ids                 |int[]     |      |編輯器圖片id[]                         |x     |
> 編輯長片

|     項目      |內容                        |類型        |預設    |說明                                |必填    |
|:-----------:|:-------------------------|:---------|:-----|:---------------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/edit    |          |      |                                  |      |
|  <b>方法</b>  |POST                      |          |      |                                  |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_UPDATE  |          |      |                                  |      |
|  <b>參數</b>  |                          |          |      |                                  |      |
|              |id                        |int       |      |id                                |o     |
|              |title                     |string    |      |標題,最大20字                          |o     |
|              |cover                     |file      |      |封面圖片,最大解析263x300                  |x     |
|              |alias                     |string    |      |別名,最大20字                          |x     |
|              |mosaic_type               |string    |      |片種,(WITH_MOSAIC有碼/NO_MOSAIC無碼)    |o     |
|              |region_id                 |int       |      |地區id                              |o     |
|              |av_actress_ids            |int[]     |      |女優id[]                            |o     |
|              |cup_id                    |int       |      |罩杯id                              |o     |
|              |genres_ids                |int[]     |      |類型id[]                            |o     |
|              |year_id                   |int       |      |年份id                              |o     |
|              |tags                      |string    |      |標籤列表 以`,`串成字串                     |x     |
|              |description               |string    |      |長片描述, html格式                      |x     |
|              |views                        | int  |       0     |    瀏覽次數(人氣 )               |  x  |
|              |score                        | float  |      0  |   評分(0.0 ~ 10.0)                |  x  |
|              |status                    |string    |      |狀態(Y\N)                           |o     |
|              |image_ids                 |int[]     |      |編輯器圖片id[]                         |x     |
|              |remove_cover              |boolean   | false|是否刪除原有封面                        |x     |
> 長片-影片管理

|     項目      |內容                      |類型        |預設    |說明                           |必填    |
|:-----------:|:-------------------------|:---------|:-----|:----------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/video_manage/ |          |      |                             |      |
|  <b>方法</b>  |POST                     |          |      |                             |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_VIDEO  |          |      |                             |      |
|  <b>參數</b>  |                         |          |      |                             |      |
|              |id                       |int       |      |id                           |o     |
|              |video                    |file      |      |長片, mpeg/mp4                 |x     |
|              |video_status             |string    |      |影片狀態(Y\N)                      |o     |
|              |open_at                  |string    |      |開放時間, yyyy-MM-dd HH:mm:ss    |o     |
|              |remove_video             |boolean   | false|是否刪除原有影片                  | x |
> 刪除長片

|     項目      |內容                      |類型     |預設    |說明    |必填    |
|:-----------:|:--------------------------|:------|:-----|:-----|:-----|
|  <b>路徑</b>  |feature_film/manage/        |       |      |      |      |
|  <b>方法</b>  |DELETE                    |       |      |      |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_DELETE  |       |      |      |      |
|  <b>參數</b>  |                          |       |      |      |      |
|              |id                        |int    |      |id    |o     |
> 長片列表

|     項目      |內容                    |類型        |預設    |說明                                |必填    |
|:-----------:|:----------------------- |:---------|:-----|:---------------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/     |          |      |                                  |      |
|  <b>方法</b>  |GET                    |          |      |                                  |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_READ |          |      |                                  |      |
|  <b>參數</b>  |                       |          |      |                                  |      |
|              |mosaic_type            |string    |      |片種,(WITH_MOSAIC有碼/NO_MOSAIC無碼)    |x     |
|              |region_id              |int       |      |地區id                              |x     |
|              |av_actress_ids         |int[]     |      |女優id[]                            |x     |
|              |genres_ids             |int[]     |      |類型id[]                            |x     |
|              |cup_id                 |int       |      |罩杯id                              |x     |
|              |year_id                |int       |      |年份id                              |x     |
|              |status                 |string    |      |狀態(Y\N)                           |x     |
|              |title                  |string    |      |標題                                |x     |
|              |page                   |int       |1     |頁數                                |x     |
|              |perpage                |int       |20    |一頁幾筆                              |x     |
> 長片總數

|     項目      |內容                         |類型        |預設    |說明                                |必填    |
|:-----------:|:--------------------------|:---------|:-----|:---------------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/total   |          |      |                                  |      |
|  <b>方法</b>  |GET                       |          |      |                                  |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_READ    |          |      |                                  |      |
|  <b>參數</b>  |                          |          |      |                                  |      |
|              |mosaic_type                |string    |      |片種,(WITH_MOSAIC有碼/NO_MOSAIC無碼)    |x     |
|              |region_id                  |int       |      |地區id                              |x     |
|              |av_actress_ids             |int[]     |      |女優id[]                            |x     |
|              |genres_ids                 |int[]     |      |類型id[]                            |x     |
|              |cup_id                     |int       |      |罩杯id                              |x     |
|              |year_id                    |int       |      |年份id                              |x     |
|              |status                     |string    |      |狀態(Y\N)                           |x     |
|              |title                      |string    |      |標題                                |x     |

## 編輯器

> 編輯器圖片上傳

|     項目      |內容                     |類型        |預設    |說明                        |必填    |
|:------------:|:------------------------|:---------|:-----|:----------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/image/ |          |      |                             |      |
|  <b>方法</b>  |POST                     |          |      |                             |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_CREATE |          |      |                             |      |
|              |MANAGE_FEATURE_FILM_UPDATE |          |      |                             |      |
|  <b>參數</b>  |                        |          |      |                             |      |
|             |image                    |file      |      |上團的圖片                     |o     |

> 編輯器圖片刪除

|     項目      |內容                    |類型        |預設    |說明                           |必填    |
|:-----------:|:------------------------|:---------|:-----|:----------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/image/ |          |      |                             |      |
|  <b>方法</b>  |DELETE                   |          |      |                             |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_CREATE |          |      |                             |      |
|              |MANAGE_FEATURE_FILM_UPDATE |          |      |                             |      |
|  <b>參數</b>  |                        |          |      |                             |      |
|              |image_id                |int       |      |id                           |o     |

## 設定選項

> 取得可用的年份

|     項目      |內容                         |類型        |預設    |說明                                |必填    |
|:-----------:|:--------------------------|:---------|:-----|:---------------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/options/get_year    |          |      |                                  |      |
|  <b>方法</b>  |GET                                   |          |      |                                  |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_READ                |          |      |                                  |      |

> 取得可用的類型

|     項目      |內容                         |類型        |預設    |說明                                |必填    |
|:-----------:|:--------------------------|:---------|:-----|:---------------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/options/get_genres    |          |      |                                  |      |
|  <b>方法</b>  |GET                                   |          |      |                                  |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_READ    |          |      |                                  |      |

> 取得可用的地區

|     項目      |內容                         |類型        |預設    |說明                                |必填    |
|:-----------:|:--------------------------|:---------|:-----|:---------------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/options/get_region    |          |      |                                  |      |
|  <b>方法</b>  |GET                                   |          |      |                                  |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_READ    |          |      |                                  |      |

> 取得可用的女優

|     項目      |內容                         |類型        |預設    |說明                                |必填    |
|:-----------:|:--------------------------|:---------|:-----|:---------------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/options/get_av_actress    |          |      |                                  |      |
|  <b>方法</b>  |GET                                   |          |      |                                  |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_READ    |          |      |                                  |      |

> 取得可用的罩杯

|     項目      |內容                         |類型        |預設    |說明                                |必填    |
|:-----------:|:--------------------------|:---------|:-----|:---------------------------------|:-----|
|  <b>路徑</b>  |feature_film/manage/options/get_cup    |          |      |                                  |      |
|  <b>方法</b>  |GET                                   |          |      |                                  |      |
|  <b>權限</b>  |MANAGE_FEATURE_FILM_READ    |          |      |                                  |      |
