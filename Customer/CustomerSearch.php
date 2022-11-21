<?php 
    include "../connect/connect.php"; 
?>
<html>
    <head>
        
        <link rel="stylesheet" type="text/css" href="../css/CustomerSearch.css">
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <header>
        <?php include "../nav/nav_login.php" ?>
    </header>
    <div class="cus_search">
        <div class="search">
        <form>
            <label><b style="font-size: 30px; margin-bottom: 10px;">กรอกชื่อ-สกุล/รหัสโทรศัพท์</b></label><br>
            <input pattern="^([ก-๏]|tel).*" type="text" name="search-by-name-or-telid" style="text-align:center" required value='<?php
                $value = (isset($_GET["search-by-name-or-telid"])) ?
                    $_GET["search-by-name-or-telid"] : "";
                echo $value;
                ?>'><br>
            <input type="submit" value="ค้นหา" class="submit-button">
        </form>
        </div>
        
        <?php
        if(empty($_GET)){
        }
        else{
            $stmt = $pdo->prepare("SELECT customer.cus_name,telephone.tel_model,
            request.request_date,repair_detail.repair_status,
            telephone.tel_id,invoice.cost,repair_detail.finish_date,
            repair_detail.finish_date,repair_detail.finish_date,
            invoice.payment_status,invoice.pay_date 
            FROM invoice INNER JOIN Repair_detail JOIN Request JOIN Telephone JOIN Customer
            WHERE invoice.repair_id = Repair_detail.repair_id 
            AND Repair_detail.request_id = Request.request_id 
            AND Request.tel_id = Telephone.tel_id 
            AND Telephone.cus_name = Customer.cus_name
            AND Request.tel_id LIKE ?
            ORDER BY Request.request_id DESC;
            ");
            $stmt->bindParam(1,$_GET["search-by-name-or-telid"]);
            $stmt->execute();

            $stmt2 = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model,telephone.color
            FROM telephone where cus_name like ?"); 
            $check=0;
            ?>
            <div class="content">
            <?php while($row = $stmt->fetch()){
            if($check==0){ ?>
                 <b>รายละเอียดการซ่อมของโทรศัพท์ <?=$_GET["search-by-name-or-telid"]?></b><br><br>
            <?php } 
            $check=1;
            $nameforsearch = str_replace(" ","%",$row["cus_name"]);
            if(!$row["finish_date"]){
                $warranty_date='';
                $pick_up_before_date='';
            }else{
                $warranty_date=date('Y-m-d', strtotime('+3 months',strtotime($row["pay_date"])));
                $pick_up_before_date=date('Y-m-d', strtotime('+1 years',strtotime($row["finish_date"])));
            }
            switch ($row["repair_status"]) {
                case 'repaired':
                    $row["repair_status"] = 'ซ่อมสำเร็จ';
                    break;
                case 'require spare part':
                    $row["repair_status"] = 'กำลังจัดหาอะไหล่';
                    break;
                case 'repaired in progress':
                    $row["repair_status"] = 'อยู่ระหว่างการซ่อม';
                    break;
            }
            switch ($row["payment_status"]) {
                case 'awaiting':
                    $row["payment_status"] = 'อยู่ระหว่างการซ่อม';
                    break;
                case 'pending':
                    $row["payment_status"] = 'รอชําระเงิน';
                    break;
                case 'completed':
                    $row["payment_status"] = 'ชำระเงินสําเร็จ';
                    break;
            }
            ?>
            <table border="1" class="search-table">
            <tr>
                <th>ชื่อ</th>
                <td><?=$row["cus_name"]?></td>
            </tr>
            <tr>
                <th>รุ่น</th>
                <td><?=$row["tel_model"]?></td>
            </tr>
            <tr>
                <th>วันที่นำมาซ่อม</th>
                <td><?=$row["request_date"]?></td>
            </tr>
            <tr>
                <th>สถานะของโทรศัพท์</th>
                <td><?=$row["repair_status"]?></td>
            </tr>
            <?php if ($row["finish_date"]) { ?>
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
                    <td><?= $warranty_date ?></td>
                </tr>
                <tr>
                    <th>ควรมารับก่อน</th>
                    <td><?= $pick_up_before_date ?></td>
                </tr>
            <?php } ?>
                <th>สถานะการจ่ายเงิน</th>
                <td><?=$row["payment_status"]?></td>
            </tr>
            </table>
            <br><img src="../img/screwdriver.png"><img src="../img/screwdriver.png"><img src="../img/screwdriver.png"><br>
            <?php } ?>
            <?php
            if($check==0){
                $nameforsearch = str_replace(" ","%",$_GET["search-by-name-or-telid"]);
            }
            $stmt2->bindParam(1, $nameforsearch);
            $stmt2->execute();
            $nameforsearch = str_replace("%"," ",$nameforsearch);
            
            ?>
            <?php while($row2 = $stmt2->fetch()){
            if($check==0||$check==1){ ?>
                <b style="font-size: 25px;">คุณ<?=$nameforsearch?></b><br><br>
                <?php $nameforsearch = str_replace(" ","%",$nameforsearch);
                $stmt3 = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model,telephone.color,
                invoice.payment_status,request.abnormality,invoice.cost
                FROM invoice INNER JOIN Repair_detail JOIN Request JOIN Telephone JOIN Customer
                WHERE invoice.repair_id = Repair_detail.repair_id 
                AND Repair_detail.request_id = Request.request_id 
                AND Request.tel_id = Telephone.tel_id 
                AND Telephone.cus_name = Customer.cus_name
                AND invoice.payment_status = 'pending'
                AND Customer.cus_name LIKE ?
                ");
                $stmt3->bindParam(1,$nameforsearch);
                $stmt3->execute();
                $total=0;
                $reciept=0;
                while($row3 = $stmt3->fetch()){
                if($reciept==0){ ?>
                    <b>โทรศัพท์ที่ค้างชำระ</b><br>
                    <table border="1" class="search-table">
                    <tr>
                        <th>รหัสโทรศัพท์</th>
                        <th>รุ่นโทรศัพท์</th>
                        <th>สี</th>
                        <th>อาการผิดปกติ</th>
                        <th>ราคา</th>
                    </tr>
                <?php }
                $reciept=1;?>
                    <tr>
                        <td><?=$row3["tel_id"]?></td>
                        <td><?=$row3["tel_model"]?></td>
                        <td><?=$row3["color"]?></td>
                        <td><?=$row3["abnormality"]?></td>
                        <td align="right"><?=$row3["cost"]?>.00</td>
                    </tr>
                    <?php $total+=$row3["cost"]; }
                    if($reciept==1){ ?>
                    <tr>
                        <td align="center" colspan="4">รวม</td>
                        <td align="right"><?=$total?>.00</td>
                    </tr>
                    <?php }?>
                </table><br>
                <b>โทรศัพท์ที่เคยลงทะเบียนกับทางร้าน</b><br>
                <table border="1" class="search-table">
                    <tr>
                        <th>รหัสโทรศัพท์</th>
                        <th>รุ่นโทรศัพท์</th>
                        <th>สี</th>
                    </tr>                                  
            <?php }  
            $check=2; ?>
            <tr>
                <td><a href="CustomerSearch.php?search-by-name-or-telid=<?= $row2["tel_id"] ?>"><?= $row2["tel_id"] ?></a></td>
                <td><?= $row2["tel_model"] ?></td>
                <td><?= $row2["color"] ?></td>
            </tr>
            <?php } ?>
            </table>
            <?php if($check==0){
                echo "ไม่พบข้อมูล";
            }
        } ?>
        </div>
            
    </div>
    </body>

    <?php include "../footer/footer2.php"?>
</html>
