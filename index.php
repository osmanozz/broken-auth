<?php

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
                }  
                else  
                {  
                     $message = 'Wrong Data';
                     session_destroy();  
                }  
           }
          
        }
 
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
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

