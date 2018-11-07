<?php
require_once('mysqli_connect.php');

$query = "SELECT * FROM user";


$response = @mysqli_query($dbc, $query);

if($response){

echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr><td align="left"><b>Name</b></td>
<td align="left"><b>Payment Status</b></td>
<td align="left"><b>Join Date</b></td>
<td align="left"><b>Expiry Date</b></td></tr>';

while($row = mysqli_fetch_array($response)){

echo '<tr><td align="left">' . 
$row['name'] . '</td><td align="left">' . 
$row['payment_status'] . '</td><td align="left">' .
$row['join_date'] . '</td><td align="left">' . 
$row['expiry_date'] . '</td><td align="left">';

echo '</tr>';
}

echo '</table>';

} else {

echo "Couldn't issue database query<br />";

echo mysqli_error($dbc);

}

mysqli_close($dbc);

?>