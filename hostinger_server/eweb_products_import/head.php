<?php
session_start();
if(!isset($_SESSION['user_id']))
{
  ?>
    <script>
            window.location.href='<?php echo Client_site_url ?>/eweb_products_import/login.php';
    </script>
  <?php
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eWeb SOAP Service Calls</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">eWeb SOAP Service Calls</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="test.php">Test</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="lastUpload.php">Last Uploaded</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="allActive.php">All Active</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="searchBySKU.php">Search By SKU</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="searchByText.php">Search By Text</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="searchByPrice.php">Search By Price</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="webOrder.php">Web Order</a>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link" href="update_catch_inventory.php">Update Inventory Catch</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="password_change.php">Change Password</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>

            </ul>            
        </div>
    </nav>

    <main role="main" class="container mt-3">