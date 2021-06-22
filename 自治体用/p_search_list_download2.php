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

<?php

# p_search_list.phpから渡された値を$_POSTで受け取る
$csv=$_POST['csv'];

$file = fopen('./'.date('YmdHis').'list.csv', 'w');
$csv = mb_convert_encoding($csv,'SJIS','UTF-8');
fputs($file,$csv);
fclose($file);

print 'ダウンロードが完了しました';

?>

<br><br>
<input type="button"onclick="location.href='p_search.php'"value="戻る">
</body>
</html>