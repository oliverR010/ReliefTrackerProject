<?php
include 'db_connect.php';
include('phpqrcode/qrlib.php');
require 'assets/barcode/vendor/autoload.php';


extract($_POST);

// $generator = new Picqer\Barcode\BarcodeGeneratorPNG();

$qry = $conn->query("SELECT *,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM records where id= ".$_GET['id']);


foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
?>

<div class="container-fluid">
<div class="row">
<div class="col-lg-4">
<div class="container-fluid" id="toPrint">
	<style type="text/css">
		#bcode-field{
			width:calc(100%) ;
			align-items: center;

		}
		#bcode{
			max-height: inherit;
			max-width: inherit;
			width:calc(85%) ;
			height: 25vh;
			margin-left: auto;
			margin-right: auto;
		}
		#bcode-label {
		font-weight: 700;
		font-size: 17px;
		text-align: justify;
		text-align-last: justify;
		text-justify: inter-word;
		}
		#dfield p{
			margin: unset
		}
		#uni_modal .modal-footer{
			display: none;
		}
		#uni_modal .modal-footer.display{
			display: block;
		}
		.text-center{
			text-align:center;
		}
		
	</style>
	<div class="" id="bcode-field">
		<?php 
		$id = $tracking_id;
		$id_nostring = (int)$id;
		$codeContents = $id_nostring;

		$tempDir = "qrcodes/";
		$fileName = 'qr_code_'.md5($codeContents).'.png';
        $pngAbsoluteFilePath = $tempDir.$fileName;
        $urlRelativeFilePath = $tempDir.$fileName;

		// generating
		if (!file_exists($pngAbsoluteFilePath)) {
		    QRcode::png($codeContents, $pngAbsoluteFilePath,'L',10,5);
		} else {
			
		}
		
		// displaying
	

		?>
		<!-- <img id="bcode" src="data:image/png;base64,<?php //echo base64_encode($generator->getBarcode -->
		//($id_nostring, $generator::TYPE_CODE_128)) ?>"> -->
		<div id="bcode">
			<?php 
			echo '<img id="bcode" src="'.$urlRelativeFilePath.'" />';
			
			?>
		
			
		</div>
		<div id="bcode-label"><?php echo preg_replace('/([0-9])/s','$1 ', $tracking_id); ?></div>
	</div>
	<br>
	<div class="col-lg-12 text-center" id="dfield">
	<p><small><?php echo $caddress ?></small></p>
	</div>
</div>
</div>
<div class="col-lg-8">
	<table class="table table-bordered">
		<thead>
			<tr>
				<!-- <th class="text-center">#</th> -->
				<th class="text-center">Date</th>
				<!-- <th class="">Establishment</th> -->
				<th class="text-center">Address</th>
			
				<!-- <th class="">Temperature</th> -->
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 1;
			$tracks = $conn->query("SELECT * FROM records where address = '$address' order by address desc");
			while($row=$tracks->fetch_assoc()):
			?>
			<tr>
				
				<!-- <td class="text-center"><?php echo $i++ ?></td> -->
				<td class="text-center">
					 <p> <?php echo date("M d,Y h:i A",strtotime($row['date_created'])) ?></p>
				</td>
			
				<td class="text-center">
					 <p><?php echo $row['address'], $row['street'],  $row['baranggay'],  $row['city'],  $row['state'], $row['zip_code']  ?></p>
				</td>
			
			
			</tr>
			
		</tbody>
	</table>
</div>
</div>
</div>

<div class="modal-footer display">
	<div class="row">
		<div class="col-lg-12">
			<button class="btn btn-sm btn-secondary col-md-3 float-right " type="button" data-dismiss="modal">Close</button>
			<a href="print_qrcode.php?tracking=<?php echo $row['tracking_id']?>" class="btn btn-sm btn-success col-md-3 float-right mr-2" type="button" id="print"><i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
			<path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
			<path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
			</svg> </i> Download</a>
		</div>
	</div>
</div>
<?php endwhile; ?>
<script type="text/javascript">


	function print_current_page()
		{
		   var nw = window.open("","_blank","height=700,width=900")
		   var content = $('#toPrint').clone()
			nw.document.write(content.html())
			nw.document.close()
			nw.print()
			setTimeout(function(){
				nw.close();
			},500)
		}

		function downloads(){
			var name = $(this).data('tracking_id'); 
			alert(name);       
			if (name) {
				window.location = '/print_qrcode?id=' + name;
			}
			
			
	}
</script>