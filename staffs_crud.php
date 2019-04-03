<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_staff_a161032(FLD_STAFF_ID, FLD_STAFF_NAME, FLD_STAFF_GENDER, FLD_STAFF_USER_NAME, FLD_STAFF_PASSWORD) VALUES(:sid, :fname, :gender, :username_1, :password_1)");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':username_1', $username_1, PDO::PARAM_STR);
    $stmt->bindParam(':password_1', $password_1, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $gender = $_POST['gender'];
    $username_1 = $_POST['username'];
    $password_1 = $_POST['password_1'];

    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_staff_a161032 SET
      FLD_STAFF_ID = :sid, FLD_STAFF_NAME = :fname,
      FLD_STAFF_GENDER = :gender, FLD_STAFF_USER_NAME = :username_1, FLD_STAFF_PASSWORD = :password_1  WHERE FLD_STAFF_ID = :oldsid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
    $stmt->bindParam(':username_1', $username_1, PDO::PARAM_STR);
    $stmt->bindParam(':password_1', $password_1, PDO::PARAM_STR);

    
    $sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $gender = $_POST['gender'];
    $oldsid = $_POST['oldsid'];
    $username_1 = $_POST['username'];
    $password_1 = $_POST['password_1'];

         
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_staff_a161032 where FLD_STAFF_ID = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staff_a161032 where FLD_STAFF_ID = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
 
?>