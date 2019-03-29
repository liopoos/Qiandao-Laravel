<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>欢迎注册签到(Beta)</title>
    <style>
        body {
            margin: 0;
        }

        td, p {
            font-size: 13px;
            color: #878787;
        }

        ul {
            margin: 0 0 10px 25px;
            padding: 0;
        }

        li {
            margin: 0 0 3px 0;
        }

        h1, h2 {
            color: black;
        }

        h1 {
            font-size: 25px;
        }

        h2 {
            font-size: 20px;
        }

        a {
            color: #2F82DE;
            font-weight: bold;
            text-decoration: none;
        }

        .entire-page {
            background: #fff;
            width: 100%;
            padding: 20px 0;
            font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif;
            line-height: 1.5;
        }

        .email-body {
            max-width: 600px;
            min-width: 320px;
            margin: 0 auto;
            background: white;
            border-collapse: collapse;
        }

        .email-body img {
            max-width: 100%;
        }

        .email-header {
            background: black;
            padding: 30px;
        }

        .news-section {
            padding: 20px 30px;
        }

        .footer {
            background: #eee;
            padding: 10px;
            font-size: 10px;
            text-align: center;
        }

    </style>
</head>
<body>
<table class="entire-page">
    <tr>
        <td>
            <table class="email-body">
                <tr>
                    <td class="email-header"></td>
                </tr>
                <tr>
                    <td class="news-section">
                        <h1>欢迎注册签到(Beta)。</h1>
                        <a href="https://blog.codepen.io/documentation/pro-features/pro-teams/"></a>
                        <p>签到(Beta)是一个可以进行多个站点签到的开源程序，由PHP强力驱动，使用Laravel框架。</p>
                        <p><a href="{{env('APP_URL','http://qiandao.mayuko.cn')}}">开始使用 &rarr;</a></p>
                    </td>
                </tr>
                <tr>
                    <td class="footer">
                        您收到了这封邮件因为您正在注册签到(Beta)，如果这不是您的操作，请删除此邮件。
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>