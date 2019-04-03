<?php
  require_once 'database.php';
  
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please Enter Username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please Enter Password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        
        if($stmt = $pdo->prepare("SELECT FLD_STAFF_USER_NAME, FLD_STAFF_PASSWORD FROM tbl_staff_a161032 WHERE FLD_STAFF_USER_NAME = :username")){
            // Bind variables to the prepared statement as parameters
           $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            
            // Set parameters 
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $database_password = $row['FLD_STAFF_PASSWORD'];
                        if($database_password == $password){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>MothaBoards : LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript">
        function myFunction() {
  var x = document.getElementById("exampleInputPassword1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
} 
    </script>
</head>
<body>
<?php include_once 'nav_bar2.php'; ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="css/bootstrap.min.css" rel="stylesheet">

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="logo.png" id="icon" alt="User Icon" width="100%" height="100%" />
      <h1>Welcome to MothaBoards</h1>
    </div>

    <!-- Login Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group">
    <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Please Enter Username" style="border-style: solid; border-width: 4px; border-color: #e6e6ff">
  </div>

      <div class="form-group">
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Please Enter Password" style="border-style: solid; border-width: 4px; border-color: #e6e6ff"> 
  </div>
  <div>
      <input type="checkbox" onclick="myFunction()">  Show Password 
  </div>
       <span class="help-block"><?php echo $password_err; ?></span>
      <span class="help-block"><?php echo $username_err; ?></span>
      <div style="margin-top: 15px">
      <input type="submit" class="fadeIn fourth" value="Log In" name="login_user">
      </div>
    </form>


  </div>
</div>
</body>


</html>