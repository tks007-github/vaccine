<?php
session_start();                        # p_login_check.phpで作成したセッションを再開
session_regenerate_id(true);            # 既存のセッションIDを新しく置き換える
if (isset($_SESSION['login']) == false)      # セッション変数loginに値が格納されていない場合
{
    print 'ログインされていません。<br>';
    print '<a href="p_login.html">ログイン画面へ</a>';
    exit();
}

# エラー対策を行う(例外処理)
try {
    # Vaccine_Reservationデータベースに接続する
    $dsn = 'mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    # 検索するSQL文の生成
    $sql = '
      SELECT COUNT(*), CURDATE() FROM Reservation
      WHERE res_date <= CURDATE()
      ';

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    # Vaccine_Reservationデータベースから切断する
    $dbh = null;
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
}
# エラーが発生した場合の処理
catch (Exception $e) {
    var_dump($e);
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Starter Template for Bootstrap · Bootstrap v5.0</title>

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

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand">
                <?php
                if (isset($_SESSION['login']) == true) {
                    print $_SESSION['pre_name'];      # セッション変数pre_nameを表示
                    print 'でログイン中';
                }
                ?>
            </div>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="p_top.php">ホーム</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="p_search.php">戻る</a>
                    </li>
                </ul>
            </div>
            <input type="button" onclick="location.href='p_login.html'" value="ログアウト">
        </div>
        </div>
    </nav>

    <main class="container">

        <div class="starter-template text-center py-5 px-3">
            <h1>検索結果</h1>
            <br><br>
            <h3>検索条件</h3>

            <?php
            # エラー対策を行う(例外処理)
            try {
                # p_search.phpから渡された値を$_POSTで受け取る

                if($_SESSION['site_code'] == "" && $_SESSION['res_date'] == "" && $_SESSION['vac_code'] == "")
                {
                    $_SESSION['site_code'] = $_POST['site_code'];
                    $_SESSION['res_date'] = $_POST['res_date'];
                    $_SESSION['vac_code'] = $_POST['vac_code'];
                }
                $site_code = $_SESSION['site_code'];
                $res_date = $_SESSION['res_date'];
                $vac_code = $_SESSION['vac_code'];

                switch($site_code)
                {
                    case 'S0001':
                        $site_name = '常総病院';
                        break;
                    
                    case 'S0002':
                        $site_name = '守谷病院';
                        break;
                    
                    case 'S0003':
                        $site_name = 'つくば病院';
                        break;

                    default:
                        $site_name = '指定なし';
                }

                switch($vac_code)
                {
                    case 'V01':
                        $vac_name = 'ファイザー';
                        break;
                    
                    case 'V02':
                        $vac_name = 'モデルナ';
                        break;

                    default:
                        $vac_name = '指定なし';
                }

                if($res_date != ''){
                    print "<h4>接種会場：".$site_name."　日にち：".$res_date."　ワクチン種別：".$vac_name."</h4><br><br>";
                } else {
                    print "<h4>接種会場：".$site_name."　日にち：指定なし　ワクチン種別：".$vac_name."</h4><br><br>";
                }
                

                # Vaccine_Reservationデータベースに接続する
                $dsn = 'mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
                $user = 'root';
                $password = 'root';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                # 検索するSQL文の生成
                $sql = '
                    SELECT R.my_num, TIMESTAMPDIFF(YEAR, C.birth, CURDATE()) AS age, 
                    S.site_name, R.res_date, V.vac_name
                    FROM Reservation AS R
                    JOIN Citizen AS C USING(my_num)
                    JOIN Site AS S USING(site_code)
                    JOIN Vaccine AS V USING(vac_code)
                    WHERE 1
                    ';
                if ($site_code != "") {
                    $sql .= 'AND site_code=?';
                }
                if ($res_date != "") {
                    $sql .= 'AND res_date=?';
                }
                if ($vac_code != "") {
                    $sql .= 'AND vac_code=?';
                }
                $stmt = $dbh->prepare($sql);

                if ($site_code == "" && $res_date == "" && $vac_code == "") {
                    $stmt->execute();
                } else {
                    if ($site_code != "") {
                        $data[] = $site_code;
                    }
                    if ($res_date != "") {
                        $data[] = $res_date;
                    }
                    if ($vac_code != "") {
                        $data[] = $vac_code;
                    }
                    $stmt->execute($data);
                }

                # Vaccine_Reservationデータベースから切断する
                $dbh = null;
                $rec = $stmt->fetchAll();

                $csv = 'マイナンバー,年齢,接種会場名,予約日,ワクチン種別';
                $csv .= "\n";

                if (isset($rec[0]['my_num']) == false) {
                    print '<h5>該当するデータはありません</h5>';
                } else {
                    
                    print '<table align="center" width="600">';
                    print '<tr><th><h5>マイナンバー</h5></th> <th><h5>年齢</h5></th> <th><h5>接種会場名</h5></th> <th><h5>予約日</h3></th> <th><h5>ワクチン種別</h5></th></tr>';
                    foreach ($rec as $key => $value) {
                        print '<tr>';
                        print '<th>' . $value['my_num'] . '</th>';
                        print '<th>' . $value['age'] . '</th>';
                        print '<th>' . $value['site_name'] . '</th>';
                        print '<th>' . $value['res_date'] . '</th>';
                        print '<th>' . $value['vac_name'] . '</th>';
                        print '</tr>';

                        $csv .= $value['my_num'];
                        $csv .= ',';
                        $csv .= $value['age'];
                        $csv .= ',';
                        $csv .= $value['site_name'];
                        $csv .= ',';
                        $csv .= $value['res_date'];
                        $csv .= ',';
                        $csv .= $value['vac_name'];
                        $csv .= "\n";
                    }
                    print '</table>';
                }
            }
            # エラーが発生した場合の処理
            catch (Exception $e) {
                var_dump($e);
                print 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

            if (isset($rec[0]['my_num']) == true) {
                print '
                <br>
                <form method="post" action="p_search_list_download.php">
                    <input type="hidden" name="csv" value="'.$csv.'">
                    <h5><input type="submit" value="CSVファイルをダウンロード"></h5>
                </form>
                ';
            }
            ?>

        </div>

    </main><!-- /.container -->


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>