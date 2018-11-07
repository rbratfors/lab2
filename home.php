<?php
// Start the session
session_start();
?>
<html>
<body>

<?php
// Set session variables
$_SESSION['user_id'] = $_GET['user_id'];

echo $_SESSION['user_id'];
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