<?php include('db_connect.php');
require 'dompdf/autoload.inc.php';


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
					<h2>Distributed Households</h2>
				</div>
				<div class="card">
					<div class="card-header">

						<span class="">
							<!-- <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_records">
					<i class="fa fa-plus"></i> New</button> -->
					<a href="print_records.php" download="DistributedHouseholds" ><button class="btn btn-success btn-block btn-sm col-sm-2 float-right mr-2 mt-0" type="button"  id="">
					<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
										</svg></i> PDF</button></a>
				</span>
					</div>
					<div class="card-body">
						
						<hr>
						<div class="container-fluid table-responsive">
							<table class="table table-bordered table-condensed table-hover table-striped">
								<colgroup>
									<col width="10%">
									<col width="15%">
									<col width="30%">
							
								
									<col width="20%">

							
								</cole_tgroup>
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Tracking ID</th>
										<th class="text-center">Address</th>
										<th class="text-center">Action</th>
									

									</tr>
								</thead>
								<tbody>
									<?php 

				


									$i = 1;
								$types = $conn->query("SELECT *,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM records order by caddress asc");
								while($row=$types->fetch_assoc()):
								?>
								<tr>
									<!-- <th class="text-center">
										<div class="form-check">
										 	<input class="form-check-input position-static input-lg" type="checkbox" name="checked[]" value="<?php echo $row['id'] ?>">
									 	</div>
									</th> -->
									<td class="text-center"><?php echo $i++ ?></td>
									
									<td class="text-center">
										 <p> <?php echo $row['tracking_id'] ?></p>
									</td>
									<td class="text-center">
										 <p> <?php echo $row['caddress'] ?></p>
									</td>
						
									<td class="text-center">
										<button class="btn btn-sm btn-primary view_household mt-1" style="width:80px" type="button" data-id="<?php echo $row['id'] ?>" >View</button>				
										<?php if($_SESSION['login_type'] == 1): ?>
										<button class="btn btn-sm btn-danger delete_records
										 mt-1" style="width:80px" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
										 <?php endif; ?>
									</td>
								</tr>
								<?php endwhile; ?>
								</tbody>
							</table>
						</div>
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
	$('#new_records').click(function(){
		uni_modal("New Record","manage_records.php")
	})
	
	$('.edit_records').click(function(){
		uni_modal("Edit Record","manage_records.php?id="+$(this).attr('data-id'),"mid-large")
		
	})

	$('.view_household').click(function(){
		uni_modal("Household Details","view_household.php?id="+$(this).attr('data-id'),"large")
		
	})
	
	// $('.delete_records').click(function(){
	// 	_conf("Are you sure to delete this Record?","delete_records",[$(this).attr('data-id')])
	// })

	$('.delete_records').click(function(){
		deleterec_modal("Please Confirm","manage_delrecords.php?id="+$(this).attr('data-id'))
		
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

	$('#print').click(function(){
		start_load()
		$.ajax({
			url:"print_records.php",
			method:"POST",
			data:{id:$id},
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



	$('#filter').click(function(){
		location.replace("index.php?page=records&from="+$('[name="from"]').val()+"&to="+$('[name="to"]').val())
	})

	// function delete_records($id){
	// 	start_load()
	// 	$.ajax({
	// 		url:'function.php?action=delete_records',
	// 		method:'POST',
	// 		data:{
	// 			id:$id
			
	// 		},
	// 		success:function(resp){
	// 			if(resp==1){
	// 				alert_toast("Data successfully deleted",'success')
	// 				setTimeout(function(){
	// 					location.reload()
	// 				},1500)

	// 			}
	
	// 		}
	// 	})
	// }

	

</script>