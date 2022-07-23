<?php include('db_connect.php');

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM relief_goods where id= ".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k=$val;
}
}

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

*{
	padding:0px;
	margin:0px;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Analytic</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
	

	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
                <div class="text-center mt-5 mb-4 card-header">
					<h2>Analytics</h2>
				</div>
			</div>
		</div>
		<div class="row row-cols-12 row-cols-md-12 g-1 ">
			<?php
			$types = $conn->query("SELECT * FROM relief_goods ");
								
			while($row=$types->fetch_assoc()):
		
			?>
			<?php
			
			?>

			<div class="">
			<button class="btn btn-sm btn-primary float-right mr-4 edit_reliefgoods" style="max-width:200px" data-id="<?php echo $row['id'] ?>">Add Relief Goods</button>
			</div>
			<?php endwhile;?>
		</div>
        <div class="container-fluid mt-5">
		<div class="row row-cols-1 row-cols-md-3 g-1">
            <div class="col">
                <div class="card text-bg-primary mb-3" style="max-width: 35rem; height: 12rem;">
                <div class="card-header text-center">Total No. of Distributed Relief Packs</div>
                <div class="card-body">
            
                    <p class="card-text">
					<?php
						$i = 1;
						$addAll = 0;
						$types = $conn->query("SELECT * ,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM records order by caddress asc");
								
						while($row=$types->fetch_assoc()):
						  $addAll+=(int)$row['reliefpacks']
						?>
						<?php
						endwhile;?>
			
						<p class="card-text"><h2><center> <?php echo  $addAll?></center></h2> </p>
					
					
					
					
					</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-warning mb-3" style="max-width: 35rem; height: 12rem;">
                <div class="card-header text-center">Total No. of Relief Packs</div>
                <div class="card-body">
						<?php

						$types = $conn->query("SELECT * FROM relief_goods");
						    while($row=$types->fetch_assoc()):
								$nopacks = $row['no_of_relief_packs']
							?>		
							
							<p class="card-text"><h2><center> <?php echo $row['no_of_relief_packs'] ?></h2></center></p>
						<?php endwhile;
						?>
					
                </div>
                </div>
            </div>
            <div class="col">

						<?php $households_registered = $conn->query("SELECT * ,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM households order by caddress asc");
						 ?>
                <div class="card text-bg-info mb-3" style="max-width: 35rem; height: 12rem;">
                    <div class="card-header text-center">No. of Reggistered Households</div>
                    <div class="card-body">
					
					<p class="card-text"><h2><center> <?php echo $rowcount = mysqli_num_rows( $households_registered ); ?></h2></center></p>

					
                </div>
                </div>   
            </div>

            
		</div>
      
	</div>
    
		<div class="row row-cols-12 row-cols-md-12 g-1">
            <div class="col-12">
                <div class="card mb-3 mt-3 " style="max-width:850px; margin: auto;">
                <div class="card-header text-center">Distributed and Undistributed Relief Packs</div>
                <div class="card-body ">

					<div>
					<canvas id="pieChart"  style="height:41vh; width:20vw" ></canvas>
					</div>

					<script>
					const data = {
						labels: [
							'Distributed',
							'Unistributed'
						],
						datasets: [{
							label: 'My First Dataset',
							data: [<?php echo $addAll ?>,<?php echo $nopacks?>],
							backgroundColor: [
							'rgb(54, 162, 235)',
							'rgb(255, 205, 86)'
							],
							hoverOffset: 4
						}]
						};

						const configs = {
						type: 'pie',
						data: data,
						};

					const myChart = new Chart(
						document.getElementById('pieChart'),
						configs
					);
					
					
					</script>
                </div>
                </div>
            </div>
        </div>	 
		<div class="row row-cols-12 row-cols-md-12 g-1">
            <div class="col-12">
                <div class="card mb-3 mt-3 " style="max-width:850px; margin: auto;">
                <div class="card-header text-center">Total Number of Relief Packs</div>
                <div class="card-body ">

				</script>
                    <canvas id="barChart"  style="height:41vh; width:20vw" ></canvas>
					</div>

					<script>
					const labels1 = ['2022'];
					const data1 = {
					labels: labels1,
					datasets: [{
						label: 'number of relief packs',
						data: [<?php echo (int)$nopacks+$addAll?>],
						backgroundColor: [
						'rgba(255, 159, 64, 0.2)',
						'rgba(255, 205, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(201, 203, 207, 0.2)'
						],
						borderColor: [
						'rgb(255, 99, 132)',
						'rgb(255, 159, 64)',
						'rgb(255, 205, 86)',
						'rgb(75, 192, 192)',
						'rgb(54, 162, 235)',
						'rgb(153, 102, 255)',
						'rgb(201, 203, 207)'
						],
						borderWidth: 1
					}]
					};
					const config1 = {
					type: 'bar',
					data: data1,
					options: {
						scales: {
						y: {
							beginAtZero: true
						}
						}
					},
					};
					const barChart = new Chart(
						document.getElementById('barChart'),
						config1
					);
							
                    </script>
                </div>
                </div>
            </div>
        </div>	

		<div class="row row-cols-12 row-cols-md-12 g-1">
            <div class="col-12">
                <div class="card mb-3 mt-3 " style="max-width:850px; margin: auto;">
                <div class="card-header text-center">Total Number of Registered Households</div>
                <div class="card-body ">

				</script>
                    <canvas id="barChart2"  style="height:41vh; width:20vw" ></canvas>
					</div>

					<script>
					const labels2 = ['2022'];
					const data2 = {
					labels: labels2,
					datasets: [{
						label: 'reguistered households',
						data: [<?php echo $rowcount ?>, 25],
						backgroundColor: [
					
						'rgba(75, 192, 192, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(201, 203, 207, 0.2)'
						],
						borderColor: [
						'rgb(75, 192, 192)',
						'rgb(54, 162, 235)',
						'rgb(153, 102, 255)',
						'rgb(201, 203, 207)'
						],
						borderWidth: 1
					}]
					};
					const config2 = {
					type: 'bar',
					data: data2,
					options: {
						scales: {
						y: {
							beginAtZero: true
						}
						}
					},
					};
					const barChart2 = new Chart(
						document.getElementById('barChart2'),
						config2
					);
							
                    </script>
                </div>
                </div>
            </div>
        </div>	
</div>
   

</div>

</body>
</html>
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

	$('.edit_reliefgoods').click(function(){
		uni_modal("Edit Record","manage_goods.php?id="+$(this).attr('data-id'),"mid-large")
		
	})

	$('.view_household').click(function(){
		uni_modal("Household Details","view_household.php?id="+$(this).attr('data-id'),"large")
		
	})
	
	// $('.delete_records').click(function(){
	// 	_conf("Are you sure to delete this Record?","delete_records",[$(this).attr('data-id')])
	// })

	$('.delete_records').click(function(){
		deleterec_modal("Please Confirm","manage_delrecords.php?id="+$(this).attr('data-id'),"mid-large")
		
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

	$('#no_of_relief_packs').click(function(){
		uni_modal("Add Relief Goods","manage_goods.php")
	})
	
	

</script>