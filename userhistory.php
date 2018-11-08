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
$rated = null;
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
    if(empty($_POST['e_id'])){

        // Adds name to array
        $data_missing[] = 'Epi_id';
    } else {

        // Trim white space from the name and store the name
        $eid = trim($_POST['e_id']);
    }


	if($w > 0) {
		$query = "INSERT INTO user_history (user_id, m_id, e_id, watch_date, personal_rating)
				 VALUES ('" . $uid . "', '" . $mid . "', '" . $eid . "', '" . date("Y-m-d") . "', '" . $rated . "')";

		$response = @mysqli_query($dbc, $query);
		
		$query = "SELECT count(*) FROM user_history
					WHERE m_id = ". $mid .
					" AND user_id = " . $uid;

		echo $query;

		$response = @mysqli_query($dbc, $query);

		$ew = mysqli_fetch_array($response);

		$ew = $ew[0];

		$query = "SELECT episodes FROM material
				WHERE m_id = ". $mid;

		$response = @mysqli_query($dbc, $query);

		$episodes = mysqli_fetch_array($response);

		$episodes = $episodes[0];
		
		$er = $episodes - $ew;

		echo $er;

		if(empty($rated)) {
		$query = "UPDATE user_history 
					SET episodes_remaining = " . $er . 
					" WHERE user_id = " . $uid .
					" AND m_id = " . $mid;
		} else {
			$query = "UPDATE user_history 
					SET personal_rating = " . $rated . 
					", episodes_remaining = " . $er . " WHERE user_id = " . $uid .
					" AND m_id = " . $mid .
					" AND e_id = " . $eid;
		}

		echo $query;
		$response = @mysqli_query($dbc, $query);
		

		if($r > 0) {
			$query = "SELECT SUM(personal_rating) FROM user_history
					WHERE m_id = ". $mid;

			$response = @mysqli_query($dbc, $query);

			$sum = mysqli_fetch_array($response);

			$sum = $sum[0];

			$query = "SELECT count(*) FROM user_history
					WHERE personal_rating > 0 AND m_id = ". $mid;

			$response = @mysqli_query($dbc, $query);

			$count = mysqli_fetch_array($response);

			$count = $count[0];

			$avg_rating = $sum/$count;

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
		<td align="left"><b>Media ID</b></td>
		<td align="left"><b>Episode</b></td>
		<td align="left"><b>Title</b></td>
		<td align="left"><b>Watch date</b></td>
		<td align="left"><b>Personal rating</b></td></tr>';
		$counter = 0;
		while($row = mysqli_fetch_array($response)) {


			echo '<tr><td align="left">' . 
			$row['user_id'] . '</td><td align="left">' . 
			$row['m_id'] . '</td><td align="left">' .
			$row['e_id'] . '</td><td align="left">' .
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
  			<input type='hidden' name='e_id' value='<?php echo $row['e_id']; ?>'/>

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