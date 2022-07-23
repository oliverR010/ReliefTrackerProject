<?php include 'db_connect.php' ?>
<?php

session_start();
if(!isset($_SESSION['login_id']))
header('location:login.php');

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM relief_goods where id= ".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k=$val;
}
}


?>
<div class="container-fluid">
	
	<form action="" id="manage-reliefpacks">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<hr>
			<div class="row form-group">
				<div class="col-md-12">
					<label for="" class="control-label">Enter Amount of Relif Packs</label>
					<input type="text" name="no_of_relief_packs" id="no_of_relief_packs" class="form-control" cols="30" rows="2" required="" value="<?php echo isset($no_of_relief_packs) ? $no_of_relief_packs :'' ?>">
				</div>
			
			</div>
		<hr>
	
		</>
	</form>


</div>
<script>
	
	$('#manage-reliefpacks').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'function.php?action=save_reliefpacks',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Relif Packs successfully saved",'success')
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