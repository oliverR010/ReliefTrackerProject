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

*{
	padding:0px;
	margin:0px;
}
</style>


	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
                <div class="text-center mt-5 mb-3">
					<h2>Analytics</h2>
				</div>
			</div>
		</div>
        <div class="container-fluid mt-5">
		<div class="row row-cols-1 row-cols-md-3 g-1">
            <div class="col">
                <div class="card text-bg-primary mb-3" style="max-width: 35rem; height: 12rem;">
                <div class="card-header text-center">Total No. of Distributed Goods</div>
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
                <div class="card-header text-center">No of Distributed Relief Goods</div>
                <div class="card-body">
                    <p class="card-text"><h2><center> <?php echo $rowcount = mysqli_num_rows( $types ); ?></h2></center></p>
                </div>
                </div>
            </div>
            <div class="col">

						<?php $households_registered = $conn->query("SELECT * ,concat(address,', ',street,', ',baranggay,', ',city,', ',state,', ',zip_code) as caddress FROM households order by caddress asc");
						 ?>
                <div class="card text-bg-info mb-3" style="max-width: 35rem; height: 12rem;">
                    <div class="card-header text-center">No. of Registered Households</div>
                    <div class="card-body">
                       
					<p class="card-text"><h2><center> <?php echo $rowcount = mysqli_num_rows( $households_registered ); ?></h2></center></p>
                </div>
                </div>   
            </div>

            
		</div>
      
	</div>
    <div class="row row-cols-12 row-cols-md-12 g-1">
            <div class="col-12">
                <div class="card text-bg-primary mb-3 mt-3" style="max-width: 500rem;max-height:100rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, laborum nulla! Dignissimos, magni cupiditate eveniet architecto harum quae eius, voluptatum hic asperiores amet tempora quaerat sunt, nobis ipsum. Maiores, magni! Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque nemo quae distinctio, unde possimus quaerat quasi eum. Cumque minima, necessitatibus voluptatum voluptatibus ex quidem, repudiandae totam earum repellendus placeat laboriosam.</p>
                   

                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                </div>
                </div>
            </div>
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

	

</script>