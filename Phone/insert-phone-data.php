<?php include "../connect/connect.php" ?>
<html>
<head>
    <meta charset="utf-8">
    <?php include "../nav/nav.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/PhoneE&I.css">
</head>
<body>
<?php
    $stmt = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model,telephone.color,telephone.cus_name
    FROM telephone WHERE telephone.tel_id like ?
    ");
    $stmt->bindParam(1,$_GET["tel_id"]);
    $stmt->execute();
    $row = $stmt->fetch();
?>

    <h1>รายละเอียดโทรศัพท์</h1>
    <div id="inPdata"style="min-height: 40vh;">
    <b>tel_id : </b><?=$row["tel_id"]?><br>
    <b>name : </b><?=$row["cus_name"]?><br>
    <b>tel_model : </b><?=$row["tel_model"]?><br>
    <b>color : </b><?=$row["color"]?><br>
    <a href="edit-phone.php?tel_id=<?=$row["tel_id"]?>"><input type="button" value="แก้ไข" id="submit" /></a> 
    <a href="./delete-phone.php?tel_id=<?=$row["tel_id"]?>&cus_name=<?=$row["cus_name"]?>"><input type="button" value="ลบ" id="submit" /></a>
    </div>
    <a href="../search/search.php?search-by-name-or-telid=<?=$row["cus_name"]?>"><input type="button" value="Back" id="bottonB" /></a>
</body>
<footer>
    <?php include "../footer/footer2.php" ?>
</footer>
</html>