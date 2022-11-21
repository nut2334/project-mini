<?php
$pdo = new PDO("mysql:host=localhost;dbname=telephone;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); ?>
<html>
    <head><meta charset="utf-8"></head>
    <body style="padding:10px; line-height: 30px;">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM telephone WHERE cus_name LIKE ?");
        $value = $_GET["cus_name"];
        $stmt->bindParam(1, $value); 
        $stmt->execute();
        $row = $stmt->fetch();?>
        <h1>ประวัติการซ่อม</h1>
        ID ของโทรศัพท์ : <?=$row["tel_id"]?><br>
        ชื่อ-สกุล : <?=$row["cus_name"]?><br>
        รุ่นโทรศัพท์ : <?=$row["tel_model"]?><br>
        สีโทรศัพท์ : <?=$row["color"]?><br>
    </body>
</html>
