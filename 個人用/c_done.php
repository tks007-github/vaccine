<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>ワクチン予約</title>

    <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/starter-template/">



    <!-- Bootstrap core CSS -->
    <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
</head>

<body>

<?php

    SESSION_start();
    SESSION_regenerate_id(true);
    // if (isset($_session['login']) == false)


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

    $sql = "INSERT INTO reservation (my_num , site_code , res_date , res_time , count , vac_code , vac_sta_code , res_sta_code ) VALUES(?, ? , ? , ? , 1 , 'v01' , 0 , 1)";
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

    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand">

            </div>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="#">
                            <!-- <font color="white">←戻る</font> -->
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="c_top.html">
                            <font color="white">ホーム</font>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">

        <div class="starter-template text-center py-5 px-3">
            <h1>予約を完了しました</h1>
        </div>

    </main><!-- /.container -->


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>