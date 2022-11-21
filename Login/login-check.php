<?php 
include "../connect/connect.php"; 
session_start();

$stmt = $pdo->prepare("SELECT * FROM employee WHERE employee_id = ? AND emp_tel = ?");
$stmt->bindParam(1,$_POST["employee_id"]);
$stmt->bindParam(2,$_POST["emp_tel"]);
$stmt->execute();
$row = $stmt->fetch();

if(!empty($row)){
    session_regenerate_id();
    $_SESSION["employee_id"]=$row["employee_id"];
    $_SESSION["emp_name"]=$row["emp_name"];
    //$_SESSION["is_repairman"]=false;

    echo "เข้าสู่ระบบสำเร็จ<br>";
    $value=$_POST["employee_id"];
    $check="select repairman_id from repairman where employee_id = '$value'";
    $stmt2 = $pdo->prepare($check);
    $stmt2->execute();
    $row2 = $stmt2->fetch();

    if(empty($row2)){
       // echo "hi<a href='../search/search.php'>ไปยังหน้าหลัก</a><br>";
       setcookie("is_repairman",0,time() +3600,"/");
    }
    else{
        //$_SESSION["is_repairman"]=true;
        setcookie("is_repairman",1,time() +3600,"/");
        $_SESSION["repairman"]=$row2['repairman_id'];
        
        //echo "hi2<a href='../search/search.php'>ไปยังหน้าหลัก</a><br>";
    }
}
else{
    echo "ไม่สำเร็จ ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
}
?>