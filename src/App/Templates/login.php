<!DOCTYPE html">
<html>
    <head>
        <title>Login Form</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/form.css">
    </head>
    <body>
        <div id="wrapper">
            <div id="container">
                <div id="title">
                    <h1>Login Form</h1>
                </div>
                <div class="error">
                    <ul>
                    <?php
                        if (!empty($_SESSION['login_errors'])) {
                            foreach($_SESSION['login_errors'] as $error) {
                                echo "<li>".$error."</li>";
                            }
                        }
                    ?>
                    </ul>
                </div>
                <?php
                    if (isset($_GET['register']) && !empty($_GET['register'])) {
                        echo "<div><p id='message'>You have been registered successfully! You can now login.</p></div>";
                    }
                ?>
                <form action="./submit-login-form" method="POST">
                    <input type="text" name="uname" id="uname" placeholder="Username">
                    <input type="password" name="passwd" id="passwd" placeholder="Password">
                    <input type="submit" name="submit" id="submit_login" value="Login">
                    <div id="register_link"><p>Don't have a user account? <a href="./register" title="Click to Register">Register here!</a></p></div>
                </form>
            </div>
        </div>
    </body>
</html>
