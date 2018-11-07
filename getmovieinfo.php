<?php
require_once('mysqli_connect.php');

$query = "SELECT * FROM material";

$response = @mysqli_query($dbc, $query);

if($response){

echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr><td align="left"><b>Title</b></td>
<td align="left"><b>Year</b></td>
<td align="left"><b>Genre</b></td>
<td align="left"><b>Category</b></td>
<td align="left"><b>Rating</b></td></tr>';

while($row = mysqli_fetch_array($response)){

echo '<tr><td align="left">' . 
$row['title'] . '</td><td align="left">' . 
$row['year'] . '</td><td align="left">' .
$row['genre'] . '</td><td align="left">' . 
$row['category'] . '</td><td align="left">' .
$row['rating'] . '</td><td align="left">';

echo '</tr>';
}

echo '</table>';

} else {

echo "Couldn't issue database query<br />";

echo mysqli_error($dbc);

}

mysqli_close($dbc);

?>