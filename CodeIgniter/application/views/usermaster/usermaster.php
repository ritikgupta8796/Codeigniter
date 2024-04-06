<div class="content-inner w-100">
    <section class="p-0">
        <div class="ps-2 pe-2 ">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button onclick="tabHide()" class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">User Data</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add Data</button>
                </div>
            </nav>
            <div class="tab-content " id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <!--  -->
                    <div class="shadow rounded-3 card mt-1 " style=" height: 125px; margin-left: 0px; margin-right: 0px; ">
                        <div class="container  mt-2 ps pe-5" style="padding-left: 2rem!important; padding-right: 2rem!important; margin-top: -0.2rem!important;">
                            <form action="../usermaster/index.php" method="POST" class="pt-4" id="userSearch">
                                <div class="row justify-content-around">
                                    <div class="col-12 col-md-3 ">
                                        Name :<input type="text" name="search_name" id="search_name" class="form-control form-control-sm shadow-sm " oninput="this.value = this.value.replace(/[^A-Za-z.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="20" autofocus>
                                    </div>
                                    <div class="col-12 col-md-3 col-" style="margin-left: -30px;">
                                        Email :<input type="email" name="search_email" id="search_email" class="form-control form-control-sm shadow-sm" oninput="validateEmail(this)" maxlength="35">
                                    </div>
                                    <div class="col-12 col-md-3" style="margin-left: -30px;">
                                        Phone Number :<input type="text" name="search_number" id="search_number" class="form-control form-control-sm shadow-sm" maxlength="10" onpaste="return false;" ondrop="return false;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="10">
                                    </div>
                                    <div class="col-12 col-md-1">
                                        <button class="btn btn-primary  mt-4 text-light" name="filter_val" type="submit" style="height: 34px; margin-top: 23.5px!important; width: 100px; margin-left: -30px; padding-top: 3px;"><a class="text-light fs-5" style="text-decoration : none; margin-top: -7px!important;">Search</a></button>
                                    </div>

                                    <div class="col-12 col-md-1">
                                        <button id="submitReset" class="btn btn-danger mt-4 text-light" name="filter_val" type="submit" style="height: 34px; margin-top: 23.5px!important; width: 100px; margin-left: -30px; padding-top: 3px;"><a class="text-light fs-5" style="text-decoration : none; margin-top: -5px!important;" onclick="resetdata()">Reset</a></button> <!--<i class="fa fa-remove"></i>-->
                                    </div>
                                </div>
                            </form>
                            <?php
                            ?>
                        </div>
                    </div>

                    <div class="ps-0 pe-2 rounded card" style="margin-top: -15px">
                        <div class="conatiner shadow rounded ps-2 pe-2">
                            <!--  -->
                            <!--  -->
                            <!-- <input type="hidden" id="sort_type" value="asc" class="change"> -->
                            <div class="flex gap-2 m-2">
                                <div class="font-semibold text-base capitalize" style="font-size: 15px;">Number of Record :</div>
                                <div class="font-semibold text-base border-2 rounded pl-5" style="margin-left: 88px; margin-top: -25px;">
                                    <select id="limit" class="px-2" onchange="fetchData()"><!--onchange="fetchData()"-->
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="sort_type" class="change" value="asc" name="sort_type">
                            <input type="hidden" id="order_by" class="order_by" value="desc" name="order_by">
                            <!-- table -->
                            <div>
                                <table class="table table-bordered table-bordered bg-light" id="table-data">
                                    <thead>
                                        <tr class="text-center" style="color: #0074d9;">
                                            <th scope="col"><b>S No.</b></th>
                                            <th scope="col" onclick="typeChange('Name');" data-id="Name" style="cursor:pointer;"><b> Name</b><i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i></th>

                                            <th scope="col" onclick="typeChange('Email');" data-id="Email" style="width:40%;cursor:pointer;"><b>Email</b><i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i></th>

                                            <th scope="col" onclick="typeChange('Phone');" style="cursor:pointer;"><b>Phone</b>
                                                <i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i>
                                            </th>
                                            <th colspan="2" class="text-center" style="width:15%;"><b>Action</b></th>
                                        </tr>
                                    </thead>
                                    <tbody id="userMasterData"></tbody>
                                </table>

                                <div id="pagination"></div>
                                <input class="" type="hidden" id="page_number" value="1">
                            </div>


                            <div class="row" id="showarr"></div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <div class="container mt-5 ">
                        <form id="AddUserData">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="">
                                        Name <span class="text-danger">*</span><input type="text" name="name" class="form-control form-control-sm shadow-sm" id="s_name" oninput="this.value = this.value.replace(/[^A-Za-z.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="20" autofocus>
                                        <span id="u_name" style="font-size:13px; display:none"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="">
                                        Email <span class="text-danger">*</span><input type="email" name="email" class="form-control form-control-sm shadow-sm " id="s_email" oninput="validateEmail(this)" maxlength="50">
                                        <span id="u_email" style="font-size:13px; display:none"></span>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="">
                                        Phone Number <span class="text-danger">*</span><input type="text" minlength="10" name="number" class="form-control form-control-sm shadow-sm" id="s_number" maxlength="10" onpaste="return false;" ondrop="return false;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="10">
                                        <span id="u_number" style="font-size:13px; display:none"></span>
                                    </div>
                                </div>
                                <div class="col-md-3" id="userpassword">
                                    <div class="">
                                        <span><input type="hidden" name="hidden_2" id="hidden_2"></span>
                                        <span><input type="hidden" name="hiddenpassword" id="hiddenpassword"></span>
                                        Password<span class="text-danger" id="passwordStar">*</span><input type="password" name="password" id="s_password" class="form-control form-control-sm shadow-sm" placeholder="Enter Your Password" maxlength="35">
                                        <span id="u_password" style="font-size:13px; display:none"></span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="form_action" id="form_action" value="add">
                            <input type="hidden" name="Sno" id="Sno">
                            <div class="container mt-4">
                                <div class="row">
                                    <button class="btn btn-primary col-md-1 col-12" name="save" id="save_data" type="submit" value="Save">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ajax -->


    <link rel="stylesheet" href="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.css">
    <script src="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.js"></script>
    <script type="text/javascript">
        // Inserting Data:---------------------------------------------------------------------------------
        $('#AddUserData').submit(function(event) {
            event.preventDefault();
            let ret = validation();
            if (ret) {
                $.ajax({
                    url: '<?php echo base_url() ?>Usermaster/insertingData',
                    data: $('#AddUserData').serialize(),
                    type: 'POST',
                    dataType: 'json',
                    success: function(data){
                        if (data.code == 200) {
                            msgshow(data.msg, 'success');
                            tabHide();
                            fetchData();
                        } else if (data.status = 'error') {
                            msgshow(data.message, 'danger')

                        } else {
                            msgshow('Something Wrong', 'danger')
                        }
                    }
                })
            }
        });

        // Fetch the Data :-------------------------------------------------------------------------------
        $(document).ready(function() {
            // fetchData();
            $('#userSearch').on('submit', function(e) {
                e.preventDefault();
                fetchData();
            });
            fetchData();
        });



        function typeChange(column_name) {
            let order = $("#sort_type").val();
            if (order == 'asc') {
                $("#sort_type").val('desc');
                $(".arrow_up").show();
                $(".arrow_down").hide();

            } else {
                $("#sort_type").val('asc');
                $(".arrow_down").show();
                $(".arrow_up").hide();
            }
            fetchData('', '', column_name);
        };
        //=================================================================================================
        function fetchData(page_num = '', type = '', columnName = '') {
            var usercloumnName = columnName;
            // alert(usercloumnName);
            var tableSortType = $('#sort_type').val();

            var name = $('#search_name').val();
            var email = $('#search_email').val();
            var number = $('#search_number').val();
            var limit = $("#limit").val();
            var last_page = $("#last").attr('data-page');
            if (type == 'pagi') {
                var p = $(page_num).attr('data-page');
            } else {
                var p = '1';
            }
            $.ajax({
                url: '<?php echo base_url() ?>Usermaster/fetchingData',
                type: 'POST',
                data: {
                    columnName: usercloumnName,
                    sort_type: tableSortType,

                    search_name: name,
                    search_email: email,
                    search_number: number,
                    limit: limit,
                    page_num: p,
                    // sortType: tableSortType,
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.status == 200) {
                        $("#showarr").html('')
                        $('#userMasterData').html(data.table);
                        $('#pagination').html(data.pagi);
                        var next_page = parseInt(p) + 1;
                        var prev_page = parseInt(p) - 1;
                        if (p == '1') {
                            $("#prev").css('display', 'none');
                        } else {
                            $('#prev').attr('data-page', parseInt(prev_page));
                        }
                        if (p == last_page) {
                            $("#next").css('display', 'none');
                        } else {
                            $('#next').attr('data-page', parseInt(next_page));
                        }
                    } else if (data.status == 300) {
                        $('#pagination').html('');
                        $('#userMasterData').html('');
                        $("#showarr").html(data.table)
                    }

                }
            });
        }
        // ------------------------------------------------------------------------------------------------
        function getTotalRecords() {
            $.ajax({
                url: '<?php base_url() ?>Usermaster/getTotalRecords',
                type: 'POST',
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                }
            });
        }
        // ------------------------------------------------------------------------------------------------
        function msgshow(msg, code) {
            SnackBar({
                status: code,
                position: "br",
                message: msg
            })
        }
        // --------------------------Delete----------------------------------------------------------------
        function UserDelete(id) {
            var data = id;
            if (confirm("Are You Want To Delete?")) {
                $.ajax({
                    url: '<?php base_url() ?>Usermaster/userdDlt',
                    type: 'POST',
                    data: {
                        id: data
                    },
                    dataType: 'json',
                    success: function(data) {
                        // alert("Data Delete Successfully");
                        // location.reload();
                        if (data.code = 200) {
                            msgshow(data.msg, 'danger')
                            fetchData();
                        } else {
                            msgshow(data.msg, 'danger')
                            fetchData();
                        }
                    }
                })
            }
        }
        // -UpdateQuery------------------------------------------------------------------------------------
        function UserEdit(Sno) {
            // if (confirm("Are You Want To Update Details?")) {
            $.ajax({
                url: '<?php echo base_url() ?>Usermaster/UserEdit',
                type: 'POST',
                dataType: 'json',
                data: {
                    Sno: Sno
                },
                success: function(data) {
                    console.log(data);
                    tabshow();
                    document.getElementById("Sno").value = data[0]['Sno'];
                    document.getElementById("s_name").value = data[0]['Name'];
                    document.getElementById("s_email").value = data[0]['Email'];
                    document.getElementById("s_number").value = data[0]['Phone'];
                    document.getElementById("hiddenpassword").value = data[0]['Password'];
                    document.getElementById("s_password").value;
                    document.getElementById("hidden_2").value = data[0]['password_2'];
                    $("#passwordStar").hide();
                    document.getElementById("form_action").value = "edit";
                    $("#save_data").html("Update");
                }
            })
            // }
        };
        // ================================================================================================
        function tabshow() {
            document.getElementById('nav-profile-tab').innerHTML = "Edit User";
            $("#nav-home").removeClass("show active");
            $("#nav-profile").addClass("active show");
            $("#nav-home-tab").removeClass("active");
            $("#nav-profile-tab").addClass("active");
            $("#nav-home-tab").attr('aria-selected', 'false');
            $("#nav-profile-tab").attr('aria-selected', 'true');
            $("#save_data").html("Update");
        }
        // ================================================================================================
        function tabHide() {
            document.getElementById('nav-profile-tab').innerHTML = "Add Data"; //Add User
            $("#nav-home").addClass("show active");
            $("#nav-profile").removeClass("active show");
            $("#nav-home-tab").addClass("active");
            $("#nav-profile-tab").removeClass("active");
            $("#nav-home-tab").attr('aria-selected', 'true');
            $("#nav-profile-tab").attr('aria-selected', 'false');
            document.getElementById("s_name").value = "";
            document.getElementById("s_email").value = "";
            document.getElementById("s_number").value = "";
            document.getElementById("s_password").value = "";

            // document.getElementById("passwordStar").show();
            document.getElementById("Sno").value = '';
            $("#save_data").html("Save");
        }
        // ========================================================================================

        function resetdata() {
            // document.getElementById("search_user_name").value = "";
            document.getElementById("search_name").value = "";
            document.getElementById("search_email").value = "";
            document.getElementById("search_number").value = "";
            fetchData();
        }

        //-----------------------------------------------------------------------------------------
        function validateEmail(input) {
            input.value = input.value.replace(/[^A-Za-z0-9.@]/g, '');
            input.value = input.value.replace(/(\..*)\./g, '$1');
        }
        // ----------------------------------------------------------------------------------------
        function validation() {
            let returnval = true;
            let username = $("#s_name").val();
            let userpassword = $("#s_password").val();
            let useremail = $("#s_email").val();
            let usernumber = $("#s_number").val();
            let sno = document.getElementById("Sno").value;

            if (username == '') {
                u_name.textContent = "  Name is required ";
                u_name.style.color = "red";
                $("#u_name").show().fadeOut(3000);
                returnval = false;
            };

            if (useremail == '') {
                u_email.textContent = "  Email is required ";
                u_email.style.color = "red";
                $("#u_email").show().fadeOut(3000);
                returnval = false;
            };

            if (usernumber == '') {
                u_number.textContent = "  Phone Number is required ";
                u_number.style.color = "red";
                $("#u_number").show().fadeOut(3000);
                returnval = false;
            };

            if (sno == '') {
                if (userpassword == '') {
                    u_password.textContent = "Password is required";
                    u_password.style.color = "red";
                    $("#u_password").show().fadeOut(3000);
                    returnval = false;
                }
            }
            return returnval;
            //-------------------------------------------------------------------------------------------------
        };
    </script>