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

    } else {

        // Trim white space from the name and store the name
        $rated = trim($_POST['rated']);

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
		$query = "INSERT INTO user_history (user_id, m_id, watch_date)
				 VALUES ('" . $uid . "', '" . $mid . "', '" . date("Y/m/d") . "')";

		$response = @mysqli_query($dbc, $query);
	}

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
		<td align="left"><b>Rating</b></td></tr>';

		while($row = mysqli_fetch_array($response)) {


			echo '<tr><td align="left">' . 
			$row['user_id'] . '</td><td align="left">' . 
			$row['m_id'] . '</td><td align="left">' .
			$row['title'] . '</td><td align="left">' . 
			$row['watch_date'] . '</td><td align="left">' .
			$row['rating'] . '</td><td align="left">';

			echo '</tr>';
		}

		echo '</table>';

	} else {

		echo "Couldn't issue database query<br />";

		echo mysqli_error($dbc);

	}

	mysqli_close($dbc);
}
?>

</body>
</html>