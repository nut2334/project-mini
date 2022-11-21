<html>
<?php
include "../connect/connectMysqli.php";
session_start();
if (!isset($_SESSION['employee_id'])) {
    echo "กรุณาเข้าสู่ระบบ";
    header("refresh:2;url=../Login/Login-form.php");
}
$is_telId = false;
$name = $_GET['cus_name'];
$realName = $_GET['cus_name'];
if ($name[0] == 't') {
    $is_telId = true;
}
if ($is_telId) {
    $sql = "SELECT cus_name FROM telephone WHERE tel_id = '$name'";
    $result = $conn->query($sql);
    $realName = mysqli_fetch_array($result)['cus_name'];
}
?>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php include "../nav/nav.php" ?>
    <link rel="stylesheet" type="text/css" href="../css/request_form.css">
</head>

<body>
    <?php
    if (isset($_SESSION['employee_id'])) {
        $employee_id = $_SESSION['employee_id'];
    ?>
        <center>
            <h1>แจ้งคำร้อง</h1>
        </center>
        <center>
            <div class="r1" style="min-height: 55vh;">
                <section>
                    <label>
                        เจ้าของคำร้อง
                    </label>
                    <?php
                    $name = $_GET['cus_name'];
                    if (isset($name)) { ?>
                        <input type="text" id="name" value="<?php echo $realName ?>" readonly disabled />
                    <?php
                    }
                    ?>
                    <div>
                        <label>
                            เครื่องที่จะซ่อม
                        </label>

                        <select name="tel_id" id="tel_id">
                            <option value="" <?php if (!$is_telId) echo "selected" ?> disabled hidden>เลือกเครื่องที่จะซ่อม</option>
                            <?php
                            $str = str_replace(" ", "%", $realName);
                            $sql = "SELECT * FROM telephone WHERE cus_name LIKE '{$str}'";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <option <?php if ($is_telId && $row['tel_id'] == $name) echo "selected" ?> value="<?php echo $row['tel_id'] ?>">
                                    <?php echo $row['tel_id'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label>
                            อาการผิดปกติ
                        </label>
                        <br />
                        <textarea id="abnormality" name="abnormality" rows="5" required></textarea>
                    </div>
                    <input type="button" value="ส่งคำร้อง" id="submit" />
                </section>
            </div>
        </center>
        <a href="../search/search.php?search-by-name-or-telid=<?= $name ?>"><input type="button" value="Back" id="bottonB" /></a>
    <?php
    }
    ?>


</body>
<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            var tel_id = document.getElementById('tel_id').value
            var abnormality = document.getElementById('abnormality').value
            if (abnormality) {
                var emp_id = "<?php echo $employee_id ?>"
                if (tel_id == "") {
                    alert("กรุณาเลือกเครื่องที่ต้องการซ่อม")
                    return
                }
                $.ajax({
                    url: "make_request.php", //ส่งไปที่ไหน
                    method: "POST",
                    data: {
                        tel_id,
                        abnormality,
                        emp_id
                    },
                    success: function(data) {
                        if (data) {
                            alert("เพิ่มคำร้องสำเร็จ")
                        }
                        console.log(data);
                    }

                })
            } else {
                alert("โปรดใส่อาการผิดปกติ")
            }



        })
    })
</script>
<footer>
    <?php include "../footer/footer2.php" ?>
</footer>

</html>