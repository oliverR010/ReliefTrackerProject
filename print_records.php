<?php include('db_connect.php');

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

$types = $conn->query("SELECT *,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM records order by caddress asc");
while($row=$types->fetch_assoc()):

$html = "

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

<table border='1' width='100%' style='border-collapse: collapse;'>
        <tr>
            <th>Username</th><th>Email</th>
            <th>Username</th><th>Email</th>

        </tr>
        <tr>
			

			<td>".$row['tracking_id']." </td>
			<td>".$row['address']." </td>
			<td>".$row['tracking_id']." </td>
			<td>".$row['tracking_id']." </td>

          
        </tr>
       
        </table>";
$filename = "newpdffile";

// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace


// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($filename,array("Attachment"=>0));

endwhile;
?>

<?php
?>


