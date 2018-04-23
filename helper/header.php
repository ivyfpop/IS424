<head>
    <!-- Check for login. -->
    <?php
        // Start the session
        session_start();

        // If the user is not logged in, redirect them to the login page.
        if (!isset($_SESSION['member_ID'])){
            echo("<meta http-equiv='refresh' content='0;url=login.php'>");
        }
    ?>
    <!-- END Login Check -->

    <!-- meta values -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- END meta values-->

    <!-- Bootstrap / Core CSS -->
    <link href="helper/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <link href="helper/styles.css" rel="stylesheet">
    <!-- End Bootstrap / Core CSS -->

    <!-- navigation bar -->
    <nav class='navbar navbar-expand navbar-dark bg-dark'>

        <div class='collapse navbar-collapse'>
        
            <a class='navbar-brand' href='index.php'><img src='/helper/images/website/WTC-Logo-Updated-2015-white-cow.png' width='100' height='100'></a>
            
            <!-- Left Nav Bar -->
            <div class='navbar-nav'>
                <a class='nav-link btn btn-outline-info' href='index.php'>Home</a>
                <a class='nav-link btn btn-outline-info ml-3' href='functions.php'>My Events</a>
                <a class='nav-link btn btn-outline-info ml-3' href='myTransactions.php'>My Transactions</a>
                <a class='nav-link btn btn-outline-info ml-3 disabled' href='eventManagement.php'>Event Management</a>
                <a class='nav-link btn btn-outline-info ml-3 disabled' href='transactionManagement.php'>Transaction Management</a>
                <a class='nav-link btn btn-outline-info ml-3 disabled' href='accountManagement.php'>Account Management</a>
            </div>
            <!-- END Left Nav Bar -->

            <!-- Right Nav Bar -->
            <div class='navbar-nav ml-auto'>
                <a class='nav-link btn btn-outline-warning mr-3' href='accountPanel.php'>My Account Panel</a>
                <form action='helper/accountHelper.php' name='logout' method='post'>
                    <button class="nav-link btn  btn-outline-danger mr-3" type="submit" name='logout' value='logout'>Logout</button>
                </form>
            </div>
            <!-- END Right Nav Bar -->
        </div>
    </nav>
    <!-- END of Navigation Bar -->
</head>
