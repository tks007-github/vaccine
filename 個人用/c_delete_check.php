
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ワクチン接種管理</title>
</head>
<body>

<?php

try
{

//$R_my_num=(!empty($_POST['r_my_num']));
$R_my_num=$_POST['r_my_num'];
$dsn='mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
#Reservationデータベースからmy_numを元にデータを取得
$sql='SELECT my_num,res_date,res_time,res_sta_code FROM Reservation WHERE my_num=?';
$stmt=$dbh->prepare($sql);
$data[]=$R_my_num;
$stmt->execute($data);
#データベースの検索結果を$R_my_numに格納
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$Reservation_my_num=$rec['my_num'];
$Reservation_res_date=$rec['res_date'];
$Reservation_res_time=$rec['res_time'];
$Reservation_res_sta_code=$rec['res_sta_code'];
$dbh=null;



}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

接種者コード<br />
<?php print $Reservation_my_num; ?>
<br />
接種予定日<br />
<?php print"$Reservation_res_date";?>
<br />
予定時間<br />
<?php print$Reservation_res_time;?>
<br />
以上の接種を予約しています<br />
<?php print$Reservation_res_sta_code;?>
<br />
この予定を削除してよろしいですか？<br />
<br />

<form method="post"action="c_delete_done.php">
<input type="hidden"name="my_num"value="<?php print$Reservation_my_num;?>">
<input type="hidden"name="res_sta_code"value="<?php print$Reservation_res_sta_code;?>">
<input type="button"onclick="history.back()"value="戻る">
<input type="submit"value="O K">
</form>

</body>
</html>
