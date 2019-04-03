<?php
  include_once 'products_crud.php';
  ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MothaBoards : PRODUCTS</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 
 <?php include_once 'nav_bar.php'; ?>

 <div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Product</h2>
      </div>
    <form action="products.php" method="post" class="form-horizontal" enctype="multipart/form-data">

       <div class="form-group">
          <label for="productid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
      <input name="pid" type="text" class="form-control" id="productid" autofocus placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_ID']; ?>" required>
       </div>
        </div>

      <div class="form-group">
          <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
      <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_NAME']; ?>" required>
       </div>
        </div>

        <div class="form-group">
          <label for="productprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
      <input name="price" type="text" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRICE']; ?>" required>
       </div>
        </div>

      <div class="form-group">
          <label for="productbrand" class="col-sm-3 control-label">Brand</label>
          <div class="col-sm-9">
      <select name="brand" class="form-control" id="productbrand" required>
      <option value="Acer" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Acer") echo "selected"; ?>>Acer</option>
        <option value="Asrock"<?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Asrock") echo "selected"; ?>>Asrock</option>
        <option value="Asus"<?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Asus") echo "selected"; ?>>Asus</option>
        <option value="Biostar"<?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Biostar") echo "selected"; ?>>Biostar</option>
        <option value="Gigabyte"<?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Gigabyte") echo "selected"; ?>>Gigabyte</option>
        <option value="Msi"<?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Msi") echo "selected"; ?>>Msi</option>
        <option value="Raspberry"<?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Raspberry") echo "selected"; ?>>Raspberry</option>
      </select>
       </div>
        </div>

      <div class="form-group">
          <label for="productmodel" class="col-sm-3 control-label">Model</label>
          <div class="col-sm-9">
      <input name="model" type="text" class="form-control" id="productmodel" placeholder="Product Model" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_MODEL']; ?>" required>
       </div>
        </div>

     <div class="form-group">
          <label for="productquantity" class="col-sm-3 control-label">Quantity</label>
          <div class="col-sm-9">
      <input name="quantity" type="text" class="form-control" id="productquantity" placeholder="Product Quantity" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_QUANTITY']; ?>" required>
       </div>
        </div>
     
       <div class="form-group">
          <label for="productyear" class="col-sm-3 control-label">Year</label>
          <div class="col-sm-9">
      <select name="year" class="form-control" id="productyear" required="">
        <option value="2012" <?php if (isset($_GET['edit'])) if($editrow['FLD_YEAR_MANUFACTURED']=="2012") echo "selected";?>>2012</option>
        <option value="2013" <?php if (isset($_GET['edit'])) if($editrow['FLD_YEAR_MANUFACTURED']=="2013") echo "selected";?>>2013</option>
        <option value="2014" <?php if (isset($_GET['edit'])) if($editrow['FLD_YEAR_MANUFACTURED']=="2014") echo "selected";?>>2014</option>
        <option value="2015" <?php if (isset($_GET['edit'])) if($editrow['FLD_YEAR_MANUFACTURED']=="2015") echo "selected";?>>2015</option>
        <option value="2016"<?php if (isset($_GET['edit'])) if($editrow['FLD_YEAR_MANUFACTURED']=="2016") echo "selected";?>>2016</option>
        <option value="2017"<?php if (isset($_GET['edit'])) if($editrow['FLD_YEAR_MANUFACTURED']=="2017") echo "selected";?>>2017</option>
        <option value="2018"<?php if (isset($_GET['edit'])) if($editrow['FLD_YEAR_MANUFACTURED']=="2018") echo "selected";?>>2018</option>
      </select>
      </div>
        </div>
        <div class="form-group">
          <label for="productimage" class="col-sm-3 control-label">Upload</label>
          <div class="col-sm-9">
         <input type="file" name="fileToUpload" id="fileToUpload">
       </div>
       </div>

      <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
     <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['FLD_PRODUCT_ID']; ?>">
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
        <h2>Products List</h2>
      </div>
      <table class="table table-striped table-bordered">
      <tr>
        <th><center>Product ID</center></th>
        <th><center>Name</center></th>
        <th><center>Price(RM)</center></th>
        <th><center>Brand</center></th>
        <th><center>Model</center></th>
        <th><center>Quantity</center></th>
        <th><center>Manufacturing Year</center></th>
        <th><center>Details/Edit/Delete</center></th>
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
        $stmt = $conn->prepare("select * from tbl_products_a161032 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>   
      <tr>
        <td><center><?php echo $readrow['FLD_PRODUCT_ID']; ?></center></td>
        <td><center><?php echo $readrow['FLD_PRODUCT_NAME']; ?></center></td>
        <td><center><?php echo $readrow['FLD_PRICE']; ?></center></td>
        <td><center><?php echo $readrow['FLD_BRAND']; ?></center></td>
        <td><center><?php echo $readrow['FLD_MODEL']; ?></center></td>
        <td><center><?php echo $readrow['FLD_QUANTITY']; ?></center></td>
        <td><center><?php echo $readrow['FLD_YEAR_MANUFACTURED']; ?></center></td>
        <td>
          <center>
          <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <a href="products.php?edit=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="products.php?delete=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a161032");
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
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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