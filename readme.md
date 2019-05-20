# 西安交通大学西迁纪念馆预约程序
为校内外提供方便的西迁纪念馆参观预约入口
## 时间线
* 2018年05月完，成初版并上线
* 2018年11月，开始新版开发
## 部署
### 环境要求
<https://laravel.com/docs/5.5>  

    PHP >= 7.0.0  
    OpenSSL PHP Extension  
    PDO PHP Extension  
    Mbstring PHP Extension  
    Tokenizer PHP Extension  
    XML PHP Extension  
### 部署流程
1.将项目文件放置在服务器目录下  
2.新建数据库与数据库用户  
3.将 `.env.example` 复制到 `.env` 并修改其中数据库与API的配置  
4.执行 `php artisan key:generate`   
5.执行 `php artisan jwt:secret`   
6.执行 `php artisan storage:link`   
## 说明
* 本项目用户界面主要通过小程序实现  
* 直接访问项目部署的域名可进入管理后台  
* 后台管理权限由密码控制，可新建管理用户
## CONTRIBUTORS
* 设计 [TNT](#)  
* 前端 [Veeupup](https://github.com/Veeupup)  
* 后端 [f(x,z)=xzx](https://github.com/XuZhixuan)  
## LICENSE
[MIT License](https://opensource.org/licenses/MIT)  

    Copyright (c) 2018 eeyes.net

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.