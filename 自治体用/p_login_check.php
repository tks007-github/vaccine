<?php
# エラー対策を行う(例外処理)
try
{
# p_login.phpから渡された値を$_POSTで受け取る

$pre_login_id=$_POST['id'];
$pre_pass=$_POST['pass'];

# $pre_passを暗号化する
# $pre_pass=md5($site_pass);
# Vaccine_Reservationデータベースに接続する
$dsn='mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

# Pre_Loginテーブルからpre_login_id(自治体ログインID)と
# pre_pass(自治体ログインパスワード)を使ってpre_name(自治体名)を取得
$sql='
      SELECT pre_name
      FROM Pre_Login
      WHERE pre_login_id=? 
      AND pre_pass=?
      ';
$stmt=$dbh->prepare($sql);
$data[]=$pre_login_id;
$data[]=$pre_pass;
$stmt->execute($data);

# Vaccine_Reservationデータベースから切断する
$dbh=null;
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pre_name = $rec['pre_name'];

if($rec==false)		# データベースからの問い合わせ結果がない場合
{
      header('Location:p_login_ng.php');		
      exit();
}
else			      # データベースからの問い合わせ結果があった場合
{
      session_start();				# セッションを開始
      $_SESSION['login']=1;			# セッション変数に値を格納
      $_SESSION['pre_name']=$pre_name;	# セッション変数にサイトコードを格納
      header('Location:p_top.php');		# p_top.phpへリダイレクト
      exit();
}

}
# エラーが発生した場合の処理
catch(Exception $e)
{
      var_dump($e);
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
}

?>

