<html>
    <head>
        <?php include "../nav/nav_login.php" ?>
		<link rel="stylesheet" type="text/css" href="../css/login.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <script>
            var httpRequest;
            function send(){
                
                httpRequest = new XMLHttpRequest();
                httpRequest.onreadystatechange = show;

                var employee_id = document.getElementById("employee_id").value;
                console.log(employee_id);
                var emp_tel = document.getElementById("emp_tel").value;
                var url = "login-check.php";
                var value="employee_id="+employee_id+"&emp_tel="+emp_tel;
                
                if(employee_id!= "" && emp_tel != ""){
                    httpRequest.open("POST",url,true);
                    httpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    httpRequest.send(value);
                }
                else{
                    document.getElementById("show").innerHTML = "";
                }
            }
            function show(){
                if(httpRequest.readyState==4 && httpRequest.status==200){
                    if(httpRequest.responseText=="ไม่สำเร็จ ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง"){
                        document.getElementById("show").innerHTML = httpRequest.responseText;
                    }
                    else{
                        //document.getElementById("show").innerHTML = httpRequest.responseText;
                        location.href='../search/search.php';
                    }
                }
            }
        </script>
    </head>
    <body>
		<div class="center">
		<div class="bg">

            <b>LOG IN</b><br>
			<i class="fa-solid fa-user"></i>
            
            <input type="text" id="employee_id" placeholder="Username" class="input"><br>
			<i class="fa-solid fa-lock"></i>
            <input type="password" id="emp_tel" placeholder="Password" class="input"><br>
            <p id="show"></p>
            <input type="button" value="Login" class="button" align="center" onclick=send()>
            
		</div>
</div>
    </body>
    <?php include "../footer/footer.php"?>
</html>