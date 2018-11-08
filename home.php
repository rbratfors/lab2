<?php
// Start the session
session_start();
?>
<html>
<body>

<?php
// Set session variables
$_SESSION['user_id'] = $_GET['user_id'];
$uid = $_GET['user_id'];
require_once('mysqli_connect.php');

$query = "SELECT date_of_birth FROM user
		WHERE user_id =". $uid;

$response = @mysqli_query($dbc, $query);

$bdate = mysqli_fetch_array($response);

$bdate = $bdate[0];

$now = time();

$bdate = strtotime($bdate);

$diff = $now - $bdate;

$age = floor($diff / 31556926);

$_SESSION['age'] = $age;

?>

<form action="http://localhost/search.php" method="post">

<p>
    <input type="submit" name="submit" value="Search" />
</p>
</form>

<form action="http://localhost/userhistory.php" method="post">

<p>
    <input type="submit" name="submit" value="History" />
</p>

</form>

</body>
</html>