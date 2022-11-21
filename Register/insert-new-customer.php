<?php 
    include "../connect/connect.php"; 
?>

<?php 
$stmt = $pdo->prepare("INSERT INTO customer VALUES ( ?, ?, ?)");
$stmt->bindParam(1, $_POST["cus_name"]);
$stmt->bindParam(2, $_POST["cus_prefix"]);
$stmt->bindParam(3, $_POST["cus_tel"]);
$stmt->execute();

header('Location:../search/search.php');
?>

<html>
<head><meta charset="UTF-8"></head>
<body>
ลงทะเบียนเสร็จสิ้น ยินดีต้อนรับ คุณลูกค้า
</body>
</html>