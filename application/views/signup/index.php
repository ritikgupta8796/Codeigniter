<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php $this->load->view('include/signup_css'); ?>

        <div class="outer">
            <div class="inner-main">

                <div class="heading">
                    <h1>Sign Up</h1>
                </div>

                <div class="fields">                   
                    <form class="row g-3" id="signupForm">
                        <div class="col-md-6">
                            <input type="hidden" name="Sno">
                            <label for="Name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Your Name">
                            <span id="NameErr" style="font-size:13px; display:none">d</span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mobile Number</label>
                            <input 
                            type="text" 
                            class="form-control" 
                            id="inputPassword4" 
                            name="Number" 
                            placeholder="Enter Your Mobile Number" 
                            minlength="10" 
                            maxlength="10" 
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="10">

                            <span id="NumberErr" style="font-size:13px; display:none"></span>
                        </div>
                        <div class="col-12">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter Your Email">
                            <span id="EmailErr" style="font-size:13px; display:none;"></span>
                        </div>
                        <div class="col-12">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter Your Password">
                            <span id="PasswordErr" style="font-size:13px; display:none;"></span>
                        </div>
                        <div class="col-md-12">
                            <p class="text-center already">Already a member ? 
                                <span><a href="<?php echo base_url() ?>Login" style="text-decoration:none;">Log In</a></span>
                            </p>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary w-50" id="saveData" onclick="validation()" >Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



















    <?php $this->load->view('include/signup_js') ?>

    <!-- query cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.css">
    <script src="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.js"></script>
     <script>

        function validation(){
            let username = $("#Name").val();
            if(username == ""){
                NameErr.textContent = "Name Is Required";
                NameErr.style.color = "red";
                $("#NameErr").show().fadeOut(3000);
            };
            
            let usernumber = $("#inputPassword4").val();
            if(usernumber == ""){
                NumberErr.textContent = "Mobile Number Is Required";
                NumberErr.style.color = "red";
                $("#NumberErr").show().fadeOut(3000);
            }

            let useremail = $("#Email").val();
            if(useremail == ""){
                EmailErr.textContent = "Email Is Required";
                EmailErr.style.color = "red";
                $("#EmailErr").show().fadeOut(3000);
            }

            let userpassword = $("#Password").val();
            if(userpassword == ""){
                PasswordErr.textContent = "Password Is Required";
                PasswordErr.style.color = "red";
                $("#PasswordErr").show().fadeOut(3000);
            }


            // return returnvalue;
        }



       $('#signupForm').submit(function(event) {
        event.preventDefault();
        // let vaild = validation();
        // if(vaild){
        $.ajax({
                url : '<?php echo base_url() ?>Signup/inserationData',
                type : 'POST',
                dataType : 'json',
                data : $('#signupForm').serialize(),
                success : function(data){
                    if (data.code == 200) {
                            msgshow(data.msg, 'success');
                            window.location.assign("<?php echo base_url('Dashboard') ?>");
                            // tabHide();
                            // fetchData();
                        } else if (data.status = 'error') {
                            msgshow(data.message, 'danger')

                        } else {
                            msgshow('Something Wrong', 'danger')
                        }
                }
            })
        //   }
        });

// library function :---
        function msgshow(msg, code) {
            SnackBar({
                status: code,
                position: "br",
                message: msg
            })
        }
// end of library function :-


// both method are right onclick asb well as id both are samwe 

    // function mySubmit(){
    //     var name = $('input[name="Name"]').val();
    //     var number = $('input[name="Number"]').val();
    //     var email = $('input[name="Email"]').val();
    //     var password = $('input[name="Password"]').val();
    //     // console.log(password);
    //     if(name == '' && number == '' && email == '' && password == '')
    //         return;
        
    //     $.ajax({
    //         url : '<?php // echo base_url() ?>Signup/inserationData',
    //         type : 'POST',
    //         dataType : 'json',
    //         data : {
    //             'Name' : name,
    //             'Number' : number,
    //             'Email' : email, 
    //             'Password' : password
    //         },
    //         success : function(data){
    //            console.log(data); 
    //            if (data.code == 200) {
    //                         msgshow(data.msg, 'success');
    //                         tabHide();
    //                         fetchData();
    //                     } else if (data.status = 'error') {
    //                         msgshow(data.message, 'danger')

    //                     } else {
    //                         msgshow('Something Wrong', 'danger')
    //                     }
    //         }
    //     })
    // }


    </script>


</body>
</html>