<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified Materialize JavaScript -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
      
  <title>Address Book</title>
   
</head>

<body>

  <div class="nav-container"> 
    <nav>
      <div class="nav-wrapper container">
        <a href="index.php" class="brand-logo">Address Book</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger right-aligned"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a class='btn' href="add.php">Add Address</a></li>
          <li><a href="index.php">Address List</a></li>
        </ul>
      </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
      <li><a class='btn' href="add.php">Add Address</a></li>
      <li><a href="index.php">Address List</a></li>
    </ul>
          
  </div>