<?php

 include_once 'auth.php';
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>MothaBoards : SEARCH</title>

  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

  <?php include_once 'nav_bar.php'; ?>

  <div class="container-fluid">

  	<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Search For Your Desire Motherboard Product Here</h2>
      </div>

      <br>

      <form class="form-inline" action="process_search.php" method="post">
      	<center>
      		<div class="col-sm">
      			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Type somethings here ..." style="width: 80%" required autofocus>
      			<button class="btn btn-default" type="submit" name="search_form" id="btn_search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Search</button>
      		</div>
      	</center>	
      </form>
      
      <br>
      <hr>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>