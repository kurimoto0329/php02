<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続の関数
function db_connect(){
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=kadai_8;charset=utf8;host=localhost','root','root');
      } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
      }
    return $pdo;//※重要！！※ ここでリターンすることで他の項目でも使用している変数($pdo)を関数の外でも使用できるようにしている
}

?>

