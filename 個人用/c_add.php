<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>c_add</title>
</head>
<body>
    <?php
    
    session_start();
    session_regenerate_id(true);
    if(isset($_session['login'])==false)

    $mynum = $_SESSION['my_num'];
    $birth = $_SESSION['birth'];

    ?>
    
    <br>
    連絡先を正しく入力してください。<br>
    <br>
    <form action = "c_space.php" method = "post">
    名前 (カナ)<br>
    <input type="text" name="name"  placeholder="入力必須"><br> 
    電話 (ハイフン不要）<br>
    <input type="text" name="tel" placeholder="入力必須"><br>
    メールアドレス<br>
    <input type="text" name="mail"  placeholder="入力必須"><br>
    <br>


    <input type="button" onclick="history.back()"value=戻る>
    <input type="submit" value="次へ" >


    </form>
    <!-- pattern="^[ァ-ンヴー]+$ , [\u30A1-\u30FF]*" -->
    <!-- pattern="0|[1-9][0-9]*"  -->
    <!-- pattern="^[0-9A-Za-z]+$" -->
</body>
</html>