<div class="modal fade" id="AddLinksModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismis="modal" aria-hidden="true">&times</button>
				<h4 class="modal-title">Add New Bookmark</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label>Category</label>
<<<<<<< HEAD
						
=======
						<select class="form-control" id="addlinks-category" >
>>>>>>> bd0440d6272738a719ef8df018611ab7c85c6689
							<?php
                                include_once "db.php";
								$query = "select * from categories";
                                global $con;
								$res = $con->query($query);
								while($row = $res->fetch_assoc()) {
<<<<<<< HEAD
									$options=$options."<option>".$row['category']."</option>\n";
=======
									echo "<option>".$row['category']."</option>\n";
>>>>>>> bd0440d6272738a719ef8df018611ab7c85c6689
								}
							?>
						</select>
					</div>
<<<<<<< HEAD
					<div id="tabslist">
						<?php 
							$tabs_list = json_decode($_GET['list']);
							$x=0;
							foreach($tabs_list as $i) {
								$x=$x+1;
								?>
								<div class="well addlink-well">
									<select class="form-control" id="addlinks-category" >
										<?php echo $options; ?>
									</select>
									<div class="form-group">
										<label>Link</label>
										<input type="text" class="addlink-link form-control" name="tabtitle<?php echo $x; ?>" value="<?php echo $i->url; ?>"/>
									</div>
									<div class="form-group">
										<label>Description</label>
										<input type="text" class="addlink-desc form-control" name="tabdesc<?php echo $x; ?>" value="<?php echo $i->title; ?>"/>
									</div>
								</div>
								<?php
							}
						?>
					</div>
				</form>
				<div id="TheSpecialPageElement">
				</div>
=======
					<div class="form-group">
						<label>Link</label>
						<input type="url" class="form-control" id="addlinks-link" />
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" id="addlinks-description" ></textarea>
					</div>
				</form>
>>>>>>> bd0440d6272738a719ef8df018611ab7c85c6689
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="addlinks-add" >Add</button>
			</div>
		</div>
	</div>
</div>
