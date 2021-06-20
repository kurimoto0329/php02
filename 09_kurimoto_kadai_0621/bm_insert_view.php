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
<form method="POST" action="bm_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマーク登録画面</legend>
     <label>書籍名：<br><input type="text" name="book_name" style="width:913px;"></label><br>
     <label>書籍URL：<br><input type="text" name="book_url" style="width:913px; height:60px;"></label><br>
     <label>書籍概要：<br><textArea name="book_comment" rows="8" cols="100"></textArea></label><br>
     <label>レーティング：<br><input type="text" name="score" style="width:60px;"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
