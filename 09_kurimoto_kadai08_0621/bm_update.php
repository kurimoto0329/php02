<?php

require_once("funcs.php");

if(
    !isset($_POST['book_name']) || $_POST['book_name'] == '' ||
    !isset($_POST['book_url']) || $_POST['book_url'] == '' ||
    !isset($_POST['book_comment']) || $_POST['book_comment']  == '' ||
    !isset($_POST['score']) || $_POST['score']  == ''
  ) {
    exit('ParamError');
  }

// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$id     = $_POST['id'];
$book_name = $_POST['book_name'];
$book_url = $_POST['book_url'];
$book_comment = $_POST['book_comment'];
$score = $_POST['score'];

// 2. DB接続します
$pdo = db_conn();


// 3. UPDATE gs_an_table SET....;
//データ登録SQL作成
$stmt = $pdo->prepare(
    'UPDATE gs_bm_table SET book_name=:a, book_url=:b, book_comment=:c, score=:d WHERE id =:e'
);

$stmt ->bindValue(':a',$book_name,    PDO::PARAM_STR);
$stmt ->bindValue(':b',$book_url,     PDO::PARAM_STR);
$stmt ->bindValue(':c',$book_comment, PDO::PARAM_STR);
$stmt ->bindValue(':d',$score,  PDO::PARAM_INT);
$stmt ->bindValue(':e',$id,           PDO::PARAM_INT);

//SQL実行
$status = $stmt->execute();

if ($status == false){
  sql_error($status);
}else{
    //select.phpへのリダイレクト
    redirect('bm_list_view.php');
}

?>