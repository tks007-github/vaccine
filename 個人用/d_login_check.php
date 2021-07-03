<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ワクチン予約</title>
</head>
<body>
<?php

try
{
	SESSION_start();

	if ($_POST['my_num'] == '' ) {
		$my_num = $_SESSION['my_num'];
	} else {
		$my_num = $_POST['my_num'];
	}

	if ($_POST['birth'] == '' ) {
		$birth = $_SESSION['birth'];
	} else {
		$birth = $_POST['birth'];
	}

	// Vaccine_Reservationデータベースに接続する
	$dsn = 'mysql:dbname=vaccine_reservation;host=localhost;charset=utf8';
	$user = 'root'; 
	$password = 'root';
	$dbh = new PDO($dsn,$user,$password);
	$dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	// Citizenテーブルからマイナンバーと生年月日を使って名前を取得
	$sql = 'SELECT name FROM Citizen WHERE my_num=? AND birth=?';
	$stmt = $dbh -> prepare($sql);
	$data[] = $my_num;
	$data[] = $birth;
	$stmt -> execute($data);

	// Vaccine_Reservationデータベースから切断する
	$dbh=null;
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	if($rec==false)		// データベースからの問合せ結果がない場合
	{
		header('Location:d_login_ng.php');
	}
	else				// データベースからの問合せがあった場合
	{
		$_SESSION['my_num']=$my_num;
		$_SESSION['birth']=$birth;
		header('Location:c_mypage.php');
		exit();
	}

	}

	// エラー処理
	catch(Exception $e) 
	{
		print 'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}

?>
</body>
</html>