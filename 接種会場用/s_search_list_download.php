<?php
session_start();                        // s_login_check.phpで作成したセッションを再開
session_regenerate_id(true);            // 既存のセッションIDを新しく置き換える
if (isset($_SESSION['login']) == false)      // セッション変数loginに値が格納されていない場合
{
      print 'ログインされていません。<br>';
      print '<a href="p_login.html">ログイン画面へ</a>';
      exit();
}

date_default_timezone_set('Asia/Tokyo');
// s_search_list.phpから渡された値を$_POSTで受け取る
$csv = $_POST['csv'];
$file = fopen('./' . date('YmdHis') . 'list.csv', 'w');
$csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
fputs($file, $csv);
fclose($file);

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
                                    <a class="nav-link" aria-current="page" href="s_search_list.php">戻る</a>
                              </li>
                        </ul>
                  </div>
                  <input type="button" onclick="location.href='s_login.html'" value="ログアウト">
            </div>
            </div>
      </nav>

      <main class="container">

            <div class="starter-template text-center py-5 px-3">
                  <h1>ダウンロードが完了しました</h1>
            </div>

      </main><!-- /.container -->


      <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>