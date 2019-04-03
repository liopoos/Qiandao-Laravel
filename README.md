# 签到(Beta) 

### 这是什么

签到(Beta)是一个可以进行多个站点签到的开源程序，由PHP强力驱动，使用Laravel(5.8)框架。

### 如何使用

⚠️ 这不是一个即开即用的程序，可能需要以下基础：

- 了解使用Charles进行抓包方式
- 了解HTTP协议和请求方式
- 了解JSON
- 了解Cookie、UA等一些基本的请求Header和请求Body体
- 能够忍受炒鸡简单的界面和不怎么有逻辑性的操作

没关系，签到(Beta)提供了一些基本的模板，可以直接使用。

### 模板

模板提供了一个请求套件，每个用户都可以创建自己的模板，一些公共模板将会展示在「模板列表」中。其实这些模板的结构很简单，主要有以下构成：

- **请求地址** - 声明该条请求的请求地址
- **请求方式** - 声明该条请求的请求方式（GET/POST/PUT等）
- **请求Header** - 很多请求需要携带自己的请求头部，大多是需要注意Cookie、Refer等
- **请求Query / GET** - GET方式携带的字段
- **请求POST** - POST方式携带的字段
- **响应字段格式** - 响应字段的格式，目前支持JSON格式
- **响应字段** - 请求后返回的响应字段，可以多个字段，需要指明各个字段的关系
- **响应关系** - 响应的字段之间的关系，支持与、或关系

这里有一个详细的模板，可以根据这个模板了解模板的构成👉[网易云音乐桌面端签到](http://qiandao.test/template/10)

### 创建模板

创建模板时，需要导出Charles的HAR文件，然后粘贴在「HAR文件」输入框中，之后，分别填写需要替换的Header（一般为Cookie）和Query/GET以及POST字段，若没有，请保留输入框中的「[]」，然后还需要添加响应的字段。

**响应字段**用来确认请求URL时返回的信息是否成功，在创建模板时请确认该条请求一定会返回`JSON`格式的数据，否则系统会解析失败。

比如一条请求的响应为：

```
{
  "code":200,
  "msg":"签到成功"
}
```

你已经看到，当code为200的时候表示签到成功，则你可以填写 `{"code":200}`。

但是如果code为100的时候也表示签到成功（比如重复签到），你也可以填写两种code的情况：`[{"code":200},{"code":100}]`。填写完响应后，你需要指明两个code的关系，目前支持与、或的关系。从而确定是「所有条件都必须满足」还是「只满足一个条件」即可。

⚠️ 除了模板名称和描述，所有的字段都需要`JSON`格式的数据，否则将提交失败。

🧨️ 如果一条响应是非JSON格式（HTML）或者不需要验证响应，可以在**响应关系**选择「所有的条件都不需要满足」，这时系统将会认为所有的响应都是成功的。

### 任务

选择一个模板，然后可以创建该模板的任务。系统会在每天的凌晨1点钟和下午13点钟进行所有任务的签到，你可以在「仪表盘」中查看所有的任务和模板，同时，「日志」页面会显示所有任务的执行情况。

除了「日志」，「消息」页面提供了你的日常操作。

### 创建任务

选择一个模板，点击右边的创建任务即可创建当前模板的任务，创建任务页面的侧边栏提供了需要替换的字段，由于字段的不确定性，系统没有验证所有的字段，你可以在创建之后进行测试。

💡 任务暂时不支持修改，需要修改请删除任务重新填写。

### 扩展性

签到(Beta)使用Laravel框架，你可以创建数据库并部署程序到自己的服务器。

**创建任务调度**

目前签到(Beta)提供了两种任务调度的方法：

1. 使用云监控（阿里云监控）请求API文档中的`/do`。
2. 使用Crontab任务调度，可以参考Laravel[官方文档](https://learnku.com/docs/laravel/5.8/scheduling/3924#96da65)。👈推荐

### 安全性

🔒 签到(Beta)的工作原理为模拟登录，而Cookie或Session是大多数网页的认证方式，所以当你提交Cookie时，服务器提供者会获取你账号一定的权限，所以如果你不放心提交的数据是否会被滥用，可以[Clone](https://github.com/mayuko2012/Qiandao-Laravel)仓库，并部署在自己的服务器中。[Laravel文档](https://learnku.com/docs/laravel/5.8/deployment/3884)提供了Apache或Nginx的部署方式。