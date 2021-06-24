<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>c_time</title>
</head>
<body>

<?php

$site_name;

session_start();
session_regenerate_id(true);
if(isset($_session['login'])==false)

$site_name = $_SESSION['site_name'];

?>

<h1>    
    時間を選択してください
</h1>

<p>
    会場名&nbsp;：<?php print $site_name; ?> 
</p><!-- 変数で受け取って表示 -->

<?php

$date = $_POST["date"];
print $date;
print '<br>';




$dsn = 'mysql:dbname=vaccine_reservation; host = localhost; charset = utf8';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn,$user,$password);
$dbh->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//11時代の予約数取得
$sql= "SELECT count(*) FROM reservation WHERE  res_date = ? AND res_time = '11:00:00'";

$stmt = $dbh -> prepare($sql);
$data_11[]=$date ;
$stmt -> execute($data_11);
$r_time11= $stmt-> fetch(PDO::FETCH_ASSOC);



//12時台の予約数取得
$sql = "SELECT count(*) FROM reservation WHERE  res_date = ? AND res_time = '12:00:00'";

$stmt = $dbh -> prepare($sql);
$data_12[]=$date ;
$stmt -> execute($data_12);
$r_time12 = $stmt-> fetch(PDO::FETCH_ASSOC);




//13時台の予約数取得
$sql = "SELECT count(*) FROM reservation WHERE  res_date = ? AND res_time = '13:00:00'";

$stmt = $dbh -> prepare($sql);
$data_13[]=$date ;
$stmt -> execute($data_13);
$r_time13 = $stmt-> fetch(PDO::FETCH_ASSOC);


$dbh = null;

print'<form action = "c_check.php" method = "post">';


if( $r_time11["count(*)"] < 3 ){
    print '<input type = "radio" name = "r_time" value = "11:00">11:00<br/>';
}


if( $r_time12["count(*)"]<3 ){
    print '<input type = "radio" name = "r_time" value = "12:00">12:00<br/>';
}

if( $r_time13["count(*)"]<3 ){
    print '<input type = "radio" name = "r_time" value = "13:00">13:00<br/>';
}
    
print'
        <input type = "hidden" name = "date" value = "'.$date.'">

        <p>
            <input type = "button" onclick = "history.back()" value = "戻る">
            <input type = "submit"  value= "次へ">
        </p>
        </form>';
    
?>


</body>
</html>