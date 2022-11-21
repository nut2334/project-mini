<?php include "../connect.php" 

?>
<html>
    <body>
<form action="insert-phone-to-database.php?cus_name=<?=$_GET['cus_name'] ?>" method="post">
        tel_model: <input type="text" name="tel_model"><br>
        color: <input type="text" name="color"><br>
        <input type="submit" value="add">

        </form>
</body>
</html>        