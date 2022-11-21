<html>
<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    echo "กรุณาเข้าสู่ระบบ";
    header("refresh:2;url=../Login/Login-form.php");
}
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="utf-8">
</head>

<body>
    <?php
    if (isset($_SESSION['employee_id'])) {
        $repairman_id = $_SESSION['repairman'];
    ?>
        <h1>Repairman : <?php echo $repairman_id ?></h1>
        <div>
            <table>
                <tr>
                    <th>Repair id</th>
                    <th>Request id</th>
                    <th>Start date</th>
                    <th>Repair status</th>
                    <th>Action</th>
                </tr>
                <?php
                include "../connectMysqli.php";
                $sql = "SELECT * FROM repair_detail 
                                    WHERE repairman_id = '{$repairman_id}'
                                    AND repair_status NOT LIKE 'repaired'";
                $result = $conn->query($sql);
                $result1 = $conn->query($sql);
                $canAssign = TRUE;
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['repair_status'] == 'in progress') {
                        $canAssign = FALSE;
                    }
                }
                while ($row = mysqli_fetch_array($result1)) { ?>
                    <tr>
                        <td>
                            <?php echo $row['repair_id'] ?>
                        </td>
                        <td>
                            <?php echo $row['request_id'] ?>
                        </td>
                        <td>
                            <?php echo $row['start_date'] ?>
                        </td>
                        <td>
                            <?php echo $row['repair_status'] ?>
                        </td>
                        <td>

                            <?php
                            if ($row['repair_status'] == "awaiting") { ?>
                                <input type="button" name="repairing" value="repairing" <?php if (!$canAssign) echo 'disabled="disabled"'; ?> class="action" id="<?php echo $row['repair_id'] ?>" />
                            <?php
                                $canAssign = FALSE;
                            } else { ?>
                                <input type="button" name="repaired" value="repaired" class="action" id="<?php echo $row['repair_id'] ?>" />
                                <?php
                                if ($row['repair_status'] != "require spare part") { ?>
                                    <input type="button" name="require" value="require" class="action" id="<?php echo $row['repair_id'] ?>" />
                                <?php
                                }
                                ?>
                            <?php
                            }
                            ?>


                        </td>
                    </tr>

                <?php
                }

                ?>
            </table>
        </div>
        <a href="../search/search.php">Back</a>
    <?php
    }
    ?>

</body>
<script>
    $(document).ready(function() {
        $('.action').click(function() {
            var repair_id = $(this).attr("id");
            var action = $(this).attr("name");
            var repairman_id = "<?php echo $repairman_id ?>";
            if (action == "repaired") {
                var cost = prompt("ค่าซ่อม", "200");
                if (cost) {
                    $.ajax({
                        url: "repairUpdate.php",
                        method: "POST",
                        data: {
                            cost,
                            repair_id,
                            repairman_id,
                            action
                        },
                        success: function(data) {
                            location.reload();
                        }

                    })
                }
                return

            }

            $.ajax({
                url: "repairUpdate.php",
                method: "POST",
                data: {
                    repair_id,
                    repairman_id,
                    action
                },
                success: function(data) {
                    location.reload();
                }

            })
        })
    })
</script>

</html>



<!-- <html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="utf-8">
</head>

<body>
    <h1>hello</h1>
    <div>
        <table>
            <tr>
                <th>Repair id</th>
                <th>Request id</th>
                <th>Start date</th>
                <th>Repair status</th>
                <th>Action</th>
            </tr>
            <div id="detail"></div>
        </table>
    </div>
</body>
<script>

    $(document).ready(function() {
        // $('.action').click(function() {
        // var repair_id = $(this).attr("id");
        // var action = $(this).attr("name");
        // var repairman_id = "r001";
        console.log('tset');
        $.ajax({
            url: "gen.php",
            method: "POST",
            data: {
                repairman_id = "r001",

            },
            success: function(data) {
                $("#detail").html(data);
            }

            // })
            // gen();
        })
    })
</script>

</html> -->