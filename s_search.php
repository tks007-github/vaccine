

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ワクチン予約</title>
</head>
<body>
ワクチン予約検索<br>
<br/>
<form method="post" action="s_search_list.php">
<br />
マイナンバー
<select name="my_num">
    <option value=""></option>
    <option value="M0001">M0001</option>
    <option value="M0002">M0002</option>
    <option value="M0003">M0003</option>
    <option value="M0004">M0004</option>
    <option value="M0005">M0005</option>
</select> 

予約日
<select name="res_date">
    <option value=""></option>
    <option value="2021-06-02">6月2日</option>
    <option value="2021-06-09">6月9日</option>
    <option value="2021-06-16">6月16日</option>
    <option value="2021-06-23">6月23日</option>
    <option value="2021-07-07">7月7日</option>
</select> 
時間
<select name="res_time">
    <option value=""></option>
    <option value="11:00">11:00</option>
    <option value="12:00">12:00</option>
    <option value="13:00">13:00</option>
</select> 
ワクチン種別
<select name="vac_code">
    <option value=""></option>
	<option value="V01">ファイザー</option>
	<option value="V02">モデルナ</option>
</select>
<br />
<br />
<input type="button" onclick="location.href='s_top.php" value="戻る">

<input type="submit" value="検索"><br />

</form>
</body>
</html>