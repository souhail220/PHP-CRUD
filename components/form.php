<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title h1 fs-5" id="exampleModalLabel">Adding or Updating Users</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="addForm" action="" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<!-- username -->
					<div class="form-group">
						<label for="username">Name:</label>
						<div class="input-group mb-3">
							<span class="input-group-text bg-dark">
								<li class="fas fa-user-alt text-light"></li>
							</span>
							<input id="username" name="username" type="text" class="form-control" placeholder="Enter you username" autocomplete="off" aria-label="Users" aria-describedby="basic-addon1" required>
						</div>
					</div>

					<!-- email -->
					<div class="form-group">
						<label for="email">Email:</label>
						<div class="input-group mb-3">
							<span class="input-group-text bg-dark">
								<li class="fas fa-envelope-open text-light"></li>
							</span>
							<input id="email" name="email" type="email" class="form-control" placeholder="Enter you email" autocomplete="off" aria-label="Users" aria-describedby="basic-addon1" required>
						</div>
					</div>

					<!-- mobile -->
					<div class="form-group">
						<label for="mobile">Mobile:</label>
						<div class="input-group mb-3">
							<span class="input-group-text bg-dark">
								<li class="fas fa-phone text-light"></li>
							</span>
							<input id="mobile" name="mobile" type="tel" class="form-control" placeholder="Enter you mobile" autocomplete="off" aria-label="Users" aria-describedby="basic-addon1" required>
						</div>
					</div>

					<!-- image -->
					<div class="form-group">
						<label>Photo:</label>
						<div class="input-group mb-3">
							<input type="file" name="userPhoto" class="form-control" id="userPhoto">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" id="submitBtn" class="btn btn-dark">Submit</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

					<!-- 2 input fields first for adding and next for updating, deleting or viewing profile -->
					<input type="hidden" name="action" value="adduser">
					<input type="hidden" name="userId" id="userId" value="">
				</div>
			</form>
		</div>
	</div>
</div>