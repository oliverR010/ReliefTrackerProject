<?php include('db_connect.php');


if(!isset($_SESSION['login_id']))
  header('location:login.php');

?>
<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}

</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="text-center mt-4 mb-4">
					<h2>List of Households</h2>
				</div>
				<div class="card">
					<div class="card-header">
						<div class="container-fluid">
						<?php if($_SESSION['login_type'] == 1): ?>
								<div class="row float-right">
									<div class="col-md ">
									<form class="" action="" method="post" enctype="multipart/form-data">
									<input type="file" name="excel" required value="">
									<button class="btn btn-sm btn-warning" type="submit" name="import">Import</button>
									</form>
									</div>
									<?php
		
									if(isset($_POST["import"])){
										$fileName = $_FILES["excel"]["name"];
										$fileExtension = explode('.', $fileName);
										$fileExtension = strtolower(end($fileExtension));
										$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

										$targetDirectory = "uploads/" . $newFileName;
										move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

										error_reporting(0);
										ini_set('display_errors', 0);

										require 'excelReader/excel_reader2.php';
										require 'excelReader/SpreadsheetReader.php';

										$reader = new SpreadsheetReader($targetDirectory);
										foreach($reader as $key => $row){
											$address = $row[0];
											$street = $row[1];
											$baranggay = $row[2];
											$city = $row[3];
											$state = $row[4];
											$zip_code = $row[5];
											$status = $row[6];
											
											mysqli_query($conn, "INSERT INTO households VALUES('', '$address', '$street', '$baranggay', '$city', '$state', '$zip_code', '$status')");
										}

										echo
										"
										<script>
										alert('Succesfully Imported');
										document.location.href = '';
										</script>
										";
									}
									?>
								</div>	
							<div class="row">
								<div class="col-md text-center>
									
										<span class="">
		
                               
										<button class="btn btn-primary btn-sm ml-2 mb-1 float-right"  type="button" id="new_household">
										<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
										<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
										
									</svg></i> Add Household</button>
										<!-- <a href="print_household.php" class="btn btn-success  btn-sm float-right"  type="button" id="print_selected" style="width:100px"> -->
										<?php endif; ?>
										<a href="print_households.php" class="btn btn-success  btn-sm float-right" style="width:100px">
										<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
										</svg></i> PDF</a>
									</span>
									
								</div>
							</div>
						</div>	
					</div>
					<div class="card-body table-responsive">
					<table class="table  table-bordered table-condensed table-hover table-striped">
					<colgroup>
									<col width="10%">
									<col width="10%">
									<col width="30%">
									
                                    <?php if($_SESSION['login_type'] == 1): ?>
									<col width="20%">
									<?php endif; ?>

							
								</cole_tgroup>
						<thead>
							
								<tr>
									<!-- <th class="text-center">
										 <div class="form-check">
										  <input class="form-check-input position-static" type="checkbox" id="check_all"  aria-label="...">
										</div>
									</th> -->
									<th class="text-center">Distribute</th>
									<th class="text-center">#</th>
									<th class="text-center">Address</th>
									<?php if($_SESSION['login_type'] == 1): ?>
									<th class="text-center">Action</th>
									<?php endif; ?>
								</tr>	
							</thead>
							<tbody>

								<?php 
								$i = 1;
								$types = $conn->query("SELECT * ,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM households order by caddress asc");
								
								while($row=$types->fetch_assoc()):
								?>
								<tr>
									<!-- <th class="text-center">
										<div class="form-check">
										 	<input class="form-check-input position-static input-lg" type="checkbox" name="checked[]" value="<?php echo $row['id'] ?>">
									 	</div>
									</th>
								 -->
									<?php 
									// $types1 = $conn->query("SELECT * ,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM records order by caddress asc");

									// while($row1=$types->fetch_assoc()):

											if($row['status'] =="Pending"){

										?>

												<td class="text-center">
													
												<button class="btn btn-sm btn-warning distribute_done mt-1" style="width:80px" id="done" type="button" data-id="<?php echo $row['id'] ?>" ><i class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
												<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
												</svg></i></button>
												</td>
												
												<?php  }
									if($row['status'] =="Success"){?>
											
											<td class="text-center">
											<p>Done</p>
											</td>
									<?php  }?>
									<td class="text-center"><?php echo $i++ ?></td>
									<!-- <td class="">
										<?php echo $row['tracking_id'] ?>
									</td> -->
			
									<td class="text-center">
										 <p> <?php echo $row['caddress'] ?></p>
									</td>
									<?php if($_SESSION['login_type'] == 1): ?>
									<td class="text-center">
							
										<button class="btn btn-sm btn-success edit_household mt-1" style="width:80px" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
					
	
										<button class="btn btn-sm btn-danger delete_household
										 mt-1" style="width:80px" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									
									</td>
									<?php endif; ?>
								</tr>
							
							<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	
	$('#new_household').click(function(){
		uni_modal("New household","manage_household.php","mid-large")
	})

	
	$('.distribute_done').click(function(){
		distribute_modal("Verify Address","manage_distribute.php?id="+$(this).attr('data-id'))
	})

	$('.edit_household').click(function(){
		uni_modal("Edit Household","manage_household.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.view_household').click(function(){
		uni_modal("Household Details","view_household.php?id="+$(this).attr('data-id'),"large")
		
	})
	
	$('.delete_household').click(function(){
		_conf("Are you sure to delete this household?","delete_household",[$(this).attr('data-id')])
	})
	
	$('#check_all').click(function(){
		if($(this).prop('checked') == true)
			$('[name="checked[]"]').prop('checked',true)
		else
			$('[name="checked[]"]').prop('checked',false)
	})

	$('[name="checked[]"]').click(function(){
		var count = $('[name="checked[]"]').length
		var checked = $('[name="checked[]"]:checked').length
		if(count == checked)
			$('#check_all').prop('checked',true)
		else
			$('#check_all').prop('checked',false)
	})

	$('#print_selected').click(function(){
		var checked = $('[name="checked[]"]:checked').length
		if(checked <= 0){
			alert_toast("Check atleast one individual details row first.","danger")
			return false;
		}
		var ids = [];
		$('[name="checked[]"]:checked').each(function(){
			ids.push($(this).val())
		})

		start_load()
		$.ajax({
			url:"print_households.php",
			method:"POST",
			data:{ids : ids},
			success:function(resp){
				if(resp){
					var nw = window.open("","_blank","height=600,width=900")
					nw.document.write(resp)
					nw.document.close()
					nw.print()
					setTimeout(function(){
						nw.close()
						end_load()
					},700)
				}
			}
		})
	})
	
	function delete_household($id){
		start_load()
		$.ajax({
			url:'function.php?action=delete_household',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("household successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}


	
</script>