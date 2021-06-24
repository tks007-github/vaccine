<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>c_date</title>
</head>
<body>

<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_session['login'])==false)

    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $site_code = $_POST['site_code'];


    $today = date("Y-m-d",strtotime("1 day"));//予約しようとする日付けに一日加算
    //print $today;

    $dsn = 'mysql:dbname=vaccine_reservation; host = localhost; charset = utf8';
    $user = 'root';
    $password = 'root';

    $dbh = new PDO($dsn,$user,$password);
    $dbh->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT site_name FROM site WHERE site_code = ?";
    $stmt = $dbh -> prepare($sql);
    $data[]=$site_code ;
    $stmt -> execute($data);
    $site_name = $stmt-> fetch(PDO::FETCH_ASSOC);


    $_SESSION['name']=$name;
    $_SESSION['mail']=$mail;
    $_SESSION['tel']=$tel;
    $_SESSION['site_code']=$site_code;
    $_SESSION['site_name']=$site_name['site_name'];


?>

<h1>希望日を選択してください</h1>

<p>会場名&nbsp;：<?php print $site_name['site_name']; ?></p><!-- 変数で受け取って表示 -->

<form action = "c_time.php"  method = "post" id = 'date_choose'>

    <p>
        <input type= 'date' name='date' min='<?php print $today ?>'>

        <input type = "button" onclick = "history.back()" value = "戻る">
        <input type = "submit" value ="次へ" >
    </p>
</form>


    
</body>
</html>