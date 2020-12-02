<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// error message to be logged 


$log_file = "./log.txt"; 
$date = $time = date('m/d/y h:iA');
$ip = $_SERVER['REMOTE_ADDR'];
$log_message= " ";
// logging error message to given log file 
error_log($log_message, 3, $log_file); 

session_start();  
 $host = "localhost";  
 $username = "root";  
 $password = "Osmanosman1.";  
 $database = "brokenauth";  
 $message = " ";
 
 try  
 {  
      $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

      if(isset($_POST["login"]))  
      {  
                $query = "SELECT * FROM user WHERE username = :username AND password = :password";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                    $message = "logged in"; 
                    $log_message = "The gebruiker geprobeerd in " . $date . " in te loggen met ip adres van " . $ip . " met correct username van " . $_POST["username"]. " the login is successfull! " . "\n" ;
                    error_log($log_message, 3, $log_file); 
                }  
                else  
                {  
                     $message = "Wrong data";
                     $log_message = "The gebruiker geprobeerd in " . $date . " in te loggen met ip adres van " . $ip . " met incorrect username van " .$_POST["username"]. " the log in is unsuccesfull ". "\n" ; 
                     error_log($log_message, 3, $log_file); 

                }  
            
           }
          
          
        }
 
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
      error_log("Failed to connect to database!", 0);
 }  

?>


<!DOCTYPE html>

<head>
   
</head>
<body>
<?php  
                if(isset($message))  
                {  
                     echo $message;  
                }  
                ?>  
    <form method="POST">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" name="login" value="Login" />  
    </form>
    
</body>
</html>

