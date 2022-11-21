<?php
$pdo = new PDO("mysql:host=localhost;dbname=telephone;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>ค้นหาข้อมูลลูกค้า</title>
    </head>
    <body>
        <form action ='ShowTel.php' method = 'GET'>
        ชื่อ-สกุล:
        <input type='text' name="cus_name"><br>
        <input type='submit' value = 'ค้นหา'><input type='button' value='ดูสมาชิกทั้งหมด'>
    </form>
    </body>
</html>
