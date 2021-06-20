<?php
// 1. GETデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$id     = $_GET['id'];


// 2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=kadai_8;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}


// 3. UPDATE gs_an_table SET....;
//データ登録SQL作成
$stmt = $pdo->prepare(
    "DELETE FROM gs_bm_table WHERE id =:id"
);
$stmt ->bindValue(':id',     $id,      PDO::PARAM_INT);
//SQL実行
$status = $stmt->execute();

if ($status == false){
    $error = $stmt ->errorInfo();
    exit("QueryError:".$error[2]);

}else{
    //select.phpへのリダイレクト
    header('Location: bm_list_view.php');
    exit;
}




?>