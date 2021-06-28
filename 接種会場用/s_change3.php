<?php 
session_start();			      # s_login_check.phpで作成したセッションを再開
session_regenerate_id(true);		# 既存のセッションIDを新しく置き換える
if(isset($_SESSION['login'])==false)	# セッション変数loginに値が格納されていない場合
{
      print 'ログインされていません。<br>';
      print '<a href="s_login.html">ログイン画面へ</a>';
      exit();
}
else	# セッション変数loginに値が格納されている場合(ログイン成功)
{
      print $_SESSION['site_name'];	# セッション変数site_nameを表示
      print 'でログイン中<br>';
      print '<br>';  
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ワクチン予約</title>
</head>
<body>

<?php

try
{
$my_num=$_POST['my_num'];
//var_dump($_POST);
//データベースに接続
$dsn = 'mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = '
        SELECT R.site_code, C.name,
        R.my_num, TIMESTAMPDIFF(YEAR, C.birth, CURDATE()) AS age,
        C.sex, CA.tel, CA.mail,
        R.res_date, R.res_time, V.vac_name, VS.vac_sta_value
        FROM Reservation AS R
        JOIN Citizen AS C USING(my_num)
        JOIN Vaccine AS V USING(vac_code)
        JOIN Vac_Status AS VS USING(vac_sta_code)
        JOIN Citizen_Add AS CA USING(my_num)
        WHERE my_num = ?
        ';
        
$stmt = $dbh->prepare($sql);
$data[]=$my_num;
//SQL実行
$stmt->execute($data);

//データを取得（PDO::FETCH_ASSOCで連想配列を返す）
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
//var_dump($rec);
//データベース接続を切断
$dbh = null;
// $update=$dbh->prepare("UPDATE Vac_Status 
// SET vac_sta_value =:vac_sta_value 
// WHERE vac_sta_value=?") ;
// $update->bindValue(':vac_sta_value',$vac_sta_value);
}
catch(Exception $e)
{var_dump($e);
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

接種完了の更新
<br/>
<form method ="post" action = "s_change_done.php">
予約日：<?php print $rec['res_date'];?> 
予約時間：<?php print $rec['res_time'];?> 
マイナンバー：<?php print $rec['my_num'];?> 
利用者名：<?php print $rec['name'];?> 
年齢：<?php print $rec['age'];?> 
性別：<?php print $rec['sex'];?> 
TEL：<?php print $rec['tel'];?> 
メールアドレス：<?php print $rec['mail'];?> 
ワクチン種別：<?php print $rec['vac_name'];?> 
接種完了：<?php print $rec['vac_sta_value'];?> 
<select name="vac_sta_code">
<option value="0">未</option>
<option value="1">済</option>
</select>に更新<br><br>

<input type="submit" value="更新">
<input type ="hidden" name = "my_num" value = "<?php print $my_num;?>">
<!-- <input type="button" onclick="history.back()" value="戻る"> -->
<input type="button" onclick="location.href='s_search_list.php'" value="戻る">

</form>

</body>
</html>