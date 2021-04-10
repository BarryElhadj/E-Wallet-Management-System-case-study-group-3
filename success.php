<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>E-Wallet Management System</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/pricing/">

    
    <link href="assets/css/custom.css" rel="stylesheet"  crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet"  crossorigin="anonymous">

    <!-- Favicons -->


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
<body>
<?php include "header.php";
session_start();
require_once "config.php";
?>
 <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <div class="m-5 mb-3 text-center">
      <h2>Sent Successful!!!</h2>
    
      <a href="transactions.php">View All Transactions--></a>
      <a href="welcome.php"><--Go To HomePage</a>
    </div>
 </div>
</body>
</html>