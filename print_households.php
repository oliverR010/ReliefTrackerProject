<?php include('db_connect.php');

session_start();
if(!isset($_SESSION['login_id']))
  header('location:login.php');


require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

$types = $conn->query("SELECT *,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM households");

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
		<th>Address</th>
		<th>Status</th>

	</tr>";

	while($row=$types->fetch_assoc()){
		$html .="

        <tr>
			
			<td><center>".$row['caddress']." </td>
			<td> <center>".$row['status']." </td>
			

          
        </tr>
       ";
	}
		$html .=" </table>";



	
$filename = "households";

// include autoloader
require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
$dompdf->stream($filename);


?>

<?php
?>


