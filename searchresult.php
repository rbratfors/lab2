<?php
session_start();

$uid = $_SESSION['user_id'];
if(isset($_POST['submit'])){
    
    $data_missing = array();
    $counter = 0;
    $string = "AND ";
    $join = "";
    
    if(empty($_POST['title'])){

        $data_missing[] = 'Title';

    } else {

        $title = trim($_POST['title']);
        $counter++;
        $string .= "title = '".$title."' AND ";
    }

    if(empty($_POST['actor'])){

        $data_missing[] = 'Actor';

    } else {

        $actor = trim($_POST['actor']);
        $counter++;
        $string .= "actor.name = '".$actor."' AND ";
        $join .= "INNER JOIN roles ON roles.m_id = material.m_id
                INNER JOIN actor ON actor.actor_id = roles.actor_id ";
    }

    if(empty($_POST['director'])){

        $data_missing[] = 'Director';

    } else {

        $director = trim($_POST['director']);
        $counter++;
        $string .= "director.name = '".$director."' AND ";
        $join .= "INNER JOIN directing ON directing.m_id = material.m_id
                INNER JOIN director ON director.director_id = directing.director_id ";
    }

    if(empty($_POST['company'])){

        $data_missing[] = 'Company';

    } else {

        $company = trim($_POST['company']);
        $counter++;
        $string .= "company.name = '".$company."' AND ";
        $join .= "INNER JOIN producedby ON producedby.m_id = material.m_id
                INNER JOIN company ON company.company_id = producedby.company_id ";
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
    $age = $_SESSION['age'];
    $mpaa = 5;
    if($age < 8)
        $mpaa = 1;
    else if($age < 13)
        $mpaa = 2;
    else if($age < 15)
        $mpaa = 3;
    else if($age < 18)
        $mpaa = 4;
    $string = substr(trim($string), 0, -3);



	require_once('mysqli_connect.php');

	if($counter > 0) {
		$query = "SELECT * FROM material ".$join."
        WHERE material.m_id 
        NOT IN (SELECT m_id 
            FROM user_history 
            WHERE episodes_remaining < 1) 
        AND mpaa_rating < ". $mpaa. " ".$string;
	} else {
		$query = "SELECT * FROM material WHERE 
                m_id NOT IN (SELECT m_id FROM user_history WHERE episodes_remaining < 1) 
                AND mpaa_rating <". $mpaa;
	}
    echo $query;

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