<?php
session_start();	      # p_login_check.phpで作成したセッションを再開
$_SESSION=array();	# セッション変数(秘密文書)を空にする
if(isset($_COOKIE[session_name()])==true)	# cookieが存在する場合
{
      setcookie(session_name(),'',time()-42000,'/');	# セッションIDをcookieから削除
}
session_destroy();	# セッションを破棄する
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ワクチン予約</title>
</head>
<body>

<h1>ログアウトしました。</h1>
<br>
<br>
<a href="p_login.html">ログイン画面へ</a>

</body>
</html>
