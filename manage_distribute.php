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
	
	<form action="" id="manage-distribute">
    <input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<!-- <div class="row form-group" hidden>
			<div class="col-md-4">
				<label for="" class="control-label">Last Name</label>
				<input type="text" class="form-control" name="lastname"  value="<?php echo isset($lastname) ? $lastname :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">First Name</label>
				<input type="text" class="form-control" name="firstname"  value="<?php echo isset($firstname) ? $firstname :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">Middle Name</label>
				<input type="text" class="form-control" name="middlename"  value="<?php echo isset($middlename) ? $middlename :'' ?>" required>
			</div>
		</div> -->
		<hr hidden>
			<div class="row form-group"  >
				<div class="col-md-12">
					<Strong for="" class="control-label text-center" b>Address</Strong>
					<p class=""><?php echo isset($address) ? $address :''?>, <?php echo isset($street) ? $street :'' ?>, <?php echo isset($street) ? $street :'' ?>, <?php echo isset($baranggay) ? $baranggay :'' ?>, <?php echo isset($city) ? $city :'' ?>, <?php echo isset($state) ? $state :'' ?>, <?php echo isset($zip_code) ? $zip_code :'' ?></p>
					
					<textarea name="address" id="address" class="form-control " hidden cols="30" rows="2" required=""><?php echo isset($address) ? $address :'' ?></textarea>
				</div>
				<div class="col-md-4" hidden>
					<label for="" class="control-label">Street</label>
					<textarea name="street" id="street" class="form-control" cols="30" rows="2" required=""><?php echo isset($street) ? $street :'' ?></textarea>
				</div>
				<div class="col-md-4" hidden>
					<label for="" class="control-label">Baranggay</label>
					<textarea name="baranggay" id="baranggay" class="form-control" cols="30" rows="2" required=""><?php echo isset($baranggay) ? $baranggay :'' ?></textarea>
				</div>
			</div>
		<hr>

			<div class="row form-group" hidden>
				<div class="col-md-4">
					<label for="" class="control-label">City</label>
					<textarea name="city" id="city" class="form-control" cols="30" rows="2" required=""><?php echo isset($city) ? $city :'' ?></textarea>
				</div>
				<div class="col-md-4" hidden>
					<label for="" class="control-label">State/Province</label>
					<textarea name="state" id="state" class="form-control" cols="30" rows="2" required=""><?php echo isset($state) ? $state :'' ?></textarea>
				</div>
				<div class="col-md-4" hidden>
					<label for="" class="control-label">Zip Code</label>
					<textarea name="zip_code" id="zip_code" class="form-control" cols="30" rows="2" required=""><?php echo isset($zip_code) ? $zip_code :'' ?></textarea>
				</div>
			</div>
		</>
	</form>


</div>
<script>
	
	$('#manage-distribute').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'function.php?action=save_distribute',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Successfully Distributed",'success')
					
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