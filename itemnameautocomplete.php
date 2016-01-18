<?php
require 'Includes/connections.php';
?>
<?php
$term=trim(strip_tags($_GET["term"]));


$a_json = array();
$a_json_row = array();

if ($data = $con->query("SELECT * FROM items WHERE itemname LIKE '%$term%' ORDER BY itemname")) {
	while($row = mysqli_fetch_array($data)) {
		$itemName = htmlentities(stripslashes($row['itemname']));
		$itemID = htmlentities(stripslashes($row['itemid']));
		$a_json_row["itemid"] = $itemID;
		$a_json_row["value"] = $itemName;
		$a_json_row["label"] = $itemName;
		array_push($a_json, $a_json_row);
	}
}
// jQuery wants JSON data
echo json_encode($a_json);
flush();

$con->close();
?>

