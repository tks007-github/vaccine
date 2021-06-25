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
	session_start();
	//try
	{
		$r_my_num = $_SESSION['my_num'];
		$dsn = 'mysql:dbname=vaccine_reservation;host=localhost;charset=utf8';
		$user = 'root';
		$password = 'root';
		$dbh = new PDO($dsn, $user, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT my_num,kana,tel,mail FROM citizen_add WHERE my_num= ?';
		$stmt = $dbh->prepare($sql);
		$data[] = $r_my_num;
		$stmt->execute($data);
		//$dbh=null;

		$sql1 = 'SELECT site_code,res_date,res_time FROM reservation WHERE my_num= ?';
		$stmt1 = $dbh->prepare($sql1);
		$data1[] = $r_my_num;
		$stmt1->execute($data1);
		$dbh = null;



	?>

		<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
			<div class="container-fluid">
				<div class="navbar-brand">

				</div>
				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<ul class="navbar-nav me-auto mb-2 mb-md-0">
						<li class="nav-item active">
							<a class="nav-link" aria-current="page" href="d_login.html">
								<font color="white">←戻る</font>
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
				<h1>予約者情報</h1>
				<br><br>
			<?php
			print '<form method="post"action="c_delete_check.php">';
			while (true) {
				$rec = $stmt->fetch(PDO::FETCH_ASSOC);
				$rec1 = $stmt1->fetch(PDO::FETCH_ASSOC);
				switch ($rec1['site_code']) {
					case 'S0001':
						$site_name = '常総病院';
						break;

					case 'S0002':
						$site_name = '守谷病院';
						break;

					case 'S0003':
						$site_name = 'つくば病院';
						break;
				}
				if ($rec == false) {
					break;
				}
				print '<h3><input type="radio" name="r_my_num" value="' . $rec['my_num'] . '">';
				print $rec['kana'] . '様</h3><br />';
				print '<h3>電話番号：' . $rec['tel'] . '</h3>';
				print '<br />';
				print '<h3>メールアドレス：' . $rec['mail'] . '</h3>';
				print '<br />';
				print '<h3>会場：' . $site_name . '</h3>';
				print '<br />';
				print '<h3>日時：' . $rec1['res_date'] . ' / ' . $rec1['res_time'] . '</h3>';
				print '<br />';
				print '<h4>時間を守って来訪をお願いいたします</h4><br />';
			}
			print '<br />';
			print '<h3><input type="submit"name="c_delete_check.php"value="予約取消し"></h3>';
			print '</form>';
		}
			?>

			</div>

		</main><!-- /.container -->


		<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>