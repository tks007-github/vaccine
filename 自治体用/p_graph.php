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

    # 2021-05-31～2021-06-04の期間の累計接種者数
    $sql1_1 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_sta_code = 1 AND res_date BETWEEN '2021-05-31' AND '2021-06-04'";
    $stmt1_1 = $dbh->prepare($sql1_1);
    $stmt1_1->execute();
    $rec1_1 = $stmt1_1->fetch(PDO::FETCH_ASSOC);
    # print $rec1_1["COUNT(*)"];

    # 全体 2021-06-07～2021-06-11
    $sql1_2 = "SELECT COUNT(*) FROM Reservation
    WHERE res_date BETWEEN '2021-06-07' AND '2021-06-11'";
    $stmt1_2 = $dbh->prepare($sql1_2);
    $stmt1_2->execute();
    $rec1_2 = $stmt1_2->fetch(PDO::FETCH_ASSOC);
    # print $rec1_2["COUNT(*)"];

    # 全体 2021-06-14～2021-06-18
    $sql1_3 = "SELECT COUNT(*) FROM Reservation
    WHERE res_date BETWEEN '2021-06-14' AND '2021-06-18'";
    $stmt1_3 = $dbh->prepare($sql1_3);
    $stmt1_3->execute();
    $rec1_3 = $stmt1_3->fetch(PDO::FETCH_ASSOC);
    # print $rec1_3["COUNT(*)"];

    # 全体 2021-06-21～2021-06-25
    $sql1_4 = "SELECT COUNT(*) FROM Reservation
    WHERE res_date BETWEEN '2021-06-21' AND '2021-06-25'";
    $stmt1_4 = $dbh->prepare($sql1_4);
    $stmt1_4->execute();
    $rec1_4 = $stmt1_4->fetch(PDO::FETCH_ASSOC);
    # print $rec1_4["COUNT(*)"];

    # 全体 2021-06-28～2021-07-02
    $sql1_5 = "SELECT COUNT(*) FROM Reservation
    WHERE res_date BETWEEN '2021-06-28' AND '2021-07-02'";
    $stmt1_5 = $dbh->prepare($sql1_5);
    $stmt1_5->execute();
    $rec1_5 = $stmt1_5->fetch(PDO::FETCH_ASSOC);
    # print $rec1_5["COUNT(*)"];

    # ファイザー 2021-05-31～2021-06-04
    $sql2_1 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V01' AND res_date BETWEEN '2021-05-31' AND '2021-06-04'";
    $stmt2_1 = $dbh->prepare($sql2_1);
    $stmt2_1->execute();
    $rec2_1 = $stmt2_1->fetch(PDO::FETCH_ASSOC);
    # print $rec2_1["COUNT(*)"];

    # ファイザー 2021-06-07～2021-06-11
    $sql2_2 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V01' AND res_date BETWEEN '2021-06-07' AND '2021-06-11'";
    $stmt2_2 = $dbh->prepare($sql2_2);
    $stmt2_2->execute();
    $rec2_2 = $stmt2_2->fetch(PDO::FETCH_ASSOC);
    # print $rec2_2["COUNT(*)"];

    # ファイザー 2021-06-14～2021-06-18
    $sql2_3 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V01' AND res_date BETWEEN '2021-06-14' AND '2021-06-18'";
    $stmt2_3 = $dbh->prepare($sql2_3);
    $stmt2_3->execute();
    $rec2_3 = $stmt2_3->fetch(PDO::FETCH_ASSOC);
    # print $rec2_3["COUNT(*)"];

    # ファイザー 2021-06-21～2021-06-25
    $sql2_4 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V01' AND res_date BETWEEN '2021-06-21' AND '2021-06-25'";
    $stmt2_4 = $dbh->prepare($sql2_4);
    $stmt2_4->execute();
    $rec2_4 = $stmt2_4->fetch(PDO::FETCH_ASSOC);
    # print $rec2_4["COUNT(*)"];

    # ファイザー 2021-06-28～2021-07-02
    $sql2_5 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V01' AND res_date BETWEEN '2021-06-28' AND '2021-07-02'";
    $stmt2_5 = $dbh->prepare($sql2_5);
    $stmt2_5->execute();
    $rec2_5 = $stmt2_5->fetch(PDO::FETCH_ASSOC);
    # print $rec2_5["COUNT(*)"];

    # モデルナ 2021-05-31～2021-06-04
    $sql3_1 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V02' AND res_date BETWEEN '2021-05-31' AND '2021-06-04'";
    $stmt3_1 = $dbh->prepare($sql3_1);
    $stmt3_1->execute();
    $rec3_1 = $stmt3_1->fetch(PDO::FETCH_ASSOC);
    # print $rec3_1["COUNT(*)"];

    # モデルナ 2021-06-07～2021-06-11
    $sql3_2 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V02' AND res_date BETWEEN '2021-06-07' AND '2021-06-11'";
    $stmt3_2 = $dbh->prepare($sql3_2);
    $stmt3_2->execute();
    $rec3_2 = $stmt3_2->fetch(PDO::FETCH_ASSOC);
    # print $rec3_2["COUNT(*)"];

    # モデルナ 2021-06-14～2021-06-18
    $sql3_3 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V02' AND res_date BETWEEN '2021-06-14' AND '2021-06-18'";
    $stmt3_3 = $dbh->prepare($sql3_3);
    $stmt3_3->execute();
    $rec3_3 = $stmt3_3->fetch(PDO::FETCH_ASSOC);
    # print $rec3_3["COUNT(*)"];

    # モデルナ 2021-06-21～2021-06-25
    $sql3_4 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V02' AND res_date BETWEEN '2021-06-21' AND '2021-06-25'";
    $stmt3_4 = $dbh->prepare($sql3_4);
    $stmt3_4->execute();
    $rec3_4 = $stmt3_4->fetch(PDO::FETCH_ASSOC);
    # print $rec3_4["COUNT(*)"];

    # モデルナ 2021-06-28～2021-07-02
    $sql3_5 = "SELECT COUNT(*) FROM Reservation
    WHERE vac_code = 'V02' AND res_date BETWEEN '2021-06-28' AND '2021-07-02'";
    $stmt3_5 = $dbh->prepare($sql3_5);
    $stmt3_5->execute();
    $rec3_5 = $stmt3_5->fetch(PDO::FETCH_ASSOC);
    # print $rec3_5["COUNT(*)"];

    # Vaccine_Reservationデータベースから切断する
    $dbh = null;
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
            <h3>～１週間のワクチン接種者数推移～</h3>
            <br>

            <canvas id="canvas"></canvas>
            <script>
                let canvas = document.getElementById("canvas");

                let myLineChart = new Chart(canvas, {
                    type: 'line',
                    data: {
                        labels: ['5/31～6/4', '6/7～6/11', '6/14～6/18', '6/21～6/25', '6/28～7/2'],
                        datasets: [{
                                label: '全体',
                                data: [<?php
                                        print $rec1_1["COUNT(*)"] . ',';
                                        print $rec1_2["COUNT(*)"] . ',';
                                        print $rec1_3["COUNT(*)"] . ',';
                                        print $rec1_4["COUNT(*)"] . ',';
                                        print $rec1_5["COUNT(*)"];
                                        ?>],
                                borderColor: "rgba(0,255,0,1)",
                                backgroundColor: "rgba(0,0,0,0)"
                            },
                            {
                                label: 'ファイザー',
                                data: [<?php
                                        print $rec2_1["COUNT(*)"] . ',';
                                        print $rec2_2["COUNT(*)"] . ',';
                                        print $rec2_3["COUNT(*)"] . ',';
                                        print $rec2_4["COUNT(*)"] . ',';
                                        print $rec2_5["COUNT(*)"];
                                        ?>],
                                borderColor: "rgba(255,0,0,1)",
                                backgroundColor: "rgba(0,0,0,0)"
                            },
                            {
                                label: 'モデルナ',
                                data: [<?php
                                        print $rec3_1["COUNT(*)"] . ',';
                                        print $rec3_2["COUNT(*)"] . ',';
                                        print $rec3_3["COUNT(*)"] . ',';
                                        print $rec3_4["COUNT(*)"] . ',';
                                        print $rec3_5["COUNT(*)"];
                                        ?>],
                                borderColor: "rgba(0,0,255,1)",
                                backgroundColor: "rgba(0,0,0,0)"
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