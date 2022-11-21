<?php include "../connect/connect.php" ?>
<html>
    <head>
    <mega charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/insert-phone.css">
    </head>
    <body>

    <?php include "../nav/nav_login.php" ?>
    <?php include "../nav/nav.php" ?>
    
    <div class="main">
        <div class="add">
        <h1> เพิ่มเครื่องเข้าระบบ </h1>
        <form action="insert-phone-to-database.php?cus_name=<?=$_GET['cus_name'] ?>" method="post" class="F1">
            <b>tel_model : </b><input type="text" name="tel_model" required><br>
            <b>color : </b><input type="text" name="color" required><br>
            <input type="submit" value="Add" id="submit">
        </form>
    </div>
    </div>
    <a href="../search/search.php?search-by-name-or-telid=<?=$_GET['cus_name']?>"><input type="button" value="Back" id="bottonB" /></a>      
</body>
<footer>
        <?php include "../footer/footer2.php" ?>
</footer>
</html>        