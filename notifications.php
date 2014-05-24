<?php
session_start();
include_once "db.php";
global $con;

$userid = $_SESSION['auth_user_id'];

//$query = "SELECT * FROM links where link_id=".$_GET['id'];
$query = "select * from user where user_id in (select friend_id from contacts as c where user_id=$userid and (select count(contact) from contacts where user_id=c.friend_id)<1)";
if($result = $con->query($query)) {
	//
}else {
	exit(1);
}

?>
<div class="modal fade" id="AddLinksModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismis="modal" aria-hidden="true">&times</button>
				<h4 class="modal-title">Notifications</h4>
			</div>
			<div class="modal-body">
				<?php
				if($result) {
					echo "<table class='table table-hover table-bordered'>";
					while($row = $result->fetch_assoc()) {
						echo "<tr><td>".$row['username']." added you.</td></tr>";
					}
					echo "</table>";
				} else {
					echo "No notifications.";
				}
				?>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
