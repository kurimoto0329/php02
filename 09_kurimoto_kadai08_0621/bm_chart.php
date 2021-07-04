<?php 
include('funcs.php');

//1. DB接続します
$pdo = db_conn();
$graph_x = '"☆","☆☆","☆☆☆","☆☆☆☆","☆☆☆☆☆"';
$graph_y = '';
$hist = [0,0,0,0,0]; 


//2．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");

//3. 実行
$status = $stmt->execute();

//4．ratingの度数分布作成
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    if($result["score"] > 0 && $result["score"] <= 1 ){
        $hist[0] +=1;
    }else if ($result["score"] > 1 && $result["score"] <= 2 ){
        $hist[1] +=1;
    }else if ($result["score"] > 2 && $result["score"] <= 3 ){
        $hist[2] +=1;
    }else if ($result["score"] > 3 && $result["score"] <= 4 ){
        $hist[3] +=1;
    }else if ($result["score"] > 4 && $result["score"] <= 5 ){
        $hist[4] +=1;
    }
  }
}

$i =0;
while($i < 5){
    $graph_y = $graph_y.$hist[$i].',';
    $i++;
}
$graph_y = trim($graph_y,',');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $graph_x ?>],//各棒の名前（rating)
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'ほげ'],//各棒の名前（name)
            datasets: [{
                data: [<?php echo $graph_y ?>],//各縦棒の高さ(頻度)
                // data: [12, 19, 3, 5, 2, 20],//各縦棒の高さ(頻度)
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                // label: [
                //     '☆ of Votes',
                //     '☆☆ of Votes',
                //     '☆☆☆ of Votes',
                //     '☆☆☆☆ of Votes',
                //     '☆☆☆☆☆ of Votes',
                //     '☆☆☆☆☆☆ of Votes'
                // ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
            
        }
    });
    </script>
</body>
</html>