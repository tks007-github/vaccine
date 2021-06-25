<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ワクチン接種予約マイページ</title>
</head>
<body>

<?php

//try
{
$r_my_num=$_SESSION['my_num'];
$dsn='mysql:dbname=vaccine_reservation;host=localhost;charset=utf8';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT my_num,kana,tel,mail FROM citizen_add WHERE my_num= ?';
$stmt=$dbh->prepare($sql);
$data[]=$r_my_num; 
$stmt->execute($data);
//$dbh=null;

$sql1='SELECT site_code,res_date FROM reservation WHERE my_num= ?';
$stmt1=$dbh->prepare($sql1);
$data1[]=$r_my_num; 
$stmt1->execute($data1);
$dbh=null;

print'予約情報一覧<br /><br />';

print'<form method="post"action="c_delete_check.php">';
while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	$rec1=$stmt1->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	print'<input type="radio" name="r_my_num" value="'.$rec['my_num'].'">';
	print$rec['kana'].'様<br />';
	print'TEL'.$rec['tel'];
	print'<br />';
	print'mail'.$rec['mail'];
	print'<br />';
	print'会場'.$rec1['site_code'];
	print'<br />';
	print'日時'.$rec1['res_date'];
	print'<br />';
	print'時間を守って来訪をお願いいたします<br />';
}
print'<br />';
print'<input type="submit"name="c_delete_check.php"value="予約取消し">';
print'</form>';
}
//catch(Exception $e)
//{
//	print'ただいま障害により大変ご迷惑をお掛けしております。';
//	exit();
//}

?>
<br />
<a href="../vaccine_reservation/c_top.html">戻る<br />

</body>
</html>
