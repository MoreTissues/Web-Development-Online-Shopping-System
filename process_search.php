<?php

include_once 'auth.php';
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['search_form'])) {
  $keyword = $_POST['keyword'];
}
else if (isset($_GET["page"])) {
  $keyword = $_GET["key"];
}

?>

 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>List of Results</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>
  <?php include_once 'nav_bar.php'; ?>

<div class="container-fluid">
      <div class="row">

        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2 style="text-align: center">Search Results <a href="index.php" class="btn btn-info btn btn-primary btn-sm" role="button">View All Products</a></h2>

      </div>


<div class="row">

  <?php 
   $per_page = 9;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page; 

  try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM tbl_products_a161032 WHERE ";
        
        $sql = $sql." FLD_PRODUCT_ID like '%$keyword%' or ";
        $sql = $sql." FLD_PRODUCT_NAME like '%$keyword%' or ";
        $sql = $sql." FLD_BRAND like '%$keyword%' or ";
        $sql = $sql." FLD_MODEL like '%$keyword%' or ";
        $sql = $sql." FLD_YEAR_MANUFACTURED like '%$keyword%' LIMIT $start_from, $per_page";
       

        $stmt = $conn->prepare("$sql");
        $stmt->execute();
        $result = $stmt->fetchAll();

        
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }

    foreach($result as $readrow) {
  ?>

  <div class="col-sm-6 col-md-4">
    
    <div class="thumbnail">
      <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="list-group-item"> 
      <?php if ($readrow['FLD_PRODUCT_IMAGE'] == "" ) {
        echo "No image";
      }
      else { ?>
      <img src="products/<?php echo $readrow['FLD_PRODUCT_IMAGE'] ?>" class="img-responsive" style="width: 100%;">
      <?php } ?>
      
      <div class="caption" style="height: 330px; width: 320px">
        <h3 style="padding-right: 40px "><?php echo $readrow['FLD_PRODUCT_NAME']; ?></h3>
        <p>ID: <?php echo $readrow['FLD_PRODUCT_ID']; ?></p>
        <p>Price: RM<?php $num = $readrow['FLD_PRICE']; 
        $formattedNum = number_format($num, 2);
        echo $formattedNum; ?></p>
        <p>Brand: <?php echo $readrow['FLD_BRAND']; ?></p>
        <p>Model: <?php echo $readrow['FLD_MODEL']; ?></p>
        <p>Year Manufactured: <?php echo $readrow['FLD_YEAR_MANUFACTURED']; ?></p>
      </div>

    </a>
    </div>
    
  </div>

    <?php
      }
      $conn = null;
      ?>
      </div>
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

        $sql = "SELECT * FROM tbl_products_a161032 WHERE ";
        $sql = $sql." FLD_PRODUCT_ID like '%$keyword%' or ";
        $sql = $sql." FLD_PRODUCT_NAME like '%$keyword%' or ";
        $sql = $sql." FLD_BRAND like '%$keyword%' or ";
        $sql = $sql." FLD_MODEL like '%$keyword%' or ";
        $sql = $sql." FLD_YEAR_MANUFACTURED like '%$keyword%'";

            $stmt = $conn->prepare("$sql");
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
            <li><a href="process_search.php?page=<?php echo $page-1 ?>&key=<?php echo $keyword ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"process_search.php?page=$i&key=$keyword\">$i</a></li>";
            else
              echo "<li><a href=\"process_search.php?page=$i&key=$keyword\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="process_search.php?page=<?php echo $page+1 ?>&key=<?php echo $keyword ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>

</div>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>