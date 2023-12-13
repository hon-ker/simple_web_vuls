<!DOCTYPE html>
<html>

<head>
    <title>文件上传</title>
    <meta charset="utf-8">
    <style>
        body {
            padding: 10px;
            max-width: 30em;
            margin: 0 auto;
            font-family: "Joe Font", "Helvetica Neue", Helvetica, "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", Arial, "sans-serif";
        }

        * {
            font-size: 16px;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            font-size: 16px;
        }


        input[type="text"] {
            max-width: 100%;
            padding: 5px 10px;
            outline: none;
            border: none;
        }

        .submit {
            display: block;
            width: 100%;
        }

        .logo {
            background-color: #9999ff;
            color: white;
            font-size: 54px;
            font-style: italic;
            font-weight: 800;
            padding: 30px 20px;
            border-radius: 4px;
            text-align: center;
        }

        .show {
            background-color: #eee;
            padding: 20px;
            overflow: scroll;
            position: relative;
        }

        .show * {
            position: relative;
        }
    </style>
</head>

<body>
    <div class="logo">
        SSRF
    </div>
    <!-- 上传form -->
    <form action="ssrf.php" method="post">
        <h2>网址:<input type="text" name="url" placeholder="请输入要访问的url"></h2>

        <input type="submit" value="提交" name="submit" class="submit">
    </form>
    <div class="show">
        <?php

        if (isset($_POST['url'])) {
            $url = $_POST['url'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $res = curl_exec($ch);

            if (curl_errno($ch)) {
                // 如果 cURL 发生错误，打印错误信息
                echo 'cURL Error: ' . curl_error($ch);
            } else {
                // 如果 cURL 没有错误，打印返回的内容
                echo "$res";
            }

            curl_close($ch);
        }

        ?>
    </div>

</body>

</html>