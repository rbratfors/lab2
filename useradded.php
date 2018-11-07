<?php
session_start();
?>
<html>
<head>
<title>Add User</title>
</head>
<body>
<?php
if(isset($_POST['submit'])){
    
    $data_missing = array();
    
    if(empty($_POST['name'])){

        // Adds name to array
        $data_missing[] = 'Name';

    } else {

        // Trim white space from the name and store the name
        $name = trim($_POST['name']);

    }

    if(empty($_POST['payment_status'])){

        // Adds name to array
        $data_missing[] = 'Payment Status';

    } else {

        // Trim white space from the name and store the name
        $p_status = trim($_POST['payment_status']);

    }

    if(empty($_POST['join_date'])){

        // Adds name to array
        $data_missing[] = 'Join Date';

    } else {

        // Trim white space from the name and store the name
        $j_date = trim($_POST['join_date']);

    }

    if(empty($_POST['expiry_date'])){

        // Adds name to array
        $data_missing[] = 'Expiry Date';

    } else {

        // Trim white space from the name and store the name
        $e_date = trim($_POST['expiry_date']);

    }

    
    if(empty($data_missing)){
        
        require_once('mysqli_connect.php');
        
        $query = "INSERT INTO user (name, user_id, payment_status, join_date, expiry_date) VALUES (?, NULL, ?,
        ?, ?)";
        
        $stmt = mysqli_prepare($dbc, $query);
        
        mysqli_stmt_bind_param($stmt, "ssss", $name,
                               $p_status, $j_date, $e_date);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        
        if($affected_rows == 1){
            
            echo 'User Entered';
            
            mysqli_stmt_close($stmt);
            
            mysqli_close($dbc);
            
        } else {
            
            echo 'Error Occurred<br />';
            echo mysqli_error($dbc);
            
            mysqli_stmt_close($stmt);
            
            mysqli_close($dbc);
            
        }
        
    } else {
        
        echo 'You need to enter the following data<br />';
        
        foreach($data_missing as $missing){
            
            echo "$missing<br />";
            
        }
        
    }
    
}

?>

<form action="http://localhost/useradded.php" method="post">
    
    <b>Add a New User</b>
    
    <p>Name:
<input type="text" name="name" size="30" value="" />
</p>

<p>Payment Status:
<input type="text" name="payment_status" size="30" value="" />
</p>

<p>Join Date:
<input type="text" name="join_date" size="30" value="" />
</p>

<p>Expiry Date:
<input type="text" name="expiry_date" size="30" value="" />
</p>

<p>
    <input type="submit" name="submit" value="Send" />
</p>
    
</form>
</body>
</html>