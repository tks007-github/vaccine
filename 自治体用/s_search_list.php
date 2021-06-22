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
$res_date=$_POST['res_date'];
$res_time=$_POST['res_time'];
$vac_code=$_POST['vac_code'];
var_dump($_POST);

//データベースに接続
$dsn = 'mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//SQL文 :my_numは名前付きプレースホルダで動的に値をセットできる
$sql = 'SELECT my_num, res_date, res_time, vac_code FROM Reservation ';

$flg = true;
if ($my_num!="")
{
    $sql .= 'WHERE my_num=?';
    $flg = false;
}
if ($res_date!="" && $flg)
{
    $sql .= 'WHERE res_date=?';
    $flg = false;
} else if ($res_date!="")
{
    $sql .= 'AND res_date=?';
} else {}
if ($res_time!="" && $flg)
{
    $sql .= 'WHERE res_time=?';
    $flg = false;
} else if ($res_time!="")
{
    $sql .= 'AND res_time=?';
} else {}
if ($vac_code!="" && $flg)
{
    $sql .= 'WHERE vac_code=?';
    $flg = false;
} else if ($vac_code!="")
{
    $sql .= 'AND vac_code=?';
} else {}
//プリペアドステートメントを作成
$stmt = $dbh->prepare($sql);

if ($my_num=="" && $res_date=="" && $res_time=="" && $vac_code=="")
{
    $stmt->execute();
} else {
    if ($my_num!="")
    {
        $data[]=$my_num;
    }
    if ($res_date!="")
    {
        $data[]=$res_date;
    }
    if ($res_time!="")
    {
        $data[]=$res_time;
    }
	if ($vac_code!="")
    {
        $data[]=$vac_code;
    }
    //実行
	$stmt->execute($data);
}

//データベース接続を切断
$dbh = null;

//データを取得（PDO::FETCH_ASSOCで連想配列を返す）
$rec = $stmt->fetchAll();


print'検索結果<br/><br/>';

if (isset($rec[0]['my_num'])==false)
{
    print '該当するデータはありません';
} else {
    foreach($rec as $key=>$value)
    {
        print 'マイナンバー：'.$value['my_num'].'　';
        print '予約日：'.$value['res_date'].'　';
		print '予約時間：'.$value['res_time'].'　';
        print 'ワクチンコード：'.$value['vac_code'].'<br>';
    }
}

}
catch(Exception $e)
{var_dump($e);
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<input type="button" onclick="location.href='s_search.php'" value="戻る">


</body>
</html>