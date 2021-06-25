
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ワクチン接種管理</title>
</head>
<body>
		
<?php
#例外処理構文によるエラー対策
try
{
#c_delete_check.phpから渡された値をうけとる
$R_my_num=$_POST['my_num'];
$c_res_sta_chack=$_POST['res_sta_code'];
#shopデータベースに接続する
$dsn='mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
#データベースにたいしてSQL文で操作する　追加のためにINSERT文を使う
$sql='DELETE FROM Reservation WHERE my_num=?';
$stmt=$dbh->prepare($sql);

$data[]=$R_my_num;
$stmt->execute($data);
#データベースから切断
$dbh=null;


}
catch (Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

削除しました。<br />
<br />
<a href="../vaccine_reservation/P_login.html">戻る</a>


</body>
</html>
