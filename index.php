<?php
session_start();
?>
<html>

<title>BlackBoard</title>

<head>

    <!--        Linking libraries-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.js"></script>

    <!--         This should be the last line in head-->
    <link rel="stylesheet" href="assets/css/home.css">
    <script type="text/javascript" src="assets/javascript/index.js"></script>


</head>


<body>

    <div class="main_div">
        <div class="left_div">

            <div class="lcontent">
                <section class="logoname">
                    <label class="logolabel">BlackBoard</label>
                </section>
            </div>

        </div>
        <div class="ui vertical divider">
        </div>

        <div class="right_div">
            <div class="rcontent">

                <section class="login">

                    <div class="ui input focus">
                        <input type="text" id="username" placeholder="UserEmail">
                    </div>

                    <div class="ui input focus">
                        <input type="password" id="password" placeholder="Password">
                    </div>


                    <div class="ui checkbox ">
                        <input type="checkbox" id="ch_admin">
                        <label id="admin_ch" for="ch_admin">Login as Admin</label>
                    </div>

                    <button id="btn_login" class="ui inverted yellow button">Login</button>

                    <label class="label"> OR </label>

                    <button id="btn_register" class="ui inverted yellow button">Register</button>

                </section>

            </div>
        </div>
    </div>


    <div class="ui mini modal">
        <div class="header">Login Failed</div>
        <div class="content">
            <p>Invalid Email / Password. Please try again</p>
        </div>
        <div class="actions">
            <div class="ui cancel button">Try again !</div>
        </div>
    </div>



</body>

</html>
