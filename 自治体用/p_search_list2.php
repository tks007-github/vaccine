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
# エラー対策を行う(例外処理)
try
{
# p_login.phpから渡された値を$_POSTで受け取る

$site_code=$_POST['site_code'];
$res_date=$_POST['res_date'];
$vac_code=$_POST['vac_code'];

# Vaccine_Reservationデータベースに接続する
$dsn='mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

# 検索するSQL文の生成
$sql='
      SELECT R.my_num, TIMESTAMPDIFF(YEAR, C.birth, CURDATE()) AS age, 
      S.site_name, R.res_date, V.vac_name
      FROM Reservation AS R
      JOIN Citizen AS C USING(my_num)
      JOIN Site AS S USING(site_code)
      JOIN Vaccine AS V USING(vac_code)
      WHERE 1
      ';
if ($site_code!="")
{
    $sql .= 'AND site_code=?';
}
if ($res_date!="")
{
    $sql .= 'AND res_date=?';
}
if ($vac_code!="")
{
    $sql .= 'AND vac_code=?';
}
$stmt=$dbh->prepare($sql);

if ($site_code=="" && $res_date=="" && $vac_code=="")
{
    $stmt->execute();
} else {
    if ($site_code!="")
    {
        $data[]=$site_code;
    }
    if ($res_date!="")
    {
        $data[]=$res_date;
    }
    if ($vac_code!="")
    {
        $data[]=$vac_code;
    }
    $stmt->execute($data);
}

# Vaccine_Reservationデータベースから切断する
$dbh=null;
$rec=$stmt->fetchAll();

$csv = 'マイナンバー,接種会場名,予約日,ワクチン種別';
$csv .= "\n";

if (isset($rec[0]['my_num'])==false)
{
    print '該当するデータはありません';
} else {
    foreach($rec as $key=>$value)
    {
        print 'マイナンバー：'.$value['my_num'].'　';
        print '年齢：'.$value['age'].'　';
        print '接種会場名：'.$value['site_name'].'　';
        print '予約日：'.$value['res_date'].'　';
        print 'ワクチン種別：'.$value['vac_name'].'<br>';

        $csv .= $value['my_num'];
        $csv .= ',';
        $csv .= $value['age'];
        $csv .= ',';
        $csv .= $value['site_name'];
        $csv .= ',';
        $csv .= $value['res_date'];
        $csv .= ',';
        $csv .= $value['vac_name'];
        $csv .= "\n";
    }
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

<form method="post"action="p_search_list_download.php">
<input type="hidden"name="csv"value="<?php print $csv; ?>">
<input type="submit"value="CSVファイルをダウンロード">
</form>
<input type="button"onclick="location.href='p_search.php'"value="戻る">

</body>
</html>