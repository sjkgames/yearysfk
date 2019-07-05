<?php
/**
 * 云尚发卡安装程序
 *
 * 安装完成后建议删除此文件
 * @author Ashang
 * @website http://www.yunscx.com
 */
// 定义目录分隔符
define('DS', DIRECTORY_SEPARATOR);

// 定义根目录
define('ROOT_PATH', __DIR__ . DS);

// 定义应用目录
define('APP_PATH', ROOT_PATH . 'app' . DS);

// 安装包目录
define('INSTALL_PATH', ROOT_PATH . 'install' . DS );

// 判断文件或目录是否有写的权限
function is_really_writable($file)
{
    if (DIRECTORY_SEPARATOR == '/' AND @ ini_get("safe_mode") == FALSE)
    {
        return is_writable($file);
    }
    if (!is_file($file) OR ( $fp = @fopen($file, "r+")) === FALSE)
    {
        return FALSE;
    }

    fclose($fp);
    return TRUE;
}

$sitename = "云尚发卡系统";

$link = array(
    'qqun'  => "//shang.qq.com/wpa/qunwpa?idkey=1e49d2248419ff6332a24991a124148fde9e89aa531835ad51f8ad0e474d9974",
);




//错误信息
$errInfo = '';

//数据库配置文件
$dbConfigFile = APP_PATH . 'db.php';
// 锁定的文件
$lockFile = INSTALL_PATH . 'install.lock';
if (is_file($lockFile))
{
    $errInfo = "当前已经安装{$sitename}，如果需要重新安装，请手动移除/install/install.lock文件";
}
else if (version_compare(PHP_VERSION, '5.6.0', '<'))
{
    $errInfo = "当前版本(" . PHP_VERSION . ")过低，请使用PHP5.6或以上版本，官方建议php7.0";
}
else if (!extension_loaded("PDO"))
{
    $errInfo = "当前未开启PDO，无法进行安装";
}
else if (!is_really_writable($dbConfigFile))
{
    $errInfo = "当前权限不足，无法写入配置文件/Config.php";

}
// 当前是POST请求
if (!$errInfo && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    $err = '';
    $mysqlHostname = isset($_POST['mysqlHost']) ? $_POST['mysqlHost'] : 'localhost';
    $mysqlHostport = 3306;
    $hostArr = explode(':', $mysqlHostname);
    if (count($hostArr) > 1)
    {
        $mysqlHostname = $hostArr[0];
        $mysqlHostport = $hostArr[1];
    }
    $mysqlUsername = isset($_POST['mysqlUsername']) ? $_POST['mysqlUsername'] : 'root';
    $mysqlPassword = isset($_POST['mysqlPassword']) ? $_POST['mysqlPassword'] : '';
    $mysqlDatabase = isset($_POST['mysqlDatabase']) ? $_POST['mysqlDatabase'] : 'ysfk';
    $adminUsername = isset($_POST['adminUsername']) ? $_POST['adminUsername'] : 'admin';
    $adminPassword = isset($_POST['adminPassword']) ? $_POST['adminPassword'] : '123456';
    $adminPasswordConfirmation = isset($_POST['adminPasswordConfirmation']) ? $_POST['adminPasswordConfirmation'] : '123456';
    $adminEmail = isset($_POST['adminEmail']) ? $_POST['adminEmail'] : 'admin@admin.com';

    if ($adminPassword !== $adminPasswordConfirmation)
    {
        echo "两次输入的密码不一致";
        exit;
    }
    else if (!preg_match("/^\w+$/", $adminUsername))
    {
        echo "用户名只能输入字母、数字、下划线";
        exit;
    }
    else if (!preg_match("/^[\S]+$/", $adminPassword))
    {
        echo "密码不能包含空格";
        exit;
    }
    else if (strlen($adminUsername) < 3 || strlen($adminUsername) > 12)
    {
        echo "用户名请输入3~12位字符";
        exit;
    }
    else if (strlen($adminPassword) < 6 || strlen($adminPassword) > 16)
    {

        echo "密码请输入6~16位字符";
        exit;
    }
    try
    {
        //检测能否读取安装文件
        $sql = @file_get_contents(INSTALL_PATH . 'ysfk.sql');
        if (!$sql)
        {
            throw new Exception("无法读取/install/ysfk.sql文件，请检查是否有读权限");
        }
        $pdo = new PDO("mysql:host={$mysqlHostname};port={$mysqlHostport}", $mysqlUsername, $mysqlPassword, array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));

        $pdo->query("CREATE DATABASE IF NOT EXISTS `{$mysqlDatabase}` CHARACTER SET utf8 COLLATE utf8_general_ci;");

        $pdo->query("USE `{$mysqlDatabase}`");

        $pdo->exec($sql);

        $conphp = "<?php
    return [
    'server'=>'".$mysqlHostname."',
    'port'=>'".$mysqlHostport."',
    'user'=>'".$mysqlUsername."',
    'pass'=>'".$mysqlPassword."',
    'name'=>'".$mysqlDatabase."',
    'prefix'=>'ys_',
    'driver'=>'pdo',
    'debug'=>true,
];";
        //检测能否成功写入数据库配置
        $result = @file_put_contents($dbConfigFile, $conphp);
        if (!$result)
        {
            throw new Exception("无法写入数据库信息到db.php文件，请检查是否有写权限");
        }

        //检测能否成功写入lock文件
        $result = @file_put_contents($lockFile, 1);
        if (!$result)
        {
            throw new Exception("无法写入安装锁定到/install/install.lock文件，请检查是否有写权限");
        }
        $newPassword = sha1($adminPassword);
        $pdo->query("UPDATE ys_admin SET adminname = '{$adminUsername}',adminpass = '{$newPassword}'WHERE id = 1");
        echo "success";
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
    catch (PDOException $e)
    {
        $err = $e->getMessage();
    }
    echo $err;
    exit;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>安装<?php echo $sitename; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta name="renderer" content="webkit">

    <style>
        body {
            background: #fff;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }
        body, input, button {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            color: #7E96B3;
        }
        .container {
            max-width: 515px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        a {
            color: #18bc9c;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        h1 {
            margin-top:0;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 28px;
            font-weight: normal;
            color: #3C5675;
            margin-bottom: 0;
        }

        form {
            margin-top: 40px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group .form-field:first-child input {
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }
        .form-group .form-field:last-child input {
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .form-field input {
            background: #EDF2F7;
            margin: 0 0 1px;
            border: 2px solid transparent;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
            width: 100%;
            padding: 15px 15px 15px 180px;
            box-sizing: border-box;
        }
        .form-field input:focus {
            border-color: #18bc9c;
            background: #fff;
            color: #444;
            outline: none;
        }
        .form-field label {
            float: left;
            width: 160px;
            text-align: right;
            margin-right: -160px;
            position: relative;
            margin-top: 18px;
            font-size: 14px;
            pointer-events: none;
            opacity: 0.7;
        }
        button,.btn {
            background: #3C5675;
            color: #fff;
            border: 0;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            padding: 15px 30px;
            -webkit-appearance: none;
        }
        button[disabled] {
            opacity: 0.5;
        }

        #error,.error,#success,.success {
            background: #D83E3E;
            color: #fff;
            padding: 15px 20px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        #success {
            background:#3C5675;
        }

        #error a, .error a {
            color:white;
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>

        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="200px" height="57px" viewBox="0 0 200 57" enable-background="new 0 0 200 57" xml:space="preserve">  <image id="image0" width="200" height="57" x="0" y="0"
                                                                                                                                                                                                                                                        xlink:href="data:image/png;base64,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" />
</svg>

    </h1>
    <h2><?php echo $sitename; ?></h2>
    <div>

        <p>若你在安装中遇到麻烦可点击    <a href="<?php echo $link['qqun']; ?>">QQ交流群</a></p>

        <form method="post">
            <?php if ($errInfo): ?>
                <div class="error">
                    <?php echo $errInfo; ?>
                </div>
            <?php endif; ?>
            <div id="error" style="display:none"></div>
            <div id="success" style="display:none"></div>

            <div class="form-group">
                <div class="form-field">
                    <label>MySQL 数据库地址</label>
                    <input name="mysqlHost" value="127.0.0.1" required="">
                </div>

                <div class="form-field">
                    <label>MySQL 数据库名</label>
                    <input name="mysqlDatabase" value="yunsfaka" required="">
                </div>

                <div class="form-field">
                    <label>MySQL 用户名</label>
                    <input name="mysqlUsername" value="root" required="">
                </div>

                <div class="form-field">
                    <label>MySQL 密码</label>
                    <input type="password" name="mysqlPassword">
                </div>
            </div>

            <div class="form-group">
                <div class="form-field">
                    <label>管理者用户名</label>
                    <input name="adminUsername" value="admin" required="" />
                </div>


                <div class="form-field">
                    <label>管理者密码</label>
                    <input type="password" name="adminPassword" required="">
                </div>

                <div class="form-field">
                    <label>重复密码</label>
                    <input type="password" name="adminPasswordConfirmation" required="">
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" <?php echo $errInfo ? 'disabled' : '' ?>>点击安装</button>
            </div>
        </form>

        <script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
        <script>
            $(function () {
                $('form :input:first').select();

                $('form').on('submit', function (e) {
                    e.preventDefault();

                    var $button = $(this).find('button')
                        .text('安装中...')
                        .prop('disabled', true);

                    $.post('', $(this).serialize())
                        .done(function (ret) {
                            if (ret === 'success') {
                                $('#error').hide();
                                $("#success").text("安装成功！开始你的<?php echo $sitename; ?>之旅吧！").show();
                                $('<a class="btn" href="/">访问首页</a> <a class="btn" href="/ysmd" style="background:#18bc9c">访问后台</a>').insertAfter($button);
                                $button.remove();
                            } else {
                                $('#error').show().text(ret);
                                $button.prop('disabled', false).text('点击安装');
                                $("html,body").animate({
                                    scrollTop: 0
                                }, 500);
                            }
                        })
                        .fail(function (data) {
                            $('#error').show().text('发生错误:\n\n' + data.responseText);
                            $button.prop('disabled', false).text('点击安装');
                            $("html,body").animate({
                                scrollTop: 0
                            }, 500);
                        });

                    return false;
                });
            });
        </script>
    </div>
</div>
</body>
</html>