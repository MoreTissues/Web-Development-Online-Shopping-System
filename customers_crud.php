<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_customer_a161032(FLD_CUSTOMER_ID, FLD_CUSTOMER_NAME,
      FLD_CUSTOMER_GENDER) VALUES(:cid, :fname, :gender)");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);

    $cid = $_POST['cid'];
    $fname = $_POST['fname'];
    $gender =  $_POST['gender'];
       
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
 
    $stmt = $conn->prepare("UPDATE tbl_customer_a161032 SET FLD_CUSTOMER_ID = :cid,
      FLD_CUSTOMER_NAME = :fname, FLD_CUSTOMER_GENDER = :gender WHERE FLD_CUSTOMER_ID = :oldcid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $fname = $_POST['fname'];
    $gender =  $_POST['gender'];
    $oldcid = $_POST['oldcid'];
       
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_customer_a161032 WHERE FLD_CUSTOMER_ID = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_customer_a161032 WHERE FLD_CUSTOMER_ID = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['edit'];
     
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