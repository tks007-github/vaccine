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

<script>
    function func_check() {
        let flg = true;
        const result_id = func_id_check();
        const result_pass = func_pass_check();
        flg = flg && result_id;
        flg = flg && result_pass;
  
        return flg;
    }
  
    function func_id_check() {
        const id = document.getElementById('input_my_num').value;
        if (id === '') {
            window.alert('マイナンバーを入力してください');
            return false;
        } else {
            return true; 
        }
    }
  
    function func_pass_check() {
        const pass = document.getElementById('input_birth').value;
        if (pass === '') {
            window.alert('生年月日を入力してください');
            return false;
        } else {
            return true; 
        }
    }
  </script>  

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
</head>

<body>
     <?php
     SESSION_start();

     $_SESSION['my_num'] = '';
     $_SESSION['birth'] = '';

     ?>


    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand">
                
            </div>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="c_top.html"><font color="white">←戻る</font></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="c_top.html"><font color="white">ホーム</font></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">

        <div class="starter-template text-center py-5 px-3">
            <h1>個人認証の為、以下を入力してください</h1>
            <br><br><br><br>
            <form method="post" action="c_login_check.php"  onsubmit="return func_check()">
                <h1>マイナンバー</h1>
                <h5><input type="text" name="my_num" id="input_my_num"  placeholder="入力必須"></h5>
                <br><br>
                <h1>生年月日</h1>
                <h5><input type="date" name="birth"  id="input_birth" placeholder="入力必須"></h5>
                <br><br>
                <br><br>
                <h3><input type="submit" value="次へ" id = "submit"></h3>
            </form>
        </div>

    </main><!-- /.container -->


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>