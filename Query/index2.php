<?php 
    include "../connect/connect.php"; 
?>
<html>
    <head><meta charset="utf-8"></head>
    <body style="padding:10px; line-height: 30px;">
        hi
        <?php
        $stmt = $pdo->prepare('
            update repair_detail
            set repair_status = "repaired"
            where repair_id = (select repairing from repairman where repairman_id = "r001");');
        $stmt2 = $pdo->prepare('    
            SELECT * FROM repair_detail WHERE repairman_id="r001";');
        $stmt3 = $pdo->prepare(' 
            update repairman 
            set repairing = NULL 
            where repairman.repairman_id = "r001";
        ');
        $stmt->execute();
        $stmt2->execute();
        $stmt3->execute();
        ?>
        
        <?php while($row = $stmt2->fetch()){ ?>
            รหัสช่าง: <?=$row["repairman_id"]?><br>
            เลขคำร้อง: <?=$row["request_id"]?><br>
            สถานะการซ่อม: <?=$row["repair_status"]?><br>
        <hr>
        <?php } ?>
    </body>
</html>