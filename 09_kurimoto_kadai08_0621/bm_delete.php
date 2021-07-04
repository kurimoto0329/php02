<?php
require_once("funcs.php");
// 1. GETデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$id     = $_GET['id'];


// 2. DB接続します
$pdo = db_conn();

// 3. UPDATE gs_an_table SET....;
//データ登録SQL作成
$stmt = $pdo->prepare(
    "DELETE FROM gs_bm_table WHERE id =:id"
);
$stmt ->bindValue(':id',     $id,      PDO::PARAM_INT);
//SQL実行
$status = $stmt->execute();

if ($status == false){
    sql_error($status);
}else{
    //select.phpへのリダイレクト
    redirect('bm_list_view.php');
}

?>