<html lang="en">

    <title>WTC Login</title>

    <!-- Check current session state -->
    <?php
        // Start the session
        session_start();

        // If the user is already logged in, redirect them to the index
        if (isset($_SESSION['admin_Status'])){
            echo("<meta http-equiv='refresh' content='0;url=index.php'>");
            exit;
        }
        // Otherwise, check their log in credentials
        else if($_POST['login']){
            // Connect to the database, run query, close connection
            include 'helper/connect.php';		
            $result = mysqli_query($db,"SELECT member_ID,admin_Status,first_Name,last_Name,email FROM MEMBER WHERE email = '$_POST[email]' AND password = '$_POST[password]'");
            mysqli_close($db);

            //Verify that the there is a user and store the session data if so.
            if($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
                // Start the session, store data and go to index
                session_start();
                $_SESSION['member_ID'] = $row['member_ID'];
                $_SESSION['admin_Status'] = $row['admin_Status'];
                $_SESSION['first_Name'] = $row['first_Name'];
                $_SESSION['last_Name'] = $row['last_Name'];
                $_SESSION['email'] = $row['email'];
                echo"<meta http-equiv='refresh' content='0;url=index.php'>";
            }
            // Login credentails were wrong; inform the user.
            else echo"<meta http-equiv='refresh' content='0;url=../login.php?login_error=1'>";
        }
    ?>		
    <!-- End Session State Check -->

    <!-- Dependencies -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="helper/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="helper/css/login.css" rel="stylesheet">
    <!-- END Dependencies -->

    <body>
    
        <!-- Login Form -->
        <form class="form-signin" action='login.php' name='login' method='post'>

            <div class="text-center mb-4">
                <img class="mb-4" src="helper/images/website/WTC-Logo-Updated-2015-white-cow.png">
            </div>
        
            <?php
                // If the login attempt triggered an error, inform the user.
                if(isset($_GET['login_error'])){
                    echo"
                    <div class='form-lablel-group text-center alert alert-danger'>
                        <strong>Incorrect Login Credentials!</strong>
                    </div>";
                }
                else if(isset($_GET['new_account'])){
                     echo"
                    <div class='form-lablel-group text-center alert alert-success'>
                        <strong>Congratualations, please log to finish account creation!</strong>
                    </div>";
                   
                }
            ?>
            
            <!-- Login Form Fields -->
            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name='email' placeholder="Email Address" required autofocus>
                <label for="inputEmail">Email Address</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name='password' placeholder="Password" required>
                <label for="inputPassword">Password</label>
            </div>
            <!-- END Login Form Field -->
            
            <button class="btn btn-lg btn-success btn-block" type="submit" name='login' value='login'>Login</button>

            <a class="btn btn-lg btn-warning btn-block" href="signup.php" role="button">Sign Up!</a>

        </form>
        <!-- END Login Form -->

    </body>
</html>