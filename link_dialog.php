<?php
session_start();
include_once "db.php";
global $con;



if(!isset($_GET['id'])) {
	exit(1);
}
$query = "SELECT * FROM links where link_id=".$_GET['id'];

if($result = $con->query($query)) {
	//
}else {
	exit(1);
}

?>
<div class="modal fade" id="AddLinksModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php if($row = $result->fetch_assoc()) {?>
			<div class="modal-header">
				<button type="button" class="close" data-dismis="modal" aria-hidden="true">&times</button>
				<h4 class="modal-title"><?php echo $row['title']; ?></h4>
			</div>
			<div class="modal-body">
				<h5><a href="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['url']; ?></a></h5>
				<div>
					<textarea cols="60" id="link-dialog-textarea"></textarea>
				</div>
				<div>
					<span class="btn btn-link"><span id="link-dialog-likes"></span><?php ?>people like this</span>
					<button class="btn btn-primary" id="link-dialog-like-button"><span class="glyphicon glyphicon-thumbs-up"></span></button>
					<button class="btn btn-primary" id="link-dialog-share-button"><span class="glyphicon glyphicon-share"></span></button>
					<button class="btn btn-primary" id="link-dialog-comment-button">Comment</button>
				</div>
				<div id="link-dialog-share-options" class="hidden">
					<label>Share with</label>
					<input type="text" class="form-control">
					<button class="btn btn-default"id="link-dialog-share-final-button">share</button>
				</div>
				<div id="link-dialog-comments">A
				</div>
			</div>
			<div class="modal-footer">
			</div>
			<?php } ?>
		</div>
	</div>
</div>
