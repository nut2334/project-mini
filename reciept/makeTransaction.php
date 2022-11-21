<?php
include "../connect/connect.php";

$requestID = $_POST['requestArr'];

for ($i = 0; $i < count($requestID); $i++) {
    $stmt = $pdo->prepare("UPDATE request
                            SET request_status = 'fulfill'
                            WHERE request_id = '$requestID[$i]';");
    $stmt2 = $pdo->prepare("UPDATE invoice as a
                            INNER JOIN repair_detail as b on a.repair_id = b.repair_id
                            INNER JOIN request as c on c.request_id = b.request_id
                            SET payment_status = 'completed', pay_date = CURDATE()
                            WHERE c.request_id = '$requestID[$i]';");

    $stmt->execute();
    $stmt2->execute();
}
echo true;
