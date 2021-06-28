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
$vac_sta_code=$_POST['vac_sta_code'];
$my_num=$_POST['my_num'];
//データベースに接続
$dsn = 'mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = '
        UPDATE Reservation
        SET vac_sta_code = ?
        WHERE my_num = ?
        ';
        
$stmt = $dbh->prepare($sql);
$data[]=$vac_sta_code;
$data[]=$my_num;
//SQL実行
$stmt->execute($data);

//データを取得（PDO::FETCH_ASSOCで連想配列を返す）
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);
//var_dump($rec);
//データベース接続を切断
$dbh = null;
}
catch(Exception $e)
{var_dump($e);
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

修正しました。
<br/>

<input type="button" onclick="location.href='s_search_list.php'" value="戻る">

</form>

</body>
</html>