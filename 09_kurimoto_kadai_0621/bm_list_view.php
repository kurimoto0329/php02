<?php

require_once ('funcs.php');

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=kadai_8;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<p>';

    $view .= '<p>[書籍名]'.$result['book_name'].'</p>';
    $view .= '<p style="font-size:14px;">[レーティング]'.$result['score'].'</p>';
    $view .= '<p style="font-size:14px;">[更新日時]'.$result['indate'].'</p>';
    $view .= '<p style="font-size:14px;">[書籍概要]'.$result['book_comment'].'</p>';

    $view .= '<a href="'.$result['book_url'].'">';
    $view .= '[書籍URL] ';
    $view .= '</a>';

    $view .= '<a href="bm_update_view.php?id='.$result["id"].'">';
    $view .= '[更新] ';
    $view .= '</a>';

    $view .= '<a href="bm_delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '</p>';
    $view .= '<br>';    
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク一覧表示画面</title>
<link rel="stylesheet" href="../css/range.css">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_insert_view.php">データ登録 </a>
      <a class="navbar-brand" href="bm_chart.php">グラフ表示</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
