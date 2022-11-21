<?php
$pdo = new PDO("mysql:host=localhost;dbname=telephone;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); ?>
<html>
    <head><meta charset="utf-8"></head>
    <body style="padding:10px; line-height: 30px;">
        <?php
        $stmt = $pdo->prepare("SELECT invoice.invoice_id , Customer.cus_name
        FROM invoice
        INNER JOIN Repair_detail
        ON invoice.repair_id = Repair_detail.repair_id
        INNER JOIN Request
        ON Repair_detail.request_id = Request.request_id
        INNER JOIN Telephone
        ON Request.tel_id = Telephone.tel_id
        INNER JOIN Customer
        ON Telephone.cus_name = Customer.cus_name");
        $stmt->execute(); ?>
        <?php while($row = $stmt->fetch()){ ?>
        ID ของโทรศัพท์ : <?=$row["invoice_id"]?><br>
        ชื่อ-สกุล : <?=$row["cus_name"]?><br>
        <hr>
        <?php } ?>
    </body>
</html>