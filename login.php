<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Heath Service Centre | Login</title>
        <link href="style.css" rel="stylesheet" />
    </head>  
    <body>
        <?php
            require_once 'validation.php'; 
        ?>
        
        <?php 
            if(isset($_POST['login']))
            {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']); 
                
                /*
                $error['username'] = validateUsername($username);
                */
                
                //hashedPassword 
                $hashedPassword = hash('sha3-256', $password, true);
                //hashedPassword_hex 
                $hashedPassword_hex = bin2hex($hashedPassword);
                
                $exist = 0; 
                
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
                
                $sql = "SELECT * FROM citizens"; 
                
                $result = $con -> query($sql); 
                
                while($row = $result -> fetch_object())
                {
                    $compareUsername = $row -> username;  
                    
                    $comparePassword = $row -> password;   
                    
                    if(strcmp($compareUsername, $username)==0 && strcmp($comparePassword, $hashedPassword_hex)==0)
                    {
                        $exist = 1;   
                        $location = "citizenDetails.php?username=".$username; 
                        echo "<script type='text/javascript'>alert('Login successfully');window.location='$location'</script>";
                    } 
                    else 
                    {
                        $exist = 0;
                    }
                }
                if($exist === 0)
                {
                    echo "<script type='text/javascript'>alert('Username and password do not match');</script>";
                }
            }
        ?> 
        <div class="content">
            <form id="loginForm" method="post" action="">
            <div class="bigTextDiv">
                <h1 class="bigText">Health Service Centre | Login</h1>
            </div>
            <!-- username --> 
            <input type="text" class="txtBox" id="username" name="username" placeholder="Username" autofocus="autofocus" required="required"/>
            
            <br><br>
        
            <!-- password --> 
            <input type="password" class="txtBox" id="password" name="password" placeholder="Password" required="required"/>
            <br><br>
            <input type="submit" class="btn2" id="login" value="Login" name="login" />
            <br> 
            <br>  
            <a href="home.php" class="txtAtBtm">Home</a>
            <br>
            <br>
            <a href="register.php" class="txtAtBtm">Register</a>
            </form>
        </div>
    </body>
        
</html>