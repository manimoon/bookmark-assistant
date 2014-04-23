<div class="modal fade" id="AddLinksModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismis="modal" aria-hidden="true">&times</button>
				<h4 class="modal-title">Add New URL</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label>Category</label>
						<select class="form-control" id="addlinks-category" >
							<?php
                                include_once "db.php";
								$query = "select * from categories";
                                global $con;
								$res = $con->query($query);
								while($row = $res->fetch_assoc()) {
									echo "<option>".$row['category']."</option>\n";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Link</label>
						<input type="url" class="form-control" id="addlinks-link" />
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" id="addlinks-description" ></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="addlinks-add" >Add</button>
			</div>
		</div>
	</div>
</div>
