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
# P_login.htmlからマイナンバー、生年月日の値を受け取る
$my_num=$_POST['my_num'];
$birth=$_POST['birth'];

# 受け取った値をサニタイズ
$my_num=htmlspecialchars($my_num,ENT_QUOTES,'UTF-8');
$birth=htmlspecialchars($birth,ENT_QUOTES,'UTF-8');

# Vaccine_Reservationデータベースに接続する
$dsn='mysql:dbname=vaccine_reservation;host=localhost;charset=utf8';
$user='root'; 
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

 # Citizenテーブルからマイナンバーと生年月日を使って名前を取得
 $sql='SELECT name FROM Citizen WHERE my_num=? AND birth=?';
$stmt=$dbh->prepare($sql);
$data[]=$my_num;
$data[]=$birth;
$stmt->execute($data);

# Vaccine_Reservationデータベースから切断する
$dbh=null;
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

if($rec==false)	# データベースからの問合せ結果がない場合
{
	header('Location:c_login_ng.html');
}
else	# データベースからの問合せがあった場合
{
	session_start();
	// $_SESSION['login']=1;
	$_SESSION['my_num']=$my_num;
	$_SESSION['birth']=$birth;
    header('Location:c_add.php');
    print 'seiko';
	exit();
}

}
catch(Exception $e) # エラーの場合は下記を表示
{
    var_dump($e);
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
</body>
</html>