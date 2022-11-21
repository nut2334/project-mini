<?php include "../connect/connect.php" ?>
<?php
    $stmt = $pdo->prepare("DELETE FROM telephone WHERE telephone.tel_id = ?");
    $stmt->bindParam(1, $_GET["tel_id"]);

    if($stmt->execute()){
        header("location:./insert-phone.php?cus_name=".$_GET["cus_name"]);
    }
?>