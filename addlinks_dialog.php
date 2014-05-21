<div class="modal fade" id="AddLinksModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismis="modal" aria-hidden="true">&times</button>
				<h4 class="modal-title">Add New Bookmark</h4>
			</div>
			<div class="modal-body">
				<form>
				<?php
					include_once "db.php";
					$query = "select * from categories";
					global $con;
					$res = $con->query($query);
					while($row = $res->fetch_assoc()) {
					$options=$options."<option>".$row['category']."</option>\n";
					}
				?>
					<div id="tabslist">
						<?php 
							$tabs_list = json_decode($_GET['list']);
							$x=0;
							foreach($tabs_list as $i) {
								$x=$x+1;
								?>
								<div class="well addlink-well">
									<select class="addlink-category form-control" >
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
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="addlinks-add" >Add</button>
			</div>
		</div>
	</div>
</div>
