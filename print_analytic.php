<?php include('db_connect.php');

session_start();
if(!isset($_SESSION['login_id']))
header('location:login.php');

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

$types = $conn->query("SELECT * FROM relief_goods ");

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
		<th>Distributed Relief Packs</th>
		<th>Remaining Relief Packs</th>
		<th>Registered Households</th>


	</tr>";
	$records = $conn->query("SELECT * ,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM records order by caddress asc");
       
    $html .="
			<tr>
	
			
			<td>".$rowcount = mysqli_num_rows( $records )." </td>
     

       ";
	while($row=$types->fetch_assoc()){
		$html .="

       
			
			<td>". $row['no_of_relief_packs']." </td>
     
          
        
       ";
    }
  

    $households_registered = $conn->query("SELECT * ,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM households order by caddress asc");
       
    $html .="

   
			
			<td>".$rowcount = mysqli_num_rows( $households_registered )." </td>
     
          
        </tr>
       ";
  

		$html .=" </table>";



	
$filename = "analytic";

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


