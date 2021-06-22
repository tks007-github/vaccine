<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>c_done</title>
</head>
<body>

    <?php

    session_start();
    session_regenerate_id(true);

    /* 
        $name = $_POST["name"];//カナ名
        $tel = $_POST["tel"];
        $site = $_POST["site"];*/
        $date = $_POST["date"];
        $time = $_POST["time"];
        

    try
    {

    // DB接続
    $dsn = 'mysql:dbname=vaccine_reservation; host = localhost; charset = utf8';
    $user = 'root';
    $password = 'root';

    $dbh = new PDO($dsn,$user,$password);
    $dbh->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO reservation (my_num , site_code , res_date , res_time , count , vac_code , vac_sta_code , res_sta_code ) VALUES(?, ? , ? , ? , 3 , 'v01' , 0 , 1)";
    $stmt = $dbh -> prepare($sql);
    $data[] = $_SESSION['my_num'];
    $data[] = $_SESSION['site_code'];
    $data[] = $date;
    $data[] = $time;

    $stmt->execute($data);
    

    $sql1 = "INSERT INTO citizen_add (my_num , kana , tel , mail) VALUES(? , ? , ? , ?)";
    $stmt1 = $dbh -> prepare($sql1);
    $data1[] = $_SESSION['my_num'];
    $data1[] = $_SESSION['name'];
    $data1[] = $_SESSION['tel'];
    $data1[] = $_SESSION['mail'];

    $stmt1->execute($data1);

    $dbh = null;
    }

    catch(Exception $e)

    {
    var_dump($e);
    print'ただいま障害により大変ご迷惑をお掛けいたします。';
    exit();
    }  

    ?>

    <br>
    <p>予約を完了しました。</p>   
    <br>
    <p id="c_top"><a href="c_top.html">トップへ戻る</p>
    

</body>
</html>