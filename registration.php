<?php
include 'config.php';
$randno = rand();

if (isset($_POST['submit'])) {
    $sqlregistorcount = mysql_fetch_array(mysql_query("SELECT count(*) as countdata from  registation "));
    if ($sqlregistorcount['countdata'] == '0') {
        if ($_POST['varyficationcode'] == $_POST['veryfication_code']) {
            $sql = mysql_query("insert into registation set
		                    fullname =md5('" . $_POST['fullname'] . "'), 
		                    fulladdress = md5('" . $_POST['fulladdress'] . "'),
		                    purchase_code = md5('" . $_POST['purchase_code'] . "'), 
		                    veryfication_code = md5('" . $_POST['veryfication_code'] . "'),
		                    domainName = md5('" . $_POST['domainName'] . "'),
		                    emailId = md5('" . $_POST['emailId'] . "')
		                    ") or die(mysql_error());

            if ($sql) {
                $email = "creditcoperativeactivation@gmail.com";
                $to = $email;
                $subject = "Confirmation Mail";
                $message = "Hi '" . $_POST['fullname'] . "'";
                $message .= "This is your veryfication code :  '" . $_POST['veryfication_code'] . "'";
                $message .= "This is your domain Name :  '" . $_POST['domainName'] . "'";
                $message .= "This is your purchase code : '" . $_POST['domainName'] . "'";
                $message .= "Thank You.";
                $header = "From:creditcoperativeactivation@gmail.com \r\n";
                $retval = mail($to, $subject, $message, $header);

                if ($retval == true) {
                    header("location:index.php");
                } else {
                    header("location:registration.php");
                    $_SESSION["errormsg"] = "Message could not be sent...Please Register";
                }
            }
        } else {
            $_SESSION["errormsg"] = "Your verification Code dose not match";
        }
    } else {

        $_SESSION["errormsg"] = 'You are alredy Registered';
    }
}


/*$sqlregistorcount = mysql_fetch_array(mysql_query("SELECT count(*) as countdata from  registation "));

if ($sqlregistorcount['countdata'] == '0') {
    //header("location:registration.php");
} else {
    header("location:index.php");
}*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="CSS/plugins/iCheck/square/blue.css">

        <script type="text/javascript">

            function myFunction()
            {
                // alert("sdg");
            }
        </script>
    </head>
    <body class="hold-transition login-page">

        <div class="login-box">

            <div class="login-logo">
                <a href="#">
                    <b>Product</b>Registration</a>
            </div>
            <!-- /.login-logo -->

            <div class="login-box-body">

                <p class="login-box-msg"><b>Register a product</b></p>

                <div id='alert'><div  style="height:20px; text-align:center;color:red"><?php
if (isset($_SESSION["errormsg"])) {
    $error = $_SESSION["errormsg"];
    session_unset($_SESSION["errormsg"]);
} else {
    $error = "";
}

echo $error;
?></div></div> 

                <form  role="form" method="post"  enctype="multipart/form-data" onsubmit="myFunction()" >

                    <div class="form-group has-feedback">

                        <input type="text" class="form-control" placeholder="Full Name"  required name="fullname" id="fullname">

                        <span class="glyphicon glyphicon-user form-control-feedback"></span>

                    </div>

                    <div class="form-group has-feedback">

                        <input type="text" required name="fulladdress" id="fulladdress" class="form-control" placeholder="Full Address">
                        <input type="hidden" required name="varyficationcode" id="varyficationcode" value="<?php echo $randno; ?>" style="display: none;">

                        <span class="glyphicon glyphicon-home form-control-feedback"></span>

                    </div>
                    <div class="form-group has-feedback">

                        <input type="text"  required name="domainName" id="domainName" class="form-control" placeholder="Domain Name">

                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    </div>
                    <div class="form-group has-feedback">

                        <input type="email" required name="emailId" id="emailId" class="form-control" placeholder="Email" onblur="emailfunction(this.value)">
                        <div id="errormsg" style="color:red; display: none;" >Message could not be sent...</div>
                        <div id="succesmsg" style="color:green; display: none;" >Message sent successfully...</div>
                        <div id="emptysmsg" style="color:red; display: none;" >Please Enter email Address...</div>

                        <span class="glyphicon glyphicon-envelope form-control-feedback" ></span>
                        <span class="glyphicon glyphicon-envelope form-control-feedback" ></span>

                    </div>
                    <div class="form-group has-feedback">

                        <input type="text" required name="veryfication_code" id="veryfication_code" class="form-control" placeholder="Verification Code" oninput="setveryficationcode(this.value)" >

                        <span class="glyphicon glyphicon-check form-control-feedback"></span>

                    </div>
                    <div class="form-group has-feedback">

                        <input type="text" required name="purchase_code" id="purchase_code" class="form-control" placeholder="Purchase Code">

                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>

                    </div>
                    <div class="row">

                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-4">

                            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat" >OK</button>

                        </div>
                    </div>

                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <script src="CSS/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="CSS/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="CSS/plugins/iCheck/icheck.min.js"></script>
        <script id="test" type="application/json" src="http:/myresources/stuf.json"></script>
        <script type="text/javascript">

            function emailfunction(val)
            {
                var email = val;
                var varificationcode = $("#varyficationcode").val();
                if (email == '')
                {
                    $("#emptysmsg").show();
                    setTimeout(function () {
                        $('#emptysmsg').fadeOut()
                    }, 2000);
                } else
                {
                    $.ajax({
                        url: 'email_ajax.php',
                        data: {email: email, varificationcode: varificationcode},
                        type: 'post',
                        success: function (output)
                        {
                            if (output == 1)
                            {
                                $("#succesmsg").show();
                                setTimeout(function () {
                                    $('#succesmsg').fadeOut()
                                }, 2000);
                            } else
                            {
                                $("#varyficationcode").show();
                                $("#errormsg").show();
                                setTimeout(function () {
                                    $('#errormsg').fadeOut()
                                }, 2000);
                            }

                        }
                    });
                }
            }
        </script>
        <script type="text/javascript">

            function setveryficationcode(val)
            {
                var verifycode = val;
                var varificationcode = $("#varyficationcode").val();

                $.ajax({
                    url: 'saveregistationajax.php',
                    data: {verifycode: verifycode, varificationcode: varificationcode},
                    type: 'post',
                    success: function (output)
                    {
                        //	alert(output);
                    }
                });

            }
        </script>
        <!-- <script type="text/javascript">
                function myregistation()
                {
        
                var verifycode = val;
            var varificationcode = $("#varyficationcode").val();
        
                }
        </script>
        -->

    </body>



</html>
