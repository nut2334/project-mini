<?php 
    include "../connect/connect.php"; 
?>
<html>
    <head>
        <mega charset="utf-8">
        <?php include "../nav/nav_login.php" ?>
        <link rel="stylesheet" type="text/css" href="../css/contact.css">
        <script>
            async function getDataFromAPI() {
            let response = fetch('./contact.json').then(res => res.json())
.then(data => {
    let objectData = data.data
    for (let i = 0; i < objectData.length; i++) {
            let branch = objectData[i].branch
            let address = objectData[i].address
            let map = objectData[i].map
            let tel = objectData[i].tel
            let Table = document.getElementById('tab')
            let tr = document.createElement('tr')
            Table.appendChild(tr)

            let td1 = document.createElement('td')
            td1.innerHTML = branch
            let td2 = document.createElement('td')
            td2.innerHTML = address
            let td3 = document.createElement('td')
            td3.innerHTML = map
            let td4 = document.createElement('td')
            td4.innerHTML = tel

            tr.appendChild(td1)
            tr.appendChild(td2)
            tr.appendChild(td3)
            tr.appendChild(td4)
            }
})
            }
            getDataFromAPI()
        </script>
    </head>
    <body>
        <div id="Tb">
            <h1>สาขาทั้งหมด</h1>
            <table border="1" id="tab">
                <tr id="trr">
                    <th>สาขา</th>
                    <th>ที่อยู่</th>
                    <th>แผนที่</th>
                    <th>เบอร์ติดต่อ</th>
                </tr>
            </table>
        </div>
    </body>
    <footer>
        <?php include "../footer/footer2.php" ?>
    </footer>
</html>