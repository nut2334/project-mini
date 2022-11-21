<?php
include "../connect/connect.php";
session_start(); ?>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <?php include "../nav/nav.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/reciptprint.css">
</head>

<body>
    <?php
    $stmt4 = $pdo->prepare("SELECT customer.cus_name,telephone.tel_model,
            request.request_date,repair_detail.repair_status,
            telephone.tel_id,invoice.cost,repair_detail.finish_date,
            repair_detail.finish_date,repair_detail.finish_date,
            request.request_status,request.request_id,invoice.pay_date
            FROM invoice INNER JOIN Repair_detail JOIN Request JOIN Telephone JOIN Customer
            WHERE invoice.repair_id = Repair_detail.repair_id 
            AND Repair_detail.request_id = Request.request_id 
            AND Request.tel_id = Telephone.tel_id 
            AND Telephone.cus_name = Customer.cus_name
            AND customer.cus_name LIKE ?
            AND invoice.payment_status = 'completed'
            ORDER BY Request.request_id DESC;
            ");
    $stmt4->bindParam(1, $_GET["name"]);
    $stmt4->execute(); ?>
    <div style="min-height: 75vh;">
        <h1>ใบเสร็จรับเงิน</h1>
        <div class="p1">
            <?php
            if ($stmt4->rowCount() > 0) { ?>

                <b id="CusName">คุณ <?= $_GET["name"] ?></b><br>
                <b><u>เลือกโทรศัพท์ที่ต้องการพิมพ์ใบเสร็จ</u></b><br>
                <div class="tel-checkbox">
                    <?php
                    while ($row4 = $stmt4->fetch()) {
                        if ($row4["pay_date"]) {
                            $row4["pay_date"] = date('d-m-Y', strtotime($row4["pay_date"]));
                        }
                    ?>
                        <input type="checkbox" id="print" onclick="addDelete('<?= $row4['request_id'] ?>');" name="print" value="<?= $row4["request_id"] ?>">
                        <?= $row4["request_id"] ?> รหัสโทรศัพท์ <?= $row4["tel_id"] ?> รุ่น <?= $row4["tel_model"] ?> ราคา <?= $row4["cost"] ?> บาท - วันที่จ่าย <?= $row4["pay_date"] ?><br>
                        <br>
                    <?php }
                    ?>
                </div>
                <button id="submit">พิมพ์ใบเสร็จรับเงิน</button><br>
            <?php
            } else { ?>
                <h2>ไม่พบข้อมูล</h2>
            <?php
            }
            ?>
        </div>

        <a href="../search/search.php?search-by-name-or-telid=<?= $_GET["name"] ?>"><input type="button" value="Back" id="bottonB" /></a>
    </div>

</body>
<script>
    let requestArr = [];

    function addDelete(requestId) {
        if (!requestArr.includes(requestId)) {
            requestArr.push(requestId)
        } else {
            var index = requestArr.indexOf(requestId);
            if (index !== -1) {
                requestArr.splice(index, 1);
            }
        }
    }

    $(document).ready(function() {
        $('#submit').click(function() {
            if (requestArr.length > 0) {
                var url = 'reciept.php';
                var form = $('<form style="display: none;" target="_blank" action="' + url + '" method="post">' +
                    '<input type="text" name="request" value="' + requestArr + '" />' +
                    '</form>');
                $('body').append(form);
                form.submit();
            } else {
                alert("กรุณาเลือกใบเสร็จที่จะพิมพ์")
            }

        })
    })
</script>
<footer>
    <?php include "../footer/footer2.php" ?>
</footer>

</html>