<?php include('db_connect.php');
session_start();
if(!isset($_SESSION['login_id']))
header('location:login.php');
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

$types = $conn->query("SELECT *,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM records order by caddress asc");

	$html="
	<style>
	*{
		padding:0px;
		margin-left:10px;
		margin-right:20px;
		margin-top:10px;
		

	}

	@page title-page {
		margins: 75pt 30pt 50pt 30pt;
		background-color: red;
	  }

	table{
		border: 1px solid;

		width:100%;
		border-collapse:collapse;
		text-align: center
	}
	tr,td{
		padding: 5px;
	}
	th {
		padding: 10px;
	}
	.text-center{
		text-align: center
	}

</style>
	<table border='1' width='100%' style='border-collapse: collapse;'>";

		$html.="<tr>
		<th>Tracking_ID</th>
		<th>Address</th>
		<th>Status</th>
		<th>Date Distributed</th>

	</tr>";

	while($row=$types->fetch_assoc()){
		$html .="

        <tr>
			
			<td>".$row['tracking_id']." </td>
			<td>".$row['caddress']." </td>
			<td>".$row['status']." </td>
			<td>".date("M d,Y h:i A",strtotime($row['date_created']))." </td>


          
        </tr>
       ";
	}
		$html .=" </table>";



	
$filename = "records";

// include autoloader
require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
$dompdf->stream($filename,array("Attachment"=>0));


?>

<?php
?>


