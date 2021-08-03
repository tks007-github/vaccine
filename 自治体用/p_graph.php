<?php
session_start();                        // p_login_check.phpで作成したセッションを再開
session_regenerate_id(true);            // 既存のセッションIDを新しく置き換える
if (isset($_SESSION['login']) == false)      // セッション変数loginに値が格納されていない場合
{
    print 'ログインされていません。<br>';
    print '<a href="p_login.html">ログイン画面へ</a>';
    exit();
}

// エラー対策を行う(例外処理)
try {
    date_default_timezone_set('Asia/Tokyo');
    // date('w')は日：0 ～ 土：6 なので日曜日にグラフの横軸が切り替わる
    $day = -(date('w') + 2);
    $fin_5 = date("Y-m-d", strtotime($day . "day"));        // 1週間前の金曜日の日付
    $sta_5 = date("Y-m-d", strtotime($day-4 . "day"));      // 1週間前の月曜日の日付
    $fin_4 = date("Y-m-d", strtotime($day-7 . "day"));      // 2週間前の金曜日の日付
    $sta_4 = date("Y-m-d", strtotime($day-11 . "day"));     // 2週間前の月曜日の日付
    $fin_3 = date("Y-m-d", strtotime($day-14 . "day"));     // 3週間前の金曜日の日付
    $sta_3 = date("Y-m-d", strtotime($day-18 . "day"));     // 3週間前の月曜日の日付
    $fin_2 = date("Y-m-d", strtotime($day-21 . "day"));     // 4週間前の金曜日の日付
    $sta_2 = date("Y-m-d", strtotime($day-25 . "day"));     // 4週間前の月曜日の日付
    $fin_1 = date("Y-m-d", strtotime($day-28 . "day"));     // 5週間前の金曜日の日付
    $sta_1 = date("Y-m-d", strtotime($day-32 . "day"));     // 5週間前の月曜日の日付

    // Vaccine_Reservationデータベースに接続する
    $dsn = 'mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 検索するSQL文の生成

    // 2021-05-31～2021-06-04の期間の累計接種者数
    $sql1_1 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND res_date BETWEEN ? AND ?";
    $stmt1_1 = $dbh->prepare($sql1_1);
    $data1_1[] = $sta_1;
    $data1_1[] = $fin_1;
    $stmt1_1->execute($data1_1);
    $rec1_1 = $stmt1_1->fetch(PDO::FETCH_ASSOC);
    // print $rec1_1["COUNT(*)"];

    // 全体 2021-06-07～2021-06-11の期間の累計接種者数
    $sql1_2 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND res_date BETWEEN ? AND ?";
    $stmt1_2 = $dbh->prepare($sql1_2);
    $data1_2[] = $sta_2;
    $data1_2[] = $fin_2;
    $stmt1_2->execute($data1_2);
    $rec1_2 = $stmt1_2->fetch(PDO::FETCH_ASSOC);
    // print $rec1_2["COUNT(*)"];

    // 全体 2021-06-14～2021-06-18の期間の累計接種者数
    $sql1_3 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND res_date BETWEEN ? AND ?";
    $stmt1_3 = $dbh->prepare($sql1_3);
    $data1_3[] = $sta_3;
    $data1_3[] = $fin_3;
    $stmt1_3->execute($data1_3);
    $rec1_3 = $stmt1_3->fetch(PDO::FETCH_ASSOC);
    // print $rec1_3["COUNT(*)"];

    // 全体 2021-06-21～2021-06-25の期間の累計接種者数
    $sql1_4 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND res_date BETWEEN ? AND ?";
    $stmt1_4 = $dbh->prepare($sql1_4);
    $data1_4[] = $sta_4;
    $data1_4[] = $fin_4;
    $stmt1_4->execute($data1_4);
    $rec1_4 = $stmt1_4->fetch(PDO::FETCH_ASSOC);
    // print $rec1_4["COUNT(*)"];

    // 全体 2021-06-28～2021-07-02の期間の累計接種者数
    $sql1_5 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND res_date BETWEEN ? AND ?";
    $stmt1_5 = $dbh->prepare($sql1_5);
    $data1_5[] = $sta_5;
    $data1_5[] = $fin_5;
    $stmt1_5->execute($data1_5);
    $rec1_5 = $stmt1_5->fetch(PDO::FETCH_ASSOC);
    // print $rec1_5["COUNT(*)"];

    // ファイザー 2021-05-31～2021-06-04の期間の累計接種者数
    $sql2_1 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V01' AND res_date BETWEEN ? AND ?";
    $stmt2_1 = $dbh->prepare($sql2_1);
    $data2_1[] = $sta_1;
    $data2_1[] = $fin_1;
    $stmt2_1->execute($data2_1);
    $rec2_1 = $stmt2_1->fetch(PDO::FETCH_ASSOC);
    // print $rec2_1["COUNT(*)"];

    // ファイザー 2021-06-07～2021-06-11の期間の累計接種者数
    $sql2_2 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V01' AND res_date BETWEEN ? AND ?";
    $stmt2_2 = $dbh->prepare($sql2_2);
    $data2_2[] = $sta_2;
    $data2_2[] = $fin_2;
    $stmt2_2->execute($data2_2);
    $rec2_2 = $stmt2_2->fetch(PDO::FETCH_ASSOC);
    // print $rec2_2["COUNT(*)"];

    // ファイザー 2021-06-14～2021-06-18の期間の累計接種者数
    $sql2_3 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V01' AND res_date BETWEEN ? AND ?";
    $stmt2_3 = $dbh->prepare($sql2_3);
    $data2_3[] = $sta_3;
    $data2_3[] = $fin_3;
    $stmt2_3->execute($data2_3);
    $rec2_3 = $stmt2_3->fetch(PDO::FETCH_ASSOC);
    // print $rec2_3["COUNT(*)"];

    // ファイザー 2021-06-21～2021-06-25の期間の累計接種者数
    $sql2_4 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V01' AND res_date BETWEEN ? AND ?";
    $stmt2_4 = $dbh->prepare($sql2_4);
    $data2_4[] = $sta_4;
    $data2_4[] = $fin_4;
    $stmt2_4->execute($data2_4);
    $rec2_4 = $stmt2_4->fetch(PDO::FETCH_ASSOC);
    // print $rec2_4["COUNT(*)"];

    // ファイザー 2021-06-28～2021-07-02の期間の累計接種者数
    $sql2_5 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V01' AND res_date BETWEEN ? AND ?";
    $stmt2_5 = $dbh->prepare($sql2_5);
    $data2_5[] = $sta_5;
    $data2_5[] = $fin_5;
    $stmt2_5->execute($data2_5);
    $rec2_5 = $stmt2_5->fetch(PDO::FETCH_ASSOC);
    // print $rec2_5["COUNT(*)"];

    // モデルナ 2021-05-31～2021-06-04の期間の累計接種者数
    $sql3_1 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V02' AND res_date BETWEEN ? AND ?";
    $stmt3_1 = $dbh->prepare($sql3_1);
    $data3_1[] = $sta_1;
    $data3_1[] = $fin_1;
    $stmt3_1->execute($data3_1);
    $rec3_1 = $stmt3_1->fetch(PDO::FETCH_ASSOC);
    // print $rec3_1["COUNT(*)"];

    // モデルナ 2021-06-07～2021-06-11の期間の累計接種者数
    $sql3_2 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V02' AND res_date BETWEEN ? AND ?";
    $stmt3_2 = $dbh->prepare($sql3_2);
    $data3_2[] = $sta_2;
    $data3_2[] = $fin_2;
    $stmt3_2->execute($data3_2);
    $rec3_2 = $stmt3_2->fetch(PDO::FETCH_ASSOC);
    // print $rec3_2["COUNT(*)"];

    // モデルナ 2021-06-14～2021-06-18の期間の累計接種者数
    $sql3_3 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V02' AND res_date BETWEEN ? AND ?";
    $stmt3_3 = $dbh->prepare($sql3_3);
    $data3_3[] = $sta_3;
    $data3_3[] = $fin_3;
    $stmt3_3->execute($data3_3);
    $rec3_3 = $stmt3_3->fetch(PDO::FETCH_ASSOC);
    // print $rec3_3["COUNT(*)"];

    // モデルナ 2021-06-21～2021-06-25の期間の累計接種者数
    $sql3_4 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V02' AND res_date BETWEEN ? AND ?";
    $stmt3_4 = $dbh->prepare($sql3_4);
    $data3_4[] = $sta_4;
    $data3_4[] = $fin_4;
    $stmt3_4->execute($data3_4);
    $rec3_4 = $stmt3_4->fetch(PDO::FETCH_ASSOC);
    // print $rec3_4["COUNT(*)"];

    // モデルナ 2021-06-28～2021-07-02の期間の累計接種者数
    $sql3_5 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND vac_code = 'V02' AND res_date BETWEEN ? AND ?";
    $stmt3_5 = $dbh->prepare($sql3_5);
    $data3_5[] = $sta_5;
    $data3_5[] = $fin_5;
    $stmt3_5->execute($data3_5);
    $rec3_5 = $stmt3_5->fetch(PDO::FETCH_ASSOC);
    // print $rec3_5["COUNT(*)"];

    // Vaccine_Reservationデータベースから切断する
    $dbh = null;
}
// エラーが発生した場合の処理
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
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

        canvas {
            max-width: 1300px;
            max-height: 600px;
            border: solid 1px #888;
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
                    print $_SESSION['pre_name'];      // セッション変数pre_nameを表示
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
                        <a class="nav-link" aria-current="page" href="p_top.php">戻る</a>
                    </li>
                </ul>
            </div>
                    <input type="button" onclick="location.href='p_login.html'" value="ログアウト">
        </div>
    </nav>

    <main class="container">

        <div class="starter-template text-center py-5 px-3">
            <h1>グラフ</h1>
            <h3>～ワクチン接種者数推移～</h3>
            <br>

            <?php
                $sta_1_m = strval(date('m', strtotime($sta_1)));
                $sta_1_d = strval(date('d', strtotime($sta_1)));
                $fin_1_m = strval(date('m', strtotime($fin_1)));
                $fin_1_d = strval(date('d', strtotime($fin_1)));
                
                $sta_2_m = strval(date('m', strtotime($sta_2)));
                $sta_2_d = strval(date('d', strtotime($sta_2)));
                $fin_2_m = strval(date('m', strtotime($fin_2)));
                $fin_2_d = strval(date('d', strtotime($fin_2)));

                $sta_3_m = strval(date('m', strtotime($sta_3)));
                $sta_3_d = strval(date('d', strtotime($sta_3)));
                $fin_3_m = strval(date('m', strtotime($fin_3)));
                $fin_3_d = strval(date('d', strtotime($fin_3)));

                $sta_4_m = strval(date('m', strtotime($sta_4)));
                $sta_4_d = strval(date('d', strtotime($sta_4)));
                $fin_4_m = strval(date('m', strtotime($fin_4)));
                $fin_4_d = strval(date('d', strtotime($fin_4)));

                $sta_5_m = strval(date('m', strtotime($sta_5)));
                $sta_5_d = strval(date('d', strtotime($sta_5)));
                $fin_5_m = strval(date('m', strtotime($fin_5)));
                $fin_5_d = strval(date('d', strtotime($fin_5)));
            ?>

            <canvas id="canvas"></canvas>
            <script>
                let canvas = document.getElementById("canvas");

                let sta_1 = <?php print $sta_1_m; ?> + '/' + <?php print $sta_1_d; ?>;
                let fin_1 = <?php print $fin_1_m; ?> + '/' + <?php print $fin_1_d; ?>;

                let sta_2 = <?php print $sta_2_m; ?> + '/' + <?php print $sta_2_d; ?>;
                let fin_2 = <?php print $fin_2_m; ?> + '/' + <?php print $fin_2_d; ?>;

                let sta_3 = <?php print $sta_3_m; ?> + '/' + <?php print $sta_3_d; ?>;
                let fin_3 = <?php print $fin_3_m; ?> + '/' + <?php print $fin_3_d; ?>;

                let sta_4 = <?php print $sta_4_m; ?> + '/' + <?php print $sta_4_d; ?>;
                let fin_4 = <?php print $fin_4_m; ?> + '/' + <?php print $fin_4_d; ?>;

                let sta_5 = <?php print $sta_5_m; ?> + '/' + <?php print $sta_5_d; ?>;
                let fin_5 = <?php print $fin_5_m; ?> + '/' + <?php print $fin_5_d; ?>;

                let myLineChart = new Chart(canvas, {
                    type: 'line',
                    data: {
                        labels: [sta_1 + '～' + fin_1, 
                                sta_2 + '～' + fin_2, 
                                sta_3 + '～' + fin_3, 
                                sta_4 + '～' + fin_4, 
                                sta_5 + '～' + fin_5],
                        datasets: [{
                                label: '全体',
                                data: [<?php
                                        print $rec1_1['COUNT(*)'] . ',';
                                        print $rec1_2['COUNT(*)'] . ',';
                                        print $rec1_3['COUNT(*)'] . ',';
                                        print $rec1_4['COUNT(*)'] . ',';
                                        print $rec1_5['COUNT(*)'];
                                        ?>],
                                borderColor: 'rgba(0,255,0,1)',
                                backgroundColor: 'rgba(0,0,0,0)'
                            },
                            {
                                label: 'ファイザー',
                                data: [<?php
                                        print $rec2_1['COUNT(*)'] . ',';
                                        print $rec2_2['COUNT(*)'] . ',';
                                        print $rec2_3['COUNT(*)'] . ',';
                                        print $rec2_4['COUNT(*)'] . ',';
                                        print $rec2_5['COUNT(*)'];
                                        ?>],
                                borderColor: 'rgba(255,0,0,1)',
                                backgroundColor: 'rgba(0,0,0,0)'
                            },
                            {
                                label: 'モデルナ',
                                data: [<?php
                                        print $rec3_1['COUNT(*)'] . ',';
                                        print $rec3_2['COUNT(*)'] . ',';
                                        print $rec3_3['COUNT(*)'] . ',';
                                        print $rec3_4['COUNT(*)'] . ',';
                                        print $rec3_5['COUNT(*)'];
                                        ?>],
                                borderColor: 'rgba(0,0,255,1)',
                                backgroundColor: 'rgba(0,0,0,0)'
                            },
                        ],
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: '茨城県'
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMax: 5,
                                    suggestedMin: 0,
                                    stepSize: 1,
                                    callback: function(value, index, values) {
                                        return value;
                                    }
                                }
                            }]
                        },
                    }
                });
            </script>

        </div>

    </main><!-- /.container -->


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>