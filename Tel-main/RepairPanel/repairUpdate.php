<?php include "../connectMysqli.php";
$rpid = $_POST['repair_id'];
$rmid = $_POST['repairman_id'];
$action = $_POST['action'];
if ($action == "repairing") {
    $sql = "UPDATE repair_detail
                SET repair_status = 'in progress', start_date = CURDATE()
                WHERE repair_id = '$rpid';
            ";
    $sql2 = "UPDATE request as a
                INNER JOIN repair_detail as b on a.request_id = b.request_id
                SET a.request_status = 'repairing'
                WHERE b.repair_id = '$rpid';
            ";


    $conn->query($sql);
    $conn->query($sql2);
}
if ($action == "repaired") {
    $cost = $_POST['cost'];
    $sql = "UPDATE repair_detail
                SET repair_status = 'repaired', finish_date = CURDATE()
                WHERE repair_id = '$rpid';
            ";
    $sql2 = " UPDATE repairman
                SET repair_count  = repair_count + 1
                WHERE repairman_id = '$rmid';
            ";
    $sql3 = " UPDATE request as a
                INNER JOIN repair_detail as b on a.request_id = b.request_id
                SET a.request_status = 'pending'
                WHERE b.repair_id = '$rpid';
            ";
    $sql4 = " INSERT INTO invoice(repair_id, cost)
                VALUES ('$rpid', $cost)
            ";
    $conn->query($sql);
    $conn->query($sql2);
    $conn->query($sql3);
    $conn->query($sql4);
}
if ($action == "require") {
    $sql = "UPDATE repair_detail
                SET repair_status = 'require spare part'
                WHERE repair_id = '$rpid';
        ";
    $conn->query($sql);
}
