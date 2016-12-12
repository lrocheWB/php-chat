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
                    <h1>Register Form</h1>
                </div>
                <div class="error">
                    <ul>
                    <?php
                        if (!empty($_SESSION['register_errors'])) {
                            foreach($_SESSION['register_errors'] as $error) {
                                echo "<li>".$error."</li>";
                            }
                        }
                    ?>
                    </ul>
                </div>
                <form action="./submit-register-form" method="POST">
                    <input type="text" name="uname" id="uname" placeholder="Username">
                    <input type="password" name="passwd" id="passwd" placeholder="Password">
                    <input type="submit" name="submit" id="submit_login" value="Register">
                    <div id="login_link"><p>Already have an account? <a href="./login" title="Click to Login">Login here!</a></p></div>
                </form>
            </div>
        </div>
    </body>
</html>
