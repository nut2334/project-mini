<?php include "../connect/connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style-index.css">
    <link rel="stylesheet" type="text/css" href="../css/Query.css">
</head>
<?php include "../nav/nav.php" ?>

<body style=" line-height: 30px;">
    <?php
    $stmt = $pdo->prepare("
                SELECT branch.branch_id,COUNT(customer.cus_name) as total_cus
                FROM customer INNER JOIN telephone JOIN request JOIN employee JOIN branch
                WHERE customer.cus_name = telephone.cus_name
                AND telephone.tel_id = request.tel_id
                AND request.request_caretaker = employee.employee_id
                AND employee.branch_id = branch.branch_id
                AND branch.branch_id = 'b004'
                GROUP BY customer.cus_name;");
    $stmt2 = $pdo->prepare('    
                SELECT customer.cus_name
                FROM customer INNER JOIN telephone JOIN request JOIN employee
                JOIN branch
                WHERE customer.cus_name = telephone.cus_name 
                AND telephone.tel_id = request.tel_id 
                AND request.request_caretaker = employee.employee_id 
                AND employee.branch_id = branch.branch_id
                AND branch.branch_id = "b004"
                GROUP BY customer.cus_name;');
    $stmt->execute();
    $stmt2->execute();
    $row = $stmt->fetch();?>
    <div class="query">
    รหัสสาขา: <?= $row["branch_id"] ?><br>
    จำนวนลูกค้า: <?= $row["total_cus"] ?><br>
    <hr>
    <?php while ($row = $stmt2->fetch()) { ?>
        ชื่อลูกค้า: <?= $row["cus_name"] ?><br>
        <hr>
    <?php } ?>
    </div>
</body>

</html>