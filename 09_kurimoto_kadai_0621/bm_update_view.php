<?php

// 1. GETでid値を取得
$id = $_GET["id"];
echo $id;

// 2. DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=kadai_8;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }

// 3．SELECT * FROM gs_an_table WHERE id =:id;
$sql = "SELECT * FROM gs_bm_table WHERE id =:id";
$stmt = $pdo->prepare($sql);
$stmt ->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt ->execute();

//4. データ表示

$view="";
if ($status==false) {
    //execute (SQL実行時にエラーがある場合)
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);

} else {
    //データのみ抽出の場合はwhileループで取り出さない
    $row = $stmt ->fetch();
    //$row["id"], $row["name"]
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_list_view.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマーク登録画面</legend>
     <label>書籍名：<br><input type="text" name="book_name" style="width:913px;" value="<?=$row["book_name"]?>"></label><br>
     <label>書籍URL：<br><input type="text" name="book_url" style="width:913px; height:60px;" value="<?=$row["book_url"]?>"></label><br>
     <label>書籍概要：<br><textArea name="book_comment" rows="8" cols="100" ><?=$row["book_comment"]?></textArea></label><br>
     <label>レーティング：<br><input type="text" name="score" style="width:60px;" value="<?=$row["score"]?>"></label><br>     
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
