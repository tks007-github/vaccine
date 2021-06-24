<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>c_space</title>
</head>
<body>
<?php 
    session_start();
    session_regenerate_id(true);
    if(isset($_session['login'])==false)

    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];

   /* print $name;
    print $tel;
    print $mail;
*/

    
?>


    <br>希望する接種会場を選択して下さい。<br><br>
    
  
    <form method = "post" action = "c_date.php">
    接種会場：
    <select name = "site_code">
        <option value="S0001">常総病院</option>
        <option value="S0002">守谷病院</option>
        <option value="S0003">つくば病院</option><br>
    </select>
    <br>
    <input type = "hidden" value =<?php print $name;?> name ="name">
    <input type = "hidden" value =<?php print $tel; ?> name ="tel">
    <input type = "hidden" value =<?php print $mail; ?> name ="mail">

    <input type="reset" value="戻る">
    <input type="submit" value="次へ">
    </form>



</body>
</html>