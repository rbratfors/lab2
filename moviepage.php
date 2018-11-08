<?php

$id = $_GET['cat']; 

require_once('mysqli_connect.php');

$query = "SELECT * FROM material where m_id = '".$id."'";

$response = @mysqli_query($dbc, $query);

if($response){

	$row = mysqli_fetch_array($response);

	echo
	'<div style="font-size:300%;">' . $row['title'] . '</div>' . '<br />' .
	'<div style="font-size:160%;">' . $row['year'] . '</div>' . '<br />' .
	'<div style="font-size:160%;">' . $row['genre'] . '</div>' . '<br />' . 
	'<div style="font-size:160%;">' . $row['category'] . '</div>' . '<br />' .
	'<div style="font-size:160%;">' . $row['rating'] . '</div>';

	$mid = $row['m_id'];
?>
<form action="http://localhost/userhistory.php" method="post">

<p>Rate it:
<select id="rated" name="rated">                      
  <option value=""></option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>
</p>

<input type='hidden' name='m_id' value='<?php echo $mid; ?>'/>
<input type='hidden' name='e_id' value='1'/>

<?php
	
} else {

	echo "Couldn't issue database query<br />";

	echo mysqli_error($dbc);

}

if($row['episodes'] > 1) {
	$counter = 1;
	$e = $row['episodes'];
	echo '<div style="font-size:130%;">Episode list:</div>';
	while($e>0) {
		echo "Episode".$counter;
		?>

		<input type='hidden' name='submit' value='submit!!'/>
		<button type="submit" name="e_id" value='<?php echo $counter; ?>' >Watch</button>
		<?php
		echo "<br>";
		$counter++;
		$e--;
	}

} else {

	?>
	<p>
    <input type="submit" name="submit" value="Watch" />
	</p>
	<?php

}

mysqli_close($dbc);

?>

</form>