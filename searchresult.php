<?php

if(isset($_POST['submit'])){
    
    $data_missing = array();
    $counter = 0;
    $string = "";
    
    if(empty($_POST['title'])){

        $data_missing[] = 'Title';

    } else {

        $title = trim($_POST['title']);
        $counter++;
        $string .= "title = '".$title."' AND ";
    }

    if(empty($_POST['genre'])){

        $data_missing[] = 'Genre';

    } else {

        $genre = trim($_POST['genre']);
        $counter++;
        $string .= "genre = '".$genre."' AND ";
    }

    if(empty($_POST['category'])){

        $data_missing[] = 'Category';

    } else {

        $category = trim($_POST['category']);
        $counter++;
        $string .= "category = '".$category."' AND ";
    }

    if(empty($_POST['rating'])){

        $data_missing[] = 'Rating';

    } else {

        $rating = trim($_POST['rating']);
        $counter++;
        $string .= "rating >= '".$rating."' AND ";
    }

    if(empty($_POST['language'])){

        $data_missing[] = 'Language';

    } else {

        $language = trim($_POST['language']);
        $counter++;
        $string .= "language = '".$language."' AND ";
    }

    $string = substr(trim($string), 0, -3);
	require_once('mysqli_connect.php');

	if($counter > 0) {
		$query = "SELECT * FROM material
			WHERE ".$string;
	} else {
		$query = "SELECT * FROM material";
	}

	$response = @mysqli_query($dbc, $query);

	if($response) {

		echo '<table align="left"
		cellspacing="5" cellpadding="8">

		<tr><td align="left"><b>Title</b></td>
		<td align="left"><b>Year</b></td>
		<td align="left"><b>Genre</b></td>
		<td align="left"><b>Category</b></td>
		<td align="left"><b>Rating</b></td></tr>';

		while($row = mysqli_fetch_array($response)){
		$t = $row['title'];
		$id = $row['m_id'];

		$message = '<a href="moviepage.php?cat='.urlencode($id).'">'.$t.'</a>';

		echo '<tr><td align="left">' . 
		$message . '</td><td align="left">' .  
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
}
?>