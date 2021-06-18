<?php
session_start();			        # p_login_check.phpで作成したセッションを再開
session_regenerate_id(true);		# 既存のセッションIDを新しく置き換える
if(isset($_SESSION['login'])==false)	# セッション変数loginに値が格納されていない場合
{
      print 'ログインされていません。<br>';
      print '<a href="p_login.html">ログイン画面へ</a>';
      exit();
}
else	# セッション変数loginに値が格納されている場合(ログイン成功)
{
      print $_SESSION['pre_name'];	# セッション変数pre_nameを表示
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

ワクチン接種予約状況の検索<br>
<br />
<form method="post"action="p_search_list.php">
接種会場
<select name="site_code">
    <option value=""></option>
	<option value="S0001">常総病院</option>
	<option value="S0002">守谷病院</option>
	<option value="S0003">つくば病院</option>
</select>
日にち
<select name="res_date">
    <option value=""></option>
	<option value="2021-06-02">6月2日</option>
	<option value="2021-06-09">6月9日</option>
</select>
ワクチン種別
<select name="vac_code">
    <option value=""></option>
	<option value="V01">ファイザー</option>
	<option value="V02">モデルナ</option>
</select>
<br>
<br>
<input type="button"onclick="location.href='p_top.php'"value="戻る">
<input type="submit"value="検索"><br>
</form>
</body>
</html>
