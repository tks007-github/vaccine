<?php
# エラー対策を行う(例外処理)
try
{
# s_login.phpから渡された値を$_POSTで受け取る

$site_login_id=$_POST['id'];
$site_pass=$_POST['pass'];
# $site_passを暗号化する
# $site_pass=md5($site_pass);
# Vaccine_Reservationデータベースに接続する
$dsn='mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

# Site_LoginテーブルとSiteテーブルを結合したものからsite_login_id(接種会場ログインID)と
# site_pass(接種会場ログインパスワード)を使ってsite_name(接種会場名)を取得
$sql='
      SELECT site_code, site_name 
      FROM Site_Login
      JOIN Site
      USING(site_code)
      WHERE site_login_id=? 
      AND site_pass=?
      ';
$stmt=$dbh->prepare($sql);
$data[]=$site_login_id;
$data[]=$site_pass;
$stmt->execute($data);

# Vaccine_Reservationデータベースから切断する
$dbh=null;
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$site_name = $rec['site_name'];
$site_code = $rec['site_code'];

if($rec==false)		# データベースからの問い合わせ結果がない場合
{
      header('Location:s_login_ng.php');		
      exit();
}
else			      # データベースからの問い合わせ結果があった場合
{
      session_start();				# セッションを開始
      $_SESSION['login']=1;			# セッション変数に値を格納
      $_SESSION['site_name']=$site_name;	# セッション変数にサイトコードを格納
      $_SESSION['site_code']=$site_code;
      header('Location:s_top.php');		# s_top.phpへリダイレクト
      exit();
}

}
# エラーが発生した場合の処理
catch(Exception $e)
{ 
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
}

?>

