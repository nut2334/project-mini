<?php include "../connect/connect.php" ?>
<html>
<head>
    <meta charset="UTF-8">
    <?php include "../nav/nav.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/PhoneE&I.css">
</head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM telephone WHERE telephone.tel_id = ?");
$stmt->bindParam(1,$_GET["tel_id"]); 
$stmt->execute();
$row = $stmt->fetch();?>

<h1>แก้ไขรายละเอียดโทรศัพท์</h1>
<div id="inPdata"style="min-height: 40vh;">
<form action="update-phone.php" method="get">
    <b>tel_id : </b><input type="text" name="tel_id" value="<?=$row["tel_id"]?>" readonly disabled style="background-color:#ddd"><br>
    <b>name : </b><input type="text" name="cus_name" value="<?=$row["cus_name"]?>" readonly disabled style="background-color:#ddd"><br>
    <b>tel_model : </b><input type="text" name="tel_model" value="<?=$row["tel_model"]?>" required><br>
    <b>color : </b><input type="text" name="color" value="<?=$row["color"]?>" required><br>
    <input type="submit" value="แก้ไขข้อมูล" id="submit">
</form>
</div>
<a href="../search/search.php?search-by-name-or-telid=<?= $row["cus_name"] ?>"><input type="button" value="Back" id="bottonB" /></a>
</body>
<footer>
    <?php include "../footer/footer2.php" ?>
</footer>
</html>
