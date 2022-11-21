<?php include "../nav/nav.php"; ?>
<?php
include "../connect/connect.php";
if (!isset($_GET['page'])) {
    header("Location: ./index4.php?page=1");
}
?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style-index.css">
    <link rel="stylesheet" type="text/css" href="../css/Query.css">
</head>

<body style="padding:10px; line-height: 30px;">
    <div style="text-align: center;">
        <?php
        $sql = "
                select count(telephone.tel_id) as cnt
                from telephone
                inner join request
                on telephone.tel_id =request.tel_id
                inner join repair_detail
                on request.request_id=repair_detail.request_id
                inner join repairman
                on repair_detail.repairman_id=repair_detail.repairman_id
                inner join employee
                on repairman.employee_id=employee.employee_id
                where repair_status='repaired'
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $pageNum = $stmt->fetch()['cnt'];
        $maxPage = ceil($pageNum / 10);
        for ($i = 1; $i <= $maxPage; $i++) {
        ?>
            <a style="color: white; text-decoration: none;margin: 0 10px;" href="./index4.php?page=<?= $i ?>"><?= $i ?></a>
        <?php
        }


        ?>
    </div>

    <?php
    $sql = "
        select telephone.tel_id,telephone.tel_model,employee.emp_name,repair_detail.finish_date,repair_detail.repair_status
        from telephone
        inner join request
        on telephone.tel_id =request.tel_id
        inner join repair_detail
        on request.request_id=repair_detail.request_id
        inner join repairman
        on repair_detail.repairman_id=repair_detail.repairman_id
        inner join employee
        on repairman.employee_id=employee.employee_id
        where repair_status='repaired'
    ";
    $limitOffset = "limit " . 10 . " offset " . ($_GET['page'] - 1) * 10 . ";";
    $stmt = $pdo->prepare($sql . $limitOffset);
    $stmt->execute(); ?>
    <?php while ($row = $stmt->fetch()) { ?>
        <div class="query">
            ID ของโทรศัพท์ : <?= $row["tel_id"] ?><br>
            รุ่นโทรศัพท์ : <?= $row["tel_model"] ?>
            <?= $row["emp_name"] ?>
            <?= $row["finish_date"] ?>
            <?= $row["repair_status"] ?>
        </div>
    <?php
    } ?>

</body>

</html>