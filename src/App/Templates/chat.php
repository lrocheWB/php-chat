<!DOCTYPE html">
<html>
    <head>
        <title>Login Form</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/form.css">
    </head>
    <body>
        <div id="token_container" value="<?php echo $_SESSION["token"]; ?>"></div>
        <div id="user_id_container" value="<?php echo $_SESSION["uid"]; ?>"></div>
        <div id="wrapper">
            <div id="container">
                <div id="bar">
                    <a href="./logout?csrf=<?php echo $_SESSION["token"]; ?>" id="logout"><span>Logout</span></a>
                </div>
                <div id="title"><h1>PHP Chat</h1></div>
                <div id="chat">
                    <div id="msg_cont">
                        <div id="messages"></div>
                    </div>
                    <div id="input_msg">
                        <textarea id="msg" name="msg" autofocus="autofocus" placeholder="To add a new line press shift + enter."></textarea>
                    </div>
		</div>

		<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="js/chat.js"></script>
            </div>
        </div>
    </body>
</html>
