<?php include '../includes/header.php'; ?>
<?php include '../includes/connect_db.php'; ?>


<?php
if (isset($_POST['submit'])){
     $event_name = $_POST['event_name'];
     $location   = $_POST['location'];
     $start_date = $_POST['start_date'];
     $end_date   = $_POST['end_date'];
     $start_time = $_POST['start_time'];
     $end_time   = $_POST['end_time'];
     $event_desc = $_POST['event_desc'];
	
	if($_FILES['event_image']['error'] == 0){
		$tmp_name = $_FILES['event_image']['tmp_name'];
		$name     = time()."-".$_FILES['event_image']['name'];
		$path     = "../images/event/";
		move_uploaded_file($tmp_name,$path.$name);
		$event_image = $name;
		$query="INSERT INTO `event`(`event_name`,`location`, `start_date`, `end_date`, `start_time`, `end_time`, `event_desc`, `event_image`) VALUES ('$event_name','$location','$start_date','$end_date','$start_time','$end_time','$event_desc','$event_image')";
		if (mysqli_query($con,$query)){
	
	 "<script type='text/Javascript'>
			window.setTimeout(function() {
			window.location.href = '#';
			}, 2000);</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		
	} else {
		echo "Query Doesn't Excute".mysqli_error($con);
	}
	
	}
	else if($_FILES['event_image']['error'] == 4){
	echo "<div style='width:auto;margin:15px' class='alert alert-danger role='alert'>Please Select File </div>";

	echo "<script type='text/Javascript'>
			window.setTimeout(function() {
			window.location.href = 'courses.php';
			}, 2000);</script>";
	} else {
		exit();
	}
}
?>
<section class="forms">
	<div class="container-fluid">
		<div class="row">
			<!-- Basic Form-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-close">
						<div class="dropdown">
							<button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
							<div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a></div>
						</div>
					</div>
					<div class="card-header d-flex align-items-center">
						<h3 class="h4">Create Event
						</h3>
					</div>

					<div class="card-body">
						<form method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label class="form-control-label">Event Name</label>
								<input type="text" name="event_name" placeholder="Become a Full Stack Developer" class="form-control">
								
							</div>

							<div class="form-group">
								<label class="form-control-label">Location</label>
								<input type="text" name="location" placeholder="Amman - Universiy of Jordan" class="form-control">
							</div>
						
							<div class="form-group">
								<label class="form-control-label">Start Date</label>
								<input type="date" name="start_date" class="form-control">
							</div>
							
							<div class="form-group">
								<label class="form-control-label">End Date</label>
								<input type="date" name="end_date" class="form-control" >
							</div>
							
							<div class="form-group">
								<label class="form-control-label">Start Time</label>
								<input type="time" name="start_time" class="form-control" >
							</div>
							
							<div class="form-group">
								<label class="form-control-label">End Time</label>
								<input type="time" name="end_time" class="form-control" >
							</div>
							
							<div class="form-group">
							<label class="form-control-label">Description</label><br>
							<textarea cols="60" rows="4" name="event_desc" placeholder="Discussion How student become a freelancer.."></textarea>
							</div>

							<div class="form-group">
								<label class="form-control-label">Event Image</label>
								<input type="file" name="event_image" class="form-control">
							</div>

							<div class="form-group">
								<input type="submit" name="submit" value="Create" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="form">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header d-flex align-items-center">
						<h3 class="h4">Events Table</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
										<th>Event ID</th>
										<th>Event Name</th>
										<th>Location</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Start Time</th>
										<th>End Time</th>
										<th>Desciption</th>
										<th>Event Image</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<?php
								
								$query       = "SELECT * FROM event";
 								$result      = mysqli_query($con,$query);
								while ($event_data = mysqli_fetch_assoc($result)){

								echo "<tr>";
								echo "<th>".$event_data['event_id']."</th>";
								echo "<th>".$event_data['event_name']."</th>";
								echo "<th>".$event_data['location']."</th>";
								echo "<th>".date('Y-m-d',strtotime($event_data['start_date']))."</th>";
								echo "<th>".date('Y-m-d',strtotime($event_data['end_date']))."</th>";
								echo "<th>".date('H:i:s',strtotime($event_data['start_time']))."</th>";
								echo "<th>".date('H:i:s',strtotime($event_data['end_time']))."</th>";
								echo "<th>".$event_data['event_desc']."</th>";
								echo "<th><img src='../images/event/".$event_data['event_image']."' height='50' width='50' class='rounded circle'></th>";
								echo "<th><a href='update_event.php?event_id=".$event_data['event_id']."'>Edit</a></th>";
								echo "<th><a href='delete_event.php?event_id=".$event_data['event_id']." &event_img=".$event_data['event_image']."'>Delete</a></th>";
								echo "</tr>" ;	
								 }
							     ?>
								<tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include '../includes/footer.php';?>
