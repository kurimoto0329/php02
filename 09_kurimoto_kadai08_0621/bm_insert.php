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

$book_name = $_POST['book_name'];
$book_url = $_POST['book_url'];
$book_comment = $_POST['book_comment'];
$score = $_POST['score'];




// 2. DB接続します
$pdo = db_conn();


// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO gs_bm_table( id, book_name, book_url, book_comment, score, indate )
  VALUES( NULL, :book_name, :book_url, :book_comment ,  :score, sysdate() )"
);

// 4. バインド変数を用意
$stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':score', $score, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($status);
}else{
  //５．index.phpへリダイレクト
  redirect('bm_insert_view.php');
}
?>
