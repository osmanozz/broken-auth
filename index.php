<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
</head>
<body>
    <form method="POST" action="" >
        <input type="text" name="email" placeholder="username" required>
        <input type="password" name="password" placeholder="password" required>
        <button type="submit" name="submit" value="submit">Verzenden</button>
    </form>
    
</body>
</html>

<?php

session_start();
$host = 'localhost';
$user = 'root';
$pass = 'Osmanosman1.';
$db_name = 'brokenauth';

$con = mysqli_connect($host, $user, $pass, $db_name);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
 
    $email = $_POST['email'];  
    $password = $_POST['password']; 
      
        // Om te voorkomen voor een sql injection
        $email = stripcslashes($email);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $email);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password'";  
        $result = mysqli_query($con, $sql); 
        $row = mysqli_fetch_array($result);
        
          
        if  ($row['email'] == $email && $row['password']==$password) {  
            echo "Logged in!";  
        }  
        else{  
            echo "Email of password is niet correct!";  
        }    
    } 
 


?>