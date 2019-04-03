<?php 
include_once 'staffs_crud.php'; 
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MothaBoards : STAFFS</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript">


    function Validate() {
        var password = document.getElementById("password_1").value;
        var confirmPassword = document.getElementById("password_2").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
    
</script>

</head>
<body>
    <?php include_once 'nav_bar.php'; ?>
     <div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Staff</h2>
      </div>

    <form action="staffs.php" method="post" class="form-horizontal" id="myform">

     <div class="form-group">
          <label for="sid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
      <input name="sid" type="text" placeholder="Staff ID" autofocus class="form-control" id="sid" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_ID']; ?>" required>
      </div>
        </div>

      <div class="form-group">
          <label for="fname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
      <input name="fname" type="text" placeholder="Staff Name" class="form-control" id="fname"value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_NAME']; ?>"required>
       </div>
        </div>

      
      <div class="form-group">
          <label for="gender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
      <input name="gender" type="radio" id="gender" value="MALE"<?php if(isset($_GET['edit'])) if($editrow['FLD_STAFF_GENDER']=="MALE") echo "checked"; ?> required> MALE
      </label>
    </div>
    <div class="radio">
      <label>
      <input name="gender" type="radio" id="gender" value="FEMALE"<?php if(isset($_GET['edit'])) if($editrow['FLD_STAFF_GENDER']=="FEMALE") echo "checked"; ?> required> FEMALE
      </label>
      </div>
      </div>
        </div>

        <div class="form-group">
          <label for="username" class="col-sm-3 control-label">Username</label>
          <div class="col-sm-9">
      <input name="username" type="text" placeholder="Staff Username" class="form-control" id="username"value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_USER_NAME']; ?>"required>
       </div>
        </div>

        <div class="form-group">
          <label for="password_1" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
      <input name="password_1" type="text" placeholder="Staff Password" class="form-control" id="password_1"value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_PASSWORD']; ?>"required>
       </div>
        </div>

          <div class="form-group">
          <label for="password_2" class="col-sm-3 control-label">Confirm Password</label>
          <div class="col-sm-9">
      <input name="password_1" type="text" placeholder="Staff Confirm Password" class="form-control" id="password_2"required>
       </div>
        </div>

      

      <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
     <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editrow['FLD_STAFF_ID']; ?>">
      <button class="btn btn-default" type="submit" name="update" onclick="return Validate()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>
      <button class="btn btn-default" type="submit" id="btnSubmit" name="create" onclick="return Validate()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <?php } ?>
      <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
        </div>
      </div>
    </form>
     </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Staff List</h2>
      </div>
     <table class="table table-striped table-bordered">
      <tr>
        <th><center>Staff ID</center></th>
        <th><center>Name</center></th>
        <th><center>Gender</center></th>
        <th><center>Username</center></th>
        <th><center>Edit/Delete</center></th>
      </tr>
      <?php
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $stmt = $conn->prepare("select * from tbl_staff_a161032 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><center><?php echo $readrow['FLD_STAFF_ID']; ?></center></td>
        <td><center><?php echo $readrow['FLD_STAFF_NAME']; ?></center></td>
        <td><center><?php echo $readrow['FLD_STAFF_GENDER']; ?></center></td>
        <td><center><?php echo $readrow['FLD_STAFF_USER_NAME']; ?></center></td>
        <td>
         <center>
          <a href="staffs.php?edit=<?php echo $readrow['FLD_STAFF_ID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="staffs.php?delete=<?php echo $readrow['FLD_STAFF_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
        </center>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
</div>
    </div>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_staff_a161032");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>