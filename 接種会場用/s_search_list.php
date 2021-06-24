<?php
session_start();                        # p_login_check.phpで作成したセッションを再開
session_regenerate_id(true);            # 既存のセッションIDを新しく置き換える
if (isset($_SESSION['login']) == false)      # セッション変数loginに値が格納されていない場合
{
    print 'ログインされていません。<br>';
    print '<a href="p_login.html">ログイン画面へ</a>';
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

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand">
                <?php
                if (isset($_SESSION['login']) == true) {
                    print $_SESSION['site_name'];      # セッション変数pre_nameを表示
                    print 'でログイン中';
                }
                ?>
            </div>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="s_top.php">ホーム</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="s_search.php">戻る</a>
                    </li>
                </ul>
            </div>
            <input type="button" onclick="location.href='s_login.html'" value="ログアウト">
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
                $site_code = $_SESSION['site_code'];
                if (isset($_POST['res_date']) == false && isset($_POST['res_time']) == false && isset($_POST['my_num']) == false && isset($_POST['vac_code']) == false && isset($_POST['vac_sta_code']) == false) {
                    $res_date = $_SESSION['res_date'];
                    $res_time = $_SESSION['res_time'];
                    $my_num = $_SESSION['my_num'];
                    $vac_code = $_SESSION['vac_code'];
                    $vac_sta_code = $_SESSION['vac_sta_code'];
                } else {
                    $_SESSION['res_date'] = $_POST['res_date'];
                    $_SESSION['res_time'] = $_POST['res_time'];
                    $_SESSION['my_num'] = $_POST['my_num'];
                    $_SESSION['vac_code'] = $_POST['vac_code'];
                    $_SESSION['vac_sta_code'] = $_POST['vac_sta_code'];
                    $res_date = $_SESSION['res_date'];
                    $res_time = $_SESSION['res_time'];
                    $my_num = $_SESSION['my_num'];
                    $vac_code = $_SESSION['vac_code'];
                    $vac_sta_code = $_SESSION['vac_sta_code'];
                }

                if ($res_date == '') {
                    $res_date_name = '指定なし';
                } else {
                    $res_date_name = $res_date;
                }
                if ($res_time == '') {
                    $res_time_name = '指定なし';
                } else {
                    $res_time_name = $res_time;
                }
                if ($my_num == '') {
                    $my_num_name = '指定なし';
                } else {
                    $my_num_name = $my_num;
                }


                switch ($vac_code) {
                    case 'V01':
                        $vac_name = 'ファイザー';
                        break;

                    case 'V02':
                        $vac_name = 'モデルナ';
                        break;

                    default:
                        $vac_name = '指定なし';
                }

                switch ($vac_sta_code) {
                    case 0:
                        $vac_sta_name = '未';
                        break;

                    case 1:
                        $vac_sta_name = '済';
                        break;
                }
                if ($vac_sta_code == '') {
                    $vac_sta_name = '指定なし';
                }

                print "<h4>予約日：" . $res_date_name . "　予約時間：" . $res_time_name . "　マイナンバー：" . $my_num_name . "　ワクチン種別：" . $vac_name . "　接種完了：" . $vac_sta_name . "</h4><br><br>";

                # Vaccine_Reservationデータベースに接続する
                $dsn = 'mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
                $user = 'root';
                $password = 'root';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                # 検索するSQL文の生成
                $sql = '
                    SELECT R.site_code, C.name,
                    R.my_num, TIMESTAMPDIFF(YEAR, C.birth, CURDATE()) AS age,
                    C.sex, CA.tel, CA.mail,
                    R.res_date, R.res_time, V.vac_name, VS.vac_sta_value
                    FROM Reservation AS R
                    JOIN Citizen AS C USING(my_num)
                    JOIN Vaccine AS V USING(vac_code)
                    JOIN Vac_Status AS VS USING(vac_sta_code)
                    JOIN Citizen_Add AS CA USING(my_num)
                    WHERE site_code = ?
                    ';
                if ($my_num != "") {
                    $sql .= 'AND my_num=?';
                }
                if ($res_date != "") {
                    $sql .= 'AND res_date=?';
                }
                if ($res_time != "") {
                    $sql .= 'AND res_time=?';
                }
                if ($vac_code != "") {
                    $sql .= 'AND vac_code=?';
                }
                if ($vac_sta_code != "") {
                    $sql .= 'AND vac_sta_code=?';
                }

                //res_date,res_timeの順に並び替える
                $sql .= 'ORDER BY res_date, res_time, my_num';

                //プリペアドステートメントを作成
                $stmt = $dbh->prepare($sql);
                $data[] = $site_code;
                if ($my_num != "") {
                    $data[] = $my_num;
                }
                if ($res_date != "") {
                    $data[] = $res_date;
                }
                if ($res_time != "") {
                    $data[] = $res_time;
                }
                if ($vac_code != "") {
                    $data[] = $vac_code;
                }
                if ($vac_sta_code != "") {
                    $data[] = $vac_sta_code;
                }
                //実行
                $stmt->execute($data);


                //データベース接続を切断
                $dbh = null;

                //データを取得（PDO::FETCH_ASSOCで連想配列を返す）
                $rec = $stmt->fetchAll();

                $csv = '予約日,予約時間,マイナンバー,利用者名,年齢,性別,TEL,メールアドレス,ワクチン種別,接種完了';
                $csv .= "\n";

                if (isset($rec[0]['my_num']) == false) {
                    print '<h5>該当するデータはありません</h5>';
                } else {

                    print '<table align="center" width="600">';
                    print '<tr><th><h5>予約日</h5></th> <th><h5>予約時間</h5></th> <th><h5>マイナンバー</h5></th> <th><h5>利用者名</h5></th> <th><h5>年齢</h5></th> <th><h5>性別</h5></th> <th><h5>TEL</h5></th> <th><h5>メールアドレス</h5></th> <th><h5>ワクチン種別</h5> <th><h5>接種完了</h5></th></th></tr>';
                    foreach ($rec as $key => $value) {
                        print '<tr>';
                        print '<th>' . $value['res_date'] . '</th>';
                        print '<th>' . $value['res_time'] . '</th>';
                        print '<th>' . $value['my_num'] . '</th>';
                        print '<th>' . $value['name'] . '</th>';
                        print '<th>' . $value['age'] . '</th>';
                        print '<th>' . $value['sex'] . '</th>';
                        print '<th>' . $value['tel'] . '</th>';
                        print '<th>' . $value['mail'] . '</th>';
                        print '<th>' . $value['vac_name'] . '</th>';
                        print '<th>' . $value['vac_sta_value'] . '</th>';
                        print '</tr>';

                        $csv .= $value['res_date'];
                        $csv .= ',';
                        $csv .= $value['res_time'];
                        $csv .= ',';
                        $csv .= $value['my_num'];
                        $csv .= ',';
                        $csv .= $value['name'];
                        $csv .= ',';
                        $csv .= $value['age'];
                        $csv .= ',';
                        $csv .= $value['sex'];
                        $csv .= ',';
                        $csv .= $value['tel'];
                        $csv .= ',';
                        $csv .= $value['mail'];
                        $csv .= ',';
                        $csv .= $value['vac_name'];
                        $csv .= ',';
                        $csv .= $value['vac_sta_value'];
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
                <form method="post" action="s_search_list_download.php">
                    <input type="hidden" name="csv" value="' . $csv . '">
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