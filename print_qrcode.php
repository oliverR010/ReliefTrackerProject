<?php include('db_connect.php');
include('phpqrcode/qrlib.php');
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

session_start();
if(!isset($_SESSION['login_id']))
header('location:login.php');

if(isset($_GET['tracking']))
     $id= $_GET['tracking'];
	echo $id;


$types = $conn->query("SELECT *,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) 
as caddress FROM records where tracking_id = $id ");

while($row=$types->fetch_assoc()):

    $id = $row['tracking_id'];
    $address = $row['address'];

    $id_nostring = (int)$id;
    $codeContents = $id_nostring;
    
    $tempDir = "qrcodes/";
    $fileNames = 'qr_code_'.md5($codeContents).'.png';
    $pngAbsoluteFilePath = $tempDir.$fileNames;
    $urlRelativeFilePath = $tempDir.$fileNames;
    
	$image=file_get_contents( $pngAbsoluteFilePath);
	$imagedata=base64_encode($image);
	$imgpath='<center>Barangay san isidro, Paranaque City </center><center><img style="width:250px" src="data:image/png;base64, '.$imagedata.'"> 
	<center>';
	
	$HTML = $imgpath ; 


	$filename = "qrcode";
	//Setting options
	$options=new Options();

	$options->set('enable_html5_parser',true);

	
	$dompdf=new Dompdf($options);
	$dompdf->loadHTML($HTML);
	$dompdf->setPaper('A4', 'portrait');
	
	$dompdf->render();
	$dompdf->stream($filename);


endwhile;
?>
 
<?php
?>


