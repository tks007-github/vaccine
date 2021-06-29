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

      # 本日までの累計接種者数をカウントするSQL文の生成
      $sql = '
      SELECT COUNT(*), CURDATE() FROM Reservation
      WHERE res_date <= CURDATE() AND vac_sta_code = 1
      ';

      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      # Vaccine_Reservationデータベースから切断する
      $dbh = null;
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
}
# エラーが発生した場合の処理
catch (Exception $e) {
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
                                    <a class="nav-link" aria-current="page" href="#">戻る</a>
                              </li>
                        </ul>
                  </div>
                  <input type="button" onclick="location.href='p_login.html'" value="ログアウト">
            </div>
            </div>
      </nav>

      <main class="container">

            <div class="starter-template text-center py-5 px-3">
                  <h1>ワクチン予約管理</h1>
                  <h2>～自治体用～</h2>
                  <br><br><br>
                  <h1 class="count-sum-color"><?php print $rec["CURDATE()"]; ?>現在</h1>
                  <h1 class="count-sum-color">累計ワクチン接種者数</h1><br>
                  <h1 class="count-sum"><?php print $rec["COUNT(*)"]; ?>人</h1>
                  <br><br><br><br><br>
                  <h4><a href="p_search.php">詳細検索</a></h4><br>
                  <h4><a href="p_graph.php">グラフ</a></h4>
            </div>

      </main><!-- /.container -->


      <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>