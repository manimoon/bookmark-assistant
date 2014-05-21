<?php
session_start();
include_once "db.php";
global $con;
$user_id = $_GET["id"];

$query = "select * from links where user_id=$user_id";
$res = $con->query($query);
$obj = Array();

echo "<table class='table table-hover table-bordered'>";
while($row = $res->fetch_assoc()) {
	?>
	<tr>
	<td><?php echo $row['url']; ?></td>
	<td><?php echo $row['title']; ?></td>
	</tr>
	<?php
	//if(!isset($obj[$row['category']])) {
		//$obj[$row['category']] = Array();
	//}
	
	//$obj[$row['category']][$row['link_id']] = array(
	//					'url'=>$row['url'],
	//					'title'=>$row['title']
	//				);
}
echo "</table>";
//if(sizeof($obj)==0)
//$obj['empty']='true';

//echo json_encode($obj);
?>
