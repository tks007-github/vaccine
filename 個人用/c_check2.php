<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>c_check</title>
</head>
<body>

    <?php

    session_start();
    session_regenerate_id(true);
    if(isset($_session['login'])==false)

    $name = $_SESSION['name'];
    $mail = $_SESSION['mail'];
    $tel = $_SESSION['tel'];
    $site_name = $_SESSION['site_name'];


        /*$name= $_POST["name"];
        $tel = $_POST["tel"];
        $site = $_POST["site"];//フリガナ,tel,mail,会場,マイナンバー受け取る
        $mynum = $_POST["mynum"];
        */
    $time = $_POST["r_time"];
    $date = $_POST["date"];
    ?>

    <p> 
        名前&nbsp;:<?php print $name; ?>
    </p>
        TEL&nbsp;:<?php print $tel; ?>
    <p>
        mail&nbsp;:<?php print $mail;?>
    </p>
    <p>
        会場名&nbsp;：<?php print $site_name ;?>
    </p>
    <p>
        日時&nbsp;:&emsp;<?php echo $date."&emsp;".$time;  ?>
    </p>

    <p>
    </p>
    <p>
        この内容で予約してよろしいですか?
    </p>
    <form action = "c_done.php" method = "post">
        

            <input type = "hidden" name ="date" value = "<?php echo $date; ?>">
            <input type = "hidden" name ="time" value = "<?php echo $time; ?>">
      <!--  <input type = "hidden" name ="name" value = "<?php echo $name; ?>">
            <input type = "hidden" name ="tel" value = "<?php echo $tel; ?>">
            <input type = "hidden" name ="site" value = "<?php echo $site; ?>">
            <input type = "hidden" name ="mynum" value = "<?php echo $mynum; ?>">

     --><p>
            <input type = "button" onclick = "history.back()" value = "戻る">
            <input type = "submit" value = "次へ" >
        </p>
            
    </form>
 

    


        
    
</body>
</html>