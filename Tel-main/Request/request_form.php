<html>
<?php
include "../connectMysqli.php";
session_start();
if (!isset($_SESSION['employee_id'])) {
    echo "กรุณาเข้าสู่ระบบ";
    header("refresh:2;url=../Login/Login-form.php");
}

?>

<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body style="margin:0">
    <?php
    if (isset($_SESSION['employee_id'])) {
        $employee_id = $_SESSION['employee_id'];
    ?>
        <div>
            <h1>แจ้งคำร้อง</h1>
            <section>
                <label>
                    เจ้าของคำร้อง
                </label>
                <?php
                $name = $_GET['cus_name'];
                if (isset($name)) { ?>
                    <input type="text" id="name" value="<?php echo $name ?>" readonly disabled />
                <?php
                }
                ?>
                <div>
                    <label>
                        เครื่องที่จะซ่อม
                    </label>

                    <select name="tel_id" id="tel_id">
                        <option value="" selected disabled hidden>เลือกเครื่องที่จะซ่อม</option>
                        <?php
                        $str = str_replace(" ", "%", $name);
                        $sql = "SELECT * FROM telephone WHERE cus_name LIKE '{$str}'";
                        $result = $conn->query($sql);
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <option value="<?php echo $row['tel_id'] ?>">
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
                    <textarea id="abnormality" name="abnormality" rows="5"></textarea>
                </div>
                <input type="button" value="ส่งคำร้อง" id="submit"/>
            </section>
        </div>
        <a href="../search/search.php?search-by-name-or-telid=<?=$name ?>">Back</a>
    <?php
    }
    ?>



</body>
<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            var tel_id = document.getElementById('tel_id').value
            var abnormality = document.getElementById('abnormality').value
            var emp_id = "<?php echo $employee_id ?>"
            if (tel_id == "") {
                alert("กรุณาเลือกเครื่องที่ต้องการซ่อม")
                return
            }
            $.ajax({
                url: "make_request.php",
                method: "POST",
                data: {
                    tel_id,
                    abnormality,
                    emp_id
                },
                success: function(data) {
                    if (data){
                        alert("เพิ่มคำร้องสำเร็จ")
                    }
                    console.log(data);
                }

            })


        })
    })
</script>

</html>