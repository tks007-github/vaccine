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
    <script>
        //選択されていない場合にアラートを出す
        function checksubmit(){
            let flag = 0;
            if(document.form1.my_num.length){
                flag = 1;
                let i;
                for(i=0; i < document.form1.my_num.length; i++){
                    if(document.form1.my_num[i].checked){
                        flag = 0; break;
                    }
                } 
            } else {
                if(!document.form1.my_num.checked){
                    flag = 1;
                }
            }
            if(flag){
                window.alert('選択してください。');
                return false;
            } else {
                return true;
            }
        }
        
    </script>
<?php

try
{
$site_code=$_SESSION['site_code'];
$my_num=$_POST['my_num'];
$res_date=$_POST['res_date'];
$res_time=$_POST['res_time'];
$vac_code=$_POST['vac_code'];
$vac_sta_code=$_POST['vac_sta_code'];

//データベースに接続
$dsn = 'mysql:dbname=Vaccine_Reservation;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


//SQL文 :my_numは名前付きプレースホルダで動的に値をセットできる
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
        WHERE site_code = ?
        ';

if ($my_num!="")
{
    $sql .= 'AND my_num=?';
}
if ($res_date!="")
{
    $sql .= 'AND res_date=?';
}
if ($res_time!="")
{
    $sql .= 'AND res_time=?';
}
if ($vac_code!="")
{
    $sql .= 'AND vac_code=?';
} 
if ($vac_sta_code!="")
{
    $sql .= 'AND vac_sta_code=?';
}

//res_date,res_timeの順に並び替える
$sql .= 'ORDER BY res_date, res_time, my_num';

//プリペアドステートメントを作成
$stmt = $dbh->prepare($sql);
    $data[]=$site_code;
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
	if ($vac_sta_code!="")
    {
        $data[]=$vac_sta_code;
    }
    //$stmt->bindParam(':vac_sta_value', $_GET['vac_sta_value']);
    //実行
	$stmt->execute($data);


//データベース接続を切断
$dbh = null;

//データを取得（PDO::FETCH_ASSOCで連想配列を返す）
$rec = $stmt->fetchAll();

$csv = '予約日,予約時間,マイナンバー,利用者名,年齢,性別,TEL,メールアドレス,ワクチン種別,接種完了';
$csv .= "\n";

print'検索結果<br/><br/>';
//s_change.phpに修正するデータを送る


if (isset($rec[0]['my_num'])==false)
{
    print '該当するデータはありません';
} else {
    foreach($rec as $key=>$value)
    {
        //ラジオボタンで修正したいデータを選択
        print'<form name="form1" method="post" action="s_change.php" onSubmit="return checksubmit()">';
        //print'<form method="post" action="s_change.php">';
        print'<input type="radio" name="my_num" value="'.$value['my_num'].'">';

        print '予約日：'.$value['res_date'].'　';
		print '予約時間：'.$value['res_time'].'　';
        print 'マイナンバー：'.$value['my_num'].'　';
		print '利用者名：'.$value['name'].'　';
        print '年齢：'.$value['age'].'　';
        print '性別：'.$value['sex'].'　';
        print 'TEL：'.$value['tel'].'　';
        print 'メールアドレス：'.$value['mail'].'　';
        print 'ワクチン種別：'.$value['vac_name'].'　';
		print '接種完了：'.$value['vac_sta_value'].'　';
        print '<br>';

        // $csv .= $value['res_date'];
        // $csv .= ',';
        // $csv .= $value['res_time'];
        // $csv .= ',';
        // $csv .= $value['my_num'];
        // $csv .= ',';
        // $csv .= $value['name'];
        // $csv .= ',';
        // $csv .= $value['age'];
        // $csv .= ',';
        // $csv .= $value['sex'];
        // $csv .= ',';
        // $csv .= $value['tel'];
        // $csv .= ',';
        // $csv .= $value['mail'];
        // $csv .= ',';
        // $csv .= $value['vac_name'];
        // $csv .= ',';
        // $csv .= $value['vac_sta_value'];
        // $csv .= "\n";
    }
}

}

catch(Exception $e)
{var_dump($e);
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}


?>

<br>
<input type="submit" value="修正">
<input type="button" onclick="location.href='s_search.php'" value="戻る">
<!-- <form method="post" action="s_change.php">  -->
<!-- <input type="hidden" name="vac_sta_value" value="<?=$vac_sta_value?>">  -->
<!-- <input type="submit" value="更新">  -->
<!-- </form> -->
<br>
<!-- <form method="post" action="s_search_list_download.php">
<input type="hidden"name="csv"value="<?php print $csv; ?>">
<input type="submit" value="CSVファイルをダウンロード"> -->
</form>

</body>
</html>