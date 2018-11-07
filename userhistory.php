<?php
session_start();
?>
<html>
<head>
<title>Add User</title>
</head>
<body>
    
<?php
$uid = $_SESSION['user_id'];

if(isset($_POST['submit'])) {
    
    $data_missing = array();
    
    if(empty($_POST['rated'])){

        // Adds name to array
        $data_missing[] = 'Rated';
        $r = 0;
    } else {

        // Trim white space from the name and store the name
        $rated = trim($_POST['rated']);
        $r = 1;
    }

    if(empty($_POST['m_id'])){

        // Adds name to array
        $data_missing[] = 'Movie_id';
        $w = 0;
    } else {

        // Trim white space from the name and store the name
        $mid = trim($_POST['m_id']);
        $w = 1;
    }


	require_once('mysqli_connect.php');

	if($w > 0) {
		$query = "INSERT INTO user_history (user_id, m_id, watch_date, personal_rating)
				 VALUES ('" . $uid . "', '" . $mid . "', '" . date("Y/m/d") . "', '" . $rated . "')";

		$response = @mysqli_query($dbc, $query);
		
		if(!$response) {
			$query = "UPDATE user_history 
					SET personal_rating = " . $rated . 
					" WHERE user_history.user_id = " . $uid .
					" AND user_history.m_id = " . $mid;

			$response = @mysqli_query($dbc, $query);
		}

		if($r > 0) {
			$query = "SELECT SUM(personal_rating) FROM user_history
					WHERE m_id = ". $mid;

			$response = @mysqli_query($dbc, $query);

			$sum = mysqli_fetch_array($response);

			$sum = $sum[0];

			$query = "SELECT count(*) FROM user_history
					WHERE m_id = ". $mid;

			$response = @mysqli_query($dbc, $query);

			$count = mysqli_fetch_array($response);

			$count = $count[0];

			$avg_rating = $sum/$count;
			echo $avg_rating;
			$query = "UPDATE material 
						SET rating = " . $avg_rating . 
						" WHERE m_id = ". $mid;

			$response = @mysqli_query($dbc, $query);
		}

	}
}
require_once('mysqli_connect.php');

	$query = "SELECT * 
				FROM material
				INNER JOIN user_history ON 
				material.m_id = user_history.m_id
				WHERE user_history.user_id = " . $uid;


	$response = @mysqli_query($dbc, $query);

	if($response) {

		echo '<table align="left"
		cellspacing="5" cellpadding="8">

		<tr><td align="left"><b>User ID</b></td>
		<td align="left"><b>Movie ID</b></td>
		<td align="left"><b>Title</b></td>
		<td align="left"><b>Watch date</b></td>
		<td align="left"><b>Personal rating</b></td></tr>';
		$counter = 0;
		while($row = mysqli_fetch_array($response)) {


			echo '<tr><td align="left">' . 
			$row['user_id'] . '</td><td align="left">' . 
			$row['m_id'] . '</td><td align="left">' .
			$row['title'] . '</td><td align="left">' . 
			$row['watch_date'] . '</td><td align="left">' .
			$row['personal_rating'] . '</td><td align="left">';

			?>

			<form action="http://localhost/userhistory.php" method='POST'>
			<select id="rating" name="rated">                      
  			<option value="0"></option>
  			<option value="1">1</option>
 			<option value="2">2</option>
  			<option value="3">3</option>
  			<option value="4">4</option>
  			<option value="5">5</option>

  			<input type='hidden' name='m_id' value='<?php echo $row['m_id']; ?>'/>

  			<input type="submit" name="submit" value="Rate!" />
			</form>

		    <?php
		    


			echo '</tr>';
			$counter++;
		}

		echo '</table>';

	} else {

		echo "Couldn't issue database query<br />";

		echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

?>

</body>
</html>