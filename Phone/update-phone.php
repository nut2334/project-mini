<?php include "../connect/connect.php" ?>
<html>
<head><meta charset="UTF-8"></head>
<body>
<?php
$stmt = $pdo->prepare("UPDATE telephone SET tel_model=?,color=? WHERE tel_id=?");
$stmt->bindParam(1,$_GET["tel_model"]); 
$stmt->bindParam(2,$_GET["color"]); 
$stmt->bindParam(3,$_GET["tel_id"]); 
if($stmt->execute()){
    header("location:./insert-phone.php?cus_name=".$_GET["cus_name"]);
}
?>
</body>
</html>