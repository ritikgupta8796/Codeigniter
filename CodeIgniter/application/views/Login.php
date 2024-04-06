
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.css">

    <style type="text/css">
        .card0 {
            box-shadow: 0px 4px 8px 0px #757575;
            border-radius: 0px; }
        .card2 {
            margin: 0px 40px; }

        .border-line {
            border-right: 1px solid #EEEEEE; }
        input,
        textarea{
            padding: 10px 12px 10px 12px;
            border-color: lavender;
            border-radius: 2px;
            margin-bottom: 5px;
            margin-top: 2px;
            width: 100%;
            font-size: 14px;
            letter-spacing: 1px; }
    </style>
</head>

<body style="background-color: gray">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto " style="boder:0px;">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="shadow-lg pb-5">
                        <div class="row">
                            <img src="<?php echo base_url('/assets/using_image/sansoftwares_logo.png') ?>" style=" width: 670px; height: 100px; margin-top: 20px;margin-left: 35px;">
                        </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                            <img src="<?php echo base_url('/assets/using_image/image.png') ?>" class="image" style="width: 360px;height: 280px;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3">
                            <!-- <h6 class="mb-0 mr-4 mt-2">San Softwares privated limited</h6> -->
                            <div class="facebook text-center mr-3">
                                <div class="fa fa-facebook"></div>
                            </div>
                        </div>

                        <!-- <div class="row px-3 mb-4">
                            <div class="line" style=" height: 2px;width: 45%;background-color: #E0E0E0;margin-top: 10px;"></div>
                            <small class="or text-center"></small>
                            <div class="line"></div>
                        </div> -->

                        <form action="<?php echo base_url('Login/checkuserpassword') ?>" id="loginform" method="post">
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Email Address <span style="color: red;">*</span></h6>
                                </label>
                                <input class="mb-4" type="text" name="email" id="email" placeholder="Enter a valid email address" onkeyup="ValidateEmail();">
                                <span id="Error" style="color: red; font-size: 13px;"></span>
                                <span id="email_v" style="font-size:13px; display:none"></span>
                            </div>
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Password <span style="color: red;">*</span></h6>
                                </label>
                                <input type="password" name="password" id="password" placeholder="Enter password" class="shadow-sm">
                                <span id="pass_v" style="font-size:13px; display:none"></span>
                                <span id="alert" class="mt-2" style="display:none;">
                                    <?php echo $err ?>
                                </span>
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="row mb-3 px-3 mt-3">
                                    <input type="button" onclick="chekuserpassword();Validation();" class="btn btn-primary shadow-sm" value="Login" style="width:150px;">
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>


    <script src="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="<?=base_url()?>/assets/js/jquertlatest.js"></script>
<script>

function msgshow(msg, code) {
            SnackBar({
                status: code,
                position: "br",
                message: msg
            })
        }



    function chekuserpassword() {
        var action = $("#loginform").attr('action');
        console.log(action)
        var formElem = document.getElementById('loginform');
        var formData = new FormData(formElem);
        $.ajax({
            url: action,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                if (data.code == 200) {
                    window.location.assign("<?php echo base_url('Dashboard') ?>");
                }
                else {
                            msgshow(data.msg, 'danger')
                }
            }
        })
    }

    function Validation() {
        email = $("#email").val();
        if (email == '') {
            email_v.textContent = "Email is required ";
            email_v.style.color = "red";
            $("#email_v").show().fadeOut(3000);
        } else {
            email_v.textContent = "";
        }
        password = $("#password").val();
        if (password == '') {
            pass_v.textContent = "Password is required ";
            pass_v.style.color = "red";
            $("#pass_v").show().fadeOut(3000);
        } else {
            pass_v.textContent = "";
        }
    }

    function ValidateEmail() {
        var email = document.getElementById("email").value;
        var Error = document.getElementById("Error");
        Error.innerHTML = "";
        var keys = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!keys.test(email)) {
            Error.innerHTML = "* Invalid Email Address.";
            $("#Error").show().fadeOut(3000);
        }
    }
</script>



</html>