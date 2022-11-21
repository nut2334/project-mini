<?php 
include "../connect.php"; 
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
    $_SESSION["is_repairman"]=false;
    // $_SESSION["username"]=$row["emp_tel"];

    echo "เข้าสู่ระบบสำเร็จ<br>";
    $value=$_POST["employee_id"];
    $check="select repairman_id from repairman where employee_id = '$value'";
    $stmt2 = $pdo->prepare($check);
    $stmt2->execute();
    $row2 = $stmt2->fetch();
    //$_SESSION["username"]=$row["emp_tel"];
    
    //$result=mysql_query($check) or die(mysql_error());
    //$num=mysql_num_rows($result);
    if(empty($row2)){

        echo "<a href='../search/test.php'>ไปยังหน้าหลัก</a><br>";
    }
    else{
        $_SESSION["is_repairman"]=true;
        $_SESSION["repairman"]=$row2['repairman_id'];
        echo "<a href='../search/test.php'>ไปยังหน้าหลัก</a><br>";
    }
}
else{
    echo "ไม่สำเร็จ ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    echo "<a href='login-form.php'> เข้าสู่ระบบอีกครั้ง</a>";
}
?>