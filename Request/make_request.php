<?php include "../connect/connectMysqli.php";
$tel_id = $_POST['tel_id'];
$abnormality = $_POST['abnormality'];
$emp_id = $_POST['emp_id'];

$findLeastQueueSQL = "SELECT least.repairman_id FROM (
                        SELECT `repairman_id`, (
                            SELECT count(*) FROM repair_detail 
                                WHERE repair_status = 'awaiting' 
                                    AND repairman_id = repairman.repairman_id) as in_queue
                        FROM `repairman` ORDER BY in_queue LIMIT 1
                    ) as least;";
$leastQueueData = $conn->query($findLeastQueueSQL);
$leastQueueFetch = mysqli_fetch_array($leastQueueData)['repairman_id'];

$currentRequestSQL = "SELECT COUNT(*) as count FROM `request`";
$currentRequestData = $conn->query($currentRequestSQL);
$currentRequestFetch = mysqli_fetch_array($currentRequestData)['count'];
$currentRequestID = $currentRequestFetch + 1;
$str = strval($currentRequestID);
while (strlen($str) < 3) {
    $str = '0' . $str;
}
$realRequestID = 'rq' . $str;
$insertRequestSQL = "INSERT INTO request(request_id,tel_id, request_caretaker, request_date, abnormality)
        VALUES ('$realRequestID','$tel_id', '$emp_id', CURDATE(), '$abnormality')    
";
$conn->query($insertRequestSQL);
$insertRepairDetailSQL = "INSERT INTO repair_detail(request_id, repairman_id)
                        VALUES ('$realRequestID', '$leastQueueFetch')
";
$conn->query($insertRepairDetailSQL);


echo $realRequestID;
