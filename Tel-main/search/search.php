<?php
include "../connect.php";
session_start();
//echo $_SESSION['is_repairman'];
?>
<html>

<head>
    <mega charset="utf-8">
</head>

<body>
    <?php
        if ($_SESSION['is_repairman']){
            ?>
        <a href='../RepairPanel/repairPanel.php'>อัพเดทสถานะการซ่อม</a>
        
            <?php 
        }
    ?>
    <?php
    if (isset($_GET["search-by-name-or-telid"])){
        
        $cus_name=$_GET["search-by-name-or-telid"];
        ?>
        <a href='../Phone/insert-phone.php?cus_name=<?=$cus_name ?>'>เพิ่มเครื่อง</a>
        <a href='../Request/request_form.php?cus_name=<?=$cus_name ?>'>เพิ่มคำร้อง</a>
    <?php
}
?>

    <div class="search">
        <form>
            <label>กรอกชื่อ-สกุล/รหัสโทรศัพท์</label><br>
            <input type="text" name="search-by-name-or-telid" 
            value='<?php 
            $value=(
            isset($_GET["search-by-name-or-telid"])) ? 
            $_GET["search-by-name-or-telid"] : "";
             echo $value;
            ?>'><br>
            <input type="submit" value="ค้นหา" class="submit-button">
        </form>
    </div>

    <?php
    if (empty($_GET)) {
    } else {
        //CASE TEL_ID
        $stmt = $pdo->prepare("SELECT customer.cus_name,telephone.tel_model,
            request.request_date,repair_detail.repair_status,
            telephone.tel_id,invoice.cost,repair_detail.finish_date,
            repair_detail.finish_date,repair_detail.finish_date,
            request.request_status 
            FROM invoice
            INNER JOIN Repair_detail
            ON invoice.repair_id = Repair_detail.repair_id
            INNER JOIN Request
            ON Repair_detail.request_id = Request.request_id
            INNER JOIN Telephone
            ON Request.tel_id = Telephone.tel_id
            INNER JOIN Customer
            ON Telephone.cus_name = Customer.cus_name
            WHERE Request.tel_id LIKE ?
            ");
        $value = $_GET["search-by-name-or-telid"];
        $stmt->bindParam(1, $value);
        $stmt->execute();
        $row = $stmt->fetch();

        $stmt2 = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model,telephone.color
            FROM telephone where cus_name like ?");
        if ($row == 0) {
            //CASE NAME
            $nameforsearch = str_replace(" ", "%", $_GET["search-by-name-or-telid"]);
            $stmt2->bindParam(1, $nameforsearch);
            $stmt2->execute();
            $check2 = $stmt2->fetch();
            if ($check2 == 0) {
                //ไม่พบ
                header("location:../Register/Register.php?name=$nameforsearch");
                echo '<meta http-equiv=refresh content=0;URL=Register.php>';
            } else { ?>
                <!-- display 1 -->
                ประวัติการซ่อม
                <!-- <center> -->
                <table border="1" class="search-table">
                    <tr>
                        <th>รหัสโทรศัพท์</th>
                        <th>รุ่นโทรศัพท์</th>
                        <th>สี</th>
                    </tr>
                    <?php while ($row2 = $stmt2->fetch()) { ?>
                        <tr>
                            <td><?= $row2["tel_id"] ?></td>
                            <td><?= $row2["tel_model"] ?></td>
                            <td><?= $row2["color"] ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <!-- </center> -->
            <?php }
        } else { ?>
            <!-- display 2 -->
            รายละเอียดการซ่อม
            <table border="1" class="search-table">
                <tr>
                    <th>ชื่อ</th>
                    <td><?= $row["cus_name"] ?></td>
                </tr>
                <tr>
                    <th>รุ่น</th>
                    <td><?= $row["tel_model"] ?></td>
                </tr>
                <tr>
                    <th>วันที่นำมาซ่อม</th>
                    <td><?= $row["request_date"] ?></td>
                </tr>
                <tr>
                    <th>สถานะของโทรศัพท์</th>
                    <td><?= $row["repair_status"] ?></td>
                </tr>
                <tr>
                    <th>รหัสโทรศัพท์</th>
                    <td><?= $row["tel_id"] ?></td>
                </tr>
                <tr>
                    <th>ราคา</th>
                    <td><?= $row["cost"] ?></td>
                </tr>
                <tr>
                    <th>วันที่ซ่อมเสร็จ</th>
                    <td><?= $row["finish_date"] ?></td>
                </tr>
                <tr>
                    <th>วันที่หมดประกัน</th>
                    <td><?= $row["finish_date"] ?></td>
                </tr>
                <tr>
                    <th>ควรมารับก่อน</th>
                    <td><?= $row["finish_date"] ?></td>
                </tr>
                <tr>
                    <th>สถานะการจ่ายเงิน</th>
                    <td><?= $row["request_status"] ?></td>
                </tr>
            </table>
            <br><br>
            <?php
            $nameforsearch = str_replace(" ", "%", $row["cus_name"]);
            $stmt2->bindParam(1, $nameforsearch);
            $stmt2->execute();
            ?>
            ประวัติการซ่อม
            <table border="1" class="search-table">
                <tr>
                    <th>รุ่นโทรศัพท์</th>
                    <th>สี</th>
                </tr>
                <?php while ($row2 = $stmt2->fetch()) { ?>
                    <tr>
                        <td><?= $row2["tel_model"] ?></td>
                        <td><?= $row2["color"] ?></td>
                    </tr>
                <?php } ?>
            </table>
    <?php }
    } ?>
</body>

</html>