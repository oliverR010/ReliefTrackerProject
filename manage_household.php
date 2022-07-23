<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM households where id= ".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k=$val;
}
}

session_start();
if(!isset($_SESSION['login_id']))
header('location:login.php');

?>
<div class="container-fluid">
	
	<form action="" id="manage-household">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<hr>
			<div class="row form-group">
				<div class="col-md-6">
					<label for="" class="control-label">Building No</label>
					<input type="text" name="address" id="address" class="form-control" cols="30" rows="2" required="" value="<?php echo isset($address) ? $address :'' ?>">
				</div>
				<div class="col-md-6">
					<label for="" class="control-label">Street</label>
					<input type="text" name="street" id="street" class="form-control" cols="30" rows="2" required="" value="<?php echo isset($street) ? $street :'' ?>">
				</div>
			
			</div>
		<hr>
		<div class="row form-group">
				<div class="col-md-6">
					<label for="" class="control-label">Baranggay</label>
					<input type="text" name="baranggay" id="baranggay" class="form-control" cols="30" rows="2" required="" value="<?php echo isset($baranggay) ? $baranggay :'' ?>">
				</div>
				<div class="col-md-6">
					<label for="" class="control-label">City</label>
					<input type="text" name="city" id="city" class="form-control" cols="30" rows="2" required="" value="<?php echo isset($city) ? $city :'' ?>">
				</div>
		</div>
		<hr>

			<div class="row form-group">
				<div class="col-md-6">
					<label for="" class="control-label">State/Province</label>
					<input type="text" name="state" id="state" class="form-control" cols="30" rows="2" required="" value="<?php echo isset($state) ? $state :'' ?>">
				</div>
				<div class="col-md-6">
					<label for="" class="control-label">Zip Code</label>
					<input type="text" name="zip_code" id="zip_code" class="form-control" cols="30" rows="2" required="" value="<?php echo isset($zip_code) ? $zip_code :'' ?>">
				</div>
			</div>
		</>
	</form>


</div>
<script>
	
	$('#manage-household').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'function.php?action=save_household',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					$('#msg').html("<div class='alert alert-danger'>Household already exist.</div>")
					end_load()

				}
			}
		})
	})
</script>