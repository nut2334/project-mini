<?php
$pdo = new PDO("mysql:host=localhost;dbname=telephone;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); ?>
<html>
    <head><meta charset="utf-8"></head>
    <body style="padding:10px; line-height: 30px;">
        <?php
            $stmt = $pdo->prepare("
                SELECT branch.branch_id,COUNT(customer.cus_name) as total_cus
                FROM customer
                INNER JOIN telephone
                ON customer.cus_name = telephone.cus_name
                INNER JOIN request
                ON telephone.tel_id = request.tel_id
                INNER JOIN employee
                ON request.request_caretaker = employee.employee_id
                INNER JOIN branch
                ON employee.branch_id = branch.branch_id
                WHERE branch.branch_id = 'b004';
            ");
            $stmt2 = $pdo->prepare('    
                SELECT customer.cus_name
                FROM customer
                INNER JOIN telephone
                ON customer.cus_name = telephone.cus_name
                INNER JOIN request
                ON telephone.tel_id = request.tel_id
                INNER JOIN employee
                ON request.request_caretaker = employee.employee_id
                INNER JOIN branch
                ON employee.branch_id = branch.branch_id
                WHERE branch.branch_id = "b004";'
            );
           
            $stmt->execute();
            $stmt2->execute();
            
        ?>
        
        <?php while($row = $stmt->fetch()){ ?>
            รหัสสาขา: <?=$row["branch_id"]?><br>
            จำนวนลูกค้า: <?=$row["total_cus"]?><br>
        <hr>
        <?php } ?>
        <?php while($row = $stmt2->fetch()){ ?>
            ชื่อลูกค้า: <?=$row["cus_name"]?><br>
        <hr>
        <?php } ?>
    </body>
</html>