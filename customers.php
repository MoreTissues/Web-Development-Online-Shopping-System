<?php include_once 'customers_crud.php' ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MothaBoards : CUSTOMERS</title>
   <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <?php include_once 'nav_bar.php'; ?>

    <div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Customer</h2>
      </div>
    <form action="customers.php" method="post" class="form-horizontal">

        <div class="form-group">
          <label for="cid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
      <input name="cid" type="text" placeholder="Customer ID" autofocus class="form-control" id="cid" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUSTOMER_ID']; ?>" required>
       </div>
        </div>

      <div class="form-group">
          <label for="fname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
      <input name="fname" type="text" placeholder="Customer Name" class="form-control" id="fname" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUSTOMER_NAME']; ?>" required>
      </div>
        </div>

     <div class="form-group">
          <label for="gender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
      <input name="gender" type="radio" id="gender"value="MALE"<?php if(isset($_GET['edit'])) if($editrow['FLD_CUSTOMER_GENDER']=="MALE") echo "checked"; ?> required> MALE
      </label>
    </div>
    <div class="radio">
      <label>
      <input name="gender" type="radio" id="gender" value="FEMALE"<?php if(isset($_GET['edit'])) if($editrow['FLD_CUSTOMER_GENDER']=="FEMALE") echo "checked"; ?> required> FEMALE
      </label>
      </div>
      </div>
        </div>

     <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
     <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldcid" value="<?php echo $editrow['FLD_CUSTOMER_ID']; ?>">
      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>
      <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
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
        <h2>Customer List</h2>
      </div>
      <table class="table table-striped table-bordered">
      <tr>
        <th><center>Customer ID</center></th>
        <th><center>Name</center></th>
        <th><center>Gender</center></th>
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
        $stmt = $conn->prepare("select * from tbl_customer_a161032 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><center><?php echo $readrow['FLD_CUSTOMER_ID']; ?></center></td>
        <td><center><?php echo $readrow['FLD_CUSTOMER_NAME']; ?></center></td>
        <td><center><?php echo $readrow['FLD_CUSTOMER_GENDER']; ?></center></td>
        <td>
          <center>
          <a href="customers.php?edit=<?php echo $readrow['FLD_CUSTOMER_ID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="customers.php?delete=<?php echo $readrow['FLD_CUSTOMER_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_customer_a161032");
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
            <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"customers.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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