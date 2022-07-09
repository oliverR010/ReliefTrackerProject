<?php include('db_connect.php');?>
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
							<div class="row">
								<div class="col-md text-center>
									<span class="">
										<button class="btn btn-primary btn-sm ml-2 mb-1 float-right"  type="button" id="new_household">
										<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
										<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
										</svg></i> Add Household</button>
										<button class="btn btn-success  btn-sm float-right"  type="button" id="print_selected">
										<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
										<path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
										<path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
										</svg></i> Print Selected</button>
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
									<col width="20%">
							

							
								</cole_tgroup>
						<thead>
							
								<tr>
									<th class="text-center">
										 <div class="form-check">
										  <input class="form-check-input position-static" type="checkbox" id="check_all"  aria-label="...">
										</div>
									</th>
									<th class="text-center">Distribute</th>
									<th class="text-center">#</th>
									<th class="text-center">Address</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>

								<?php 
								$i = 1;
								$types = $conn->query("SELECT * ,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM households order by caddress asc");
								
								while($row=$types->fetch_assoc()):
								?>
								<tr>
									<th class="text-center">
										<div class="form-check">
										 	<input class="form-check-input position-static input-lg" type="checkbox" name="checked[]" value="<?php echo $row['id'] ?>">
									 	</div>
									</th>
								
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
									<td class="text-center">
										
										<button class="btn btn-sm btn-success edit_household mt-1" style="width:80px" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_household
										 mt-1" style="width:80px" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
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