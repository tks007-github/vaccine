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

$dsn='mysql:dbname=vaccine_reservation;host=localhost;charset=utf8';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT my_num,kana,tel,mail FROM citizen_add WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

print'予約情報一覧<br /><br />';

print'<form method="post"action="c_delete_check.php">';
while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
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
	print'会場<br />';
	print'日時<br />';

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
<a href="../vaccine_reservation/P_top.html">戻る<br />

</body>
</html>
