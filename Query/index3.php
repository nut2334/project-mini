<?php 
    include "../connect/connect.php"; 
?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style-index.css">
    <?php include "../nav/nav.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/Query.css">
</head>

<body style="padding:10px; line-height: 30px;">
    <?php
    $stmt = $pdo->prepare("SELECT invoice.invoice_id , Customer.cus_name
        FROM invoice INNER JOIN Repair_detail JOIN Request JOIN Telephone JOIN Customer
        WHERE invoice.repair_id = Repair_detail.repair_id
        AND Repair_detail.request_id = Request.request_id
        AND Request.tel_id = Telephone.tel_id
        AND Telephone.cus_name = Customer.cus_name");
    $stmt->execute(); ?>
    <?php while ($row = $stmt->fetch()) { ?>
        <div class="query">
        รหัสใบแจ้งหนี้ : <?= $row["invoice_id"] ?><br>
        ชื่อ-สกุล : <?= $row["cus_name"] ?><br>
        </div>
    <?php } ?>
</body>

</html>