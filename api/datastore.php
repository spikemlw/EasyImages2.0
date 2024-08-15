<?php
// spike dev
namespace Verot\Upload;

require_once __DIR__ . '/../app/function.php';
require_once APP_ROOT . '/app/class.upload.php';
require_once APP_ROOT . '/config/api_key.php';

// 允许跨域 https://stackoverflow.com/questions/8719276/cross-origin-request-headerscors-with-php-headers
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
// 定义返回头信息为Json
header("Content-type: application/json; charset=utf-8");


 
// 显示出来看看
//var_dump($data);
 

// 读取文件
$json_string = file_get_contents('data.json');
 
// 把JSON字符串转成PHP数组
$data = json_decode($json_string, true);

if($_POST['ctitle']){
    $newItem = array(
        "id" => isset($_POST['id']) ? $_POST['id'] : NULL,
        "ctitle" => isset($_POST['ctitle']) ? $_POST['ctitle'] : NULL,
        "tglink" => isset($_POST['tglink']) ? $_POST['tglink'] : NULL,
        "image" => isset($_POST['image']) ? $_POST['image'] : NULL,
        "lang" => isset($_POST['lang']) ? $_POST['lang'] : NULL,
        "group" => isset($_POST['group']) ? $_POST['group'] : NULL,
        "jtitle" => isset($_POST['jtitle']) ? $_POST['jtitle'] : NULL,
        "fac" => isset($_POST['fac']) ? $_POST['fac'] : NULL,
        "date" => isset($_POST['date']) ? $_POST['date'] : NULL,
        "videocount" => isset($_POST['videocount']) ? $_POST['videocount'] : NULL
    );
    array_push($data, $newItem);
}

// 把PHP数组转成JSON字符串
$json_string = json_encode($data, JSON_UNESCAPED_UNICODE);

// 写入文件
file_put_contents('user.json', stripslashes($json_string));

// 接口返回
exit($json_string);