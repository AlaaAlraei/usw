<?php require '../includes/header.php'; ?>
<?php require '../includes/connect_db.php'; ?>
<section>
	<div class='container-fluid'>
		<div class='row'>
			<div class='col-lg-12'>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Student #</th>
							<th scope="col">Name</th>
							<th scope="col">Major</th>
							<th scope="col">Phone Number</th>
							<th scope="col">Interested Course</th>
							<th scope="col"></th>

						</tr>
					</thead>
					<tbody>

						<?php $query  = "SELECT *
						FROM student,course
						WHERE student.course_id = course.course_id";
				        $result = mysqli_query($con,$query);
					    while ($stdSet = mysqli_fetch_assoc($result)):
						echo "<tr>";
						echo "<th scope='col'>{$stdSet['std_id']}</th>
						<th scope='col'>{$stdSet['std_name']}</th>
						<th scope='col'>{$stdSet['std_major']}</th>
						<th scope='col'>{$stdSet['phone_number']}</th><th scope='col'>{$stdSet['course_name']}</th>
						";
						echo "<th scope='col'><a href='#exampleModalCenter_{$stdSet['std_id']}' data-toggle='modal' data-target='' class='btn btn-primary'>Show</a>";?>
						<div class="modal fade" id="exampleModalCenter_<?php echo $stdSet['std_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle">Student Details</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<?php echo $stdSet['std_name'];?><span aria-hidden="true">
												&times;</span>
										</button>
									</div>
									<div class="modal-body">

										<div class='col-lg-12'>
											<table class="table">

												<tr>
													<th>Student Name</th>
													<td>
														<?php echo $stdSet['std_name'];?>
													</td>
												</tr>
												<tr>
													<th>Major</th>
													<td>
														<?php echo $stdSet['std_major'];?>
													</td>
												</tr>
												<tr>
													<th>Phone Number</th>
													<td>
														<?php echo $stdSet['phone_number'];?>
													</td>
												</tr>
												<tr>
													<th>Intersted Course</th>
													<td>
														<?php echo $stdSet['course_name'];?>
													</td>
												</tr>

											</table>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>

										</div>
									</div>
								</div>
							</div>
							</th>
							</tr>


                         <?php  endwhile;?>
 

					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>




<?php require '../includes/footer.php'; ?>
