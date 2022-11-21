<?php include "connect.php" ?>
<?php
$currentRequestSQL = "SELECT COUNT(*) as count FROM `telephone`";
$currentRequestData = $pdo->prepare($currentRequestSQL);
$currentRequestData->execute();
$row = $currentRequestData->fetch();
$currentRequestFetch = $row['count'];
$currentRequestID = $currentRequestFetch + 1;
$str = strval($currentRequestID);
while (strlen($str) < 3) {
    $str = '0' . $str;
}
$realRequestID = 'tel' . $str;
$stmt = $pdo->prepare("INSERT INTO telephone VALUES ( ?, ?, ?)");
$stmt->bindParam(1,$realRequestID);
$stmt->bindParam(2,$_POST["tel_model"]);
$stmt->bindParam(3,$_POST["color"]);
$stmt->execute();
?>