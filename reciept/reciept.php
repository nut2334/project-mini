<?php
include "../connect/connect.php";
require('./fpdf/fpdf.php');
session_start();
// echo $_POST['request'];
$date = strtotime("today");
$todaydate = date("d-m-Y", $date);
$total = 0;
$data = explode(",", $_POST['request']);

$stmt = $pdo->prepare("SELECT branch.branch_id,branch.branch_address,branch.branch_tel
FROM branch INNER JOIN employee
ON branch.branch_id = employee.branch_id
WHERE employee.employee_id LIKE ?
");
$stmt->bindParam(1, $_SESSION["employee_id"]);
$stmt->execute();
$row = $stmt->fetch();

$stmt3 = $pdo->prepare("SELECT customer.cus_name,customer.cus_tel
FROM customer JOIN telephone JOIN request JOIN repair_detail JOIN invoice
WHERE telephone.cus_name = customer.cus_name
AND request.tel_id = telephone.tel_id
AND repair_detail.request_id = request.request_id
AND invoice.repair_id = repair_detail.repair_id
AND request.request_id LIKE ?");
$stmt3->bindParam(1, $data[0]);
$stmt3->execute();
$cus = $stmt3->fetch();

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();

$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew_b.php');

$pdf->SetFont('THSarabunNew', 'B', 25);
$pdf->Cell(75, 5, '', 0, 0);
$pdf->Cell(130, 5, iconv('UTF-8', 'cp874', 'ใบเสร็จรับเงิน'), 0, 1);
$pdf->Cell(130, 5, '', 0, 1);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(140, 5, 'Technic Telephone', 0, 0);
$pdf->SetFont('THSarabunNew', 'B', 18);
$pdf->Cell(59, 5, iconv('UTF-8', 'cp874', 'รายละเอียดลูกค้า'), 0, 1);

$pdf->SetFont('THSarabunNew', '', 16);

$pdf->Cell(140, 5, iconv('UTF-8', 'cp874', 'สาขา ' . $row["branch_id"]), 0, 0);
$pdf->Cell(59, 5, '', 0, 1);

$pdf->Cell(140, 5, iconv('UTF-8', 'cp874', $row["branch_address"]), 0, 0);
$pdf->Cell(25, 5, iconv('UTF-8', 'cp874', 'คุณ' . $cus["cus_name"]), 0, 0);
$pdf->Cell(34, 5, '', 0, 1);

$pdf->Cell(140, 5, iconv('UTF-8', 'cp874', 'โทร ' . $row["branch_tel"]), 0, 0);
$pdf->Cell(25, 5, iconv('UTF-8', 'cp874', 'โทร ' . $cus["cus_tel"]), 0, 0);
$pdf->Cell(34, 5, '', 0, 1);

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, '', 0, 0);
$pdf->Cell(34, 5, '', 0, 1);

$pdf->SetFont('THSarabunNew', 'B', 16);
$pdf->Cell(140, 5, iconv('UTF-8', 'cp874', 'วันที่ออกใบเสร็จ'), 0, 0);
$pdf->SetFont('THSarabunNew', '', 16);
$pdf->Cell(25, 5, '', 0, 0);
$pdf->Cell(34, 5, '', 0, 1);

$pdf->Cell(140, 5, iconv('UTF-8', 'cp874', iconv('UTF-8', 'cp874', $todaydate)), 0, 0);

$pdf->Cell(189, 10, '', 0, 1);

$pdf->SetFont('THSarabunNew', 'B', 16);

$pdf->Cell(11, 5, iconv('UTF-8', 'cp874', 'ลำดับ'), 1, 0, 'C');
$pdf->Cell(20, 5, iconv('UTF-8', 'cp874', 'รหัสเครื่อง'), 1, 0);
$pdf->Cell(50, 5, iconv('UTF-8', 'cp874', 'รุ่นโทรศัพท์บ้าน'), 1, 0);
$pdf->Cell(54, 5, iconv('UTF-8', 'cp874', 'อาการผิดปกติของเครื่อง'), 1, 0);
$pdf->Cell(25, 5, iconv('UTF-8', 'cp874', 'วันหมดประกัน'), 1, 0);
$pdf->Cell(30, 5, iconv('UTF-8', 'cp874', 'จำนวนเงิน'), 1, 1, 'R');

$pdf->SetFont('THSarabunNew', '', 16);

for ($i = 0; $i < count($data); $i++) {
	$stmt2 = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model
	,invoice.pay_date,request.abnormality,invoice.cost
	FROM invoice JOIN repair_detail JOIN request JOIN telephone JOIN customer
	WHERE invoice.repair_id = repair_detail.repair_id
	AND repair_detail.request_id = request.request_id
	AND request.tel_id = telephone.tel_id
	AND telephone.cus_name = customer.cus_name
	AND request.request_id LIKE ?");
	$stmt2->bindParam(1, $data[$i]);
	$stmt2->execute();
	$j = 1;
	while ($row2 = $stmt2->fetch()) {
		$warranty_date = date('d-m-Y', strtotime('+1 Years', strtotime($row2["pay_date"])));
		$pdf->Cell(11, 5, iconv('UTF-8', 'cp874', $i + 1), 1, 0, 'C');
		$pdf->Cell(20, 5, iconv('UTF-8', 'cp874', $row2["tel_id"]), 1, 0);
		$pdf->Cell(50, 5, iconv('UTF-8', 'cp874', $row2["tel_model"]), 1, 0);
		$pdf->Cell(54, 5, iconv('UTF-8', 'cp874', $row2["abnormality"]), 1, 0);
		$pdf->Cell(25, 5, iconv('UTF-8', 'cp874', $warranty_date), 1, 0);
		$pdf->Cell(30, 5, iconv('UTF-8', 'cp874', $row2["cost"] . '.00'), 1, 1, 'R');
		$j++;
		$total += $row2["cost"];
	}
}

$pdf->Cell(130, 5, '', 0, 0);
$pdf->SetFont('THSarabunNew', 'B', 16);
$pdf->Cell(26, 5, iconv('UTF-8', 'cp874', 'รวม'), 0, 0);
$pdf->Cell(4, 5, iconv('UTF-8', 'cp874', '฿'), 1, 0);
$pdf->Cell(30, 5, iconv('UTF-8', 'cp874', $total . '.00'), 1, 1, 'R');

$pdf->Output();
