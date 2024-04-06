  <?php $this->load->view('include/header_1'); ?>

<section class="p-0">
    <div class="ps-2 pe-2 ">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button onclick="tabHide()" class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Client Data</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add Client</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <!-- Search Bar Area -->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <!--Start Of SearchBox Content-->
                <div class="shadow rounded-3 card mt-1" style=" height: 125px; margin-left: 0px; margin-right: 0px;">
                    <div class="container mt-2 ps pe-5" style="padding-left: 2rem!important;  padding-right: 2rem!important; margin-top: -0.2rem!important;">
                        <form action="" method="POST" id="client_search_form" class="pt-4">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3 ">
                                    Name :<input type="text" name="c_search_name" id="c_search_name" class="form-control form-control-sm shadow-sm " oninput="this.value = this.value.replace(/[^A-Za-z.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="20" autofocus>
                                </div>

                                <div class="col-12 col-md-3 " style="margin-left: -0px;">
                                    Email :<input type="text" name="c_search_email" id="c_search_email" class="form-control form-control-sm shadow-sm "  oninput="validateEmail(this)" maxlength="35">
                                </div>

                                <div class="col-12 col-md-3 w-25">
                                    Mobile Number :<input type="text" name="c_search_phone" id="c_search_phone" class="form-control form-control-sm shadow-sm " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="10">
                                </div>

                                <div class="col-12 col-md-2">
                                    <button class="btn btn-primary  mt-4 text-light" name="" type="submit" style="height: 34px; margin-top: 23.5px!important; width: 100px; margin-left: -10px; padding-top: 3px;">Search</button>
                                </div>
                                <!-- Reset -->
                                <div class="col-12 col-md-1" style="margin-left: -100px;">
                                    <button id="submitReset" class="btn btn-danger mt-4 text-light" name="" type="submit" style="height: 34px; margin-top: 23.5px!important; width: 100px; margin-left: 25px; padding-top: 3px;" onclick="resetdata()">Reset</button>
                                </div>
                                <!-- reset -->
                            </div>
                        </form>
                    </div>
                </div>

                <div class="ps-0 pe-2 rounded card" style="margin-top: -15px">
                    <div class="conatiner shadow rounded ps-2 pe-2">
                        <input type="hidden" id="" value="" class="change">
                        <div class="flex gap-2 m-2">
                            <div class="font-semibold text-base capitalize" style="font-size: 15px;">Number
                                of record : </div>
                            <div class="font-semibold text-base border-2 rounded pl-5" style="margin-left: 85px; margin-top: -25px;">
                                <select id="limit" class="px-2" onchange="fetchData()">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="sort_type" class="change" value="asc" name="sort_type">
                        <input type="hidden" id="order_by" class="order_by" value="desc" name="order_by">
                        <div>
                            <table class="table table-bordered table-bordered bg-light" id="table-data">
                                <thead>
                                    <tr class="text-center" style="color: #0074d9;">
                                        <th style="width: 70px;" class="text-center"><b>S No.</b></th>
                                        <th onclick="typeChange('client_name');" style="cursor: pointer;"><b>Name</b>
                                        <i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i></th>
                                        <th style="width: 200px; cursor: pointer;" onclick="typeChange('client_email');"><b>Email</b>
                                        <i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i></th>
                                        <th onclick="typeChange('client_phone');" style="cursor: pointer;"><b>Phone</b>
                                        <i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i></i></th>
                                        <th style="cursor: pointer;"><b>Address</b></th>
                                        <th style="cursor: pointer;"><b>Country</b></th>
                                        <th style="cursor: pointer;"><b>State</b></th>
                                        <th style="cursor: pointer;"><b>City</b></th>
                                        <th colspan="2"><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody id="userMasterData"></tbody>

                            </table>
                            <div id="pagination"></div>
                            <!--  -->
                            <input class="" type="hidden" id="" value="1">
                        </div>

                        <div class="row" id="showarr">


                        </div>
                    </div>
                </div>
            </div>
            <!--End Of SearchBox  -->


            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="container mt-5 ">
                    <form action="" id="clientmaster_form">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="">
                                    Name <span class="text-danger">*</span>
                                    <input type="text" name="client_add_name" id="client_add_name" class="form-control form-control-sm shadow-sm" oninput="this.value = this.value.replace(/[^A-Za-z.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="20" autofocus>
                                    <span id="u_name" style="font-size:13px; display:none"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="">
                                    Email <span class="text-danger">*</span>
                                    <input type="email" name="client_add_email" id="client_add_email" class="form-control form-control-sm shadow-sm" oninput="validateEmail(this)" maxlength="35">
                                    <span id="u_email" style="font-size:13px; display:none"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="">
                                    Phone Number <span class="text-danger">*</span>
                                    <input type="text" name="client_add_phone" id="client_add_phone" class="form-control form-control-sm shadow-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="10">
                                    <span id="u_phones" style="font-size:13px; display:none"></span>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="">
                                    Address <span class="text-danger">*</span>
                                    <input type="text" name="client_add_address" id="client_add_address" class="form-control form-control-sm shadow-sm" maxlength="70">
                                    <span id="u_address" style="font-size:13px; display:none"></span>
                                </div>
                            </div>

                            <div class="col-md-4 " id="country_div">
                                <label for="" style="margin-bottom: -1.5rem;">Country</label><span class="text-danger">*</span>
                                <select name="country" id="country" class="form-control form-control-sm shadow-sm">
                                    <option value="" id="select_country">Select Country</option>
                                    <?php
                                    // print_r($countries);
                                    if (!empty($countries)) {
                                        foreach ($countries as $key => $country) {
                                    ?>
                                            <option value="<?php echo $country['id'] ?>"> <?php echo $country['names'] ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <span id="u_c_country" style="font-size:13px; display:none"></span>
                            </div>

                            <div class="col-md-4" id="statebox_1">
                                <label for="" style="margin-bottom: -1.5rem;">State</label><span class="text-danger">*</span>
                                <div id="stateBox">
                                    <select name="state" id="state" class="form-control form-control-sm shadow-sm">
                                        <option value="">Select State</option>
                                    </select>
                                    <!-- <span id="u_c_state" style="font-size:13px; display:none"></span> -->
                                </div>
                                <span id="u_c_state" style="font-size:13px; display:none"></span>
                            </div>

                            <div class="col-md-4 " id="city_div">
                                <label for="" style="margin-bottom: -1.5rem;">City</label><span class="text-danger"> *</span>
                                <div id="citiesBox">
                                    <select name="city" id="city" class="form-control form-control-sm shadow-sm">
                                        <option value="">Select City</option>
                                    </select>
                                    <!-- <span id="u_c_city" style="font-size:13px; display:none"></span> -->
                                </div>
                                <span id="u_c_city" style="font-size:13px; display:none"></span>
                            </div>

                            <!-- <div class="col-md-4 mb-2">
                            </div> -->

                            <div class="col-md-4 mt-4 text-start">
                                <button class="btn btn-primary col-md-3 col-12" onclick="validation()" name="" id="save_data" type="submit" value="Save">Save</button>
                            </div>

                        </div>

                        <input type="hidden" name="form_action" id="form_action" value="add">
                        <input type="hidden" name="client_id" id="client_id">
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<?php $this->load->view('include/footer_1'); ?>

<link rel="stylesheet" href="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.css">
<script src="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.js"></script>

<!-- AJAX Start Below -->
<script type="text/javascript">
    function msgshow(msg, code) {
        SnackBar({
            status: code,
            position: "br",
            message: msg
        })
    }
    // ------------------------------------------------------------------------------------------------
    // Fetch The Data :
    $(document).ready(function() {
        fetchData();
        // getTotalRecords();
        $('#client_search_form').on('submit', function(e) {
            e.preventDefault();
            fetchData();
        });
    });
    // ------------------------------------------------------------------------------------------------
    function getTotalRecords() {
        $.ajax({
            url: '<?php base_url() ?>Clientmaster/getTotalRecords',
            type: 'POST',
            dataType: 'json',
            success: function(result) {
                // console.log(result);
            }
        });
    }

    function typeChange(column_name){
            let order = $("#sort_type").val();
            if (order == 'asc') {
                $("#sort_type").val('desc');
                $(".arrow_up").show();
                $(".arrow_down").hide();
            }else {
                $("#sort_type").val('asc');
                $(".arrow_down").show();
                $(".arrow_up").hide();
            }
            fetchData('', '', column_name);
};



    // ------------------------------------------------------------------------------------------------
    function fetchData(page_num = '', type = '', columnName = '') {
        var usercloumnName = columnName;
        var tableSortType = $('#sort_type').val();
        var name = $('#c_search_name').val();
        var email = $('#c_search_email').val();
        var phone = $('#c_search_phone').val();
        var limit = $("#limit").val();
        var last_page = $("#last").attr('data-page');
        if (type == 'pagi') {
            var p = $(page_num).attr('data-page');
        } else {
            var p = '1';
        }
        $.ajax({
            url: '<?php base_url() ?>Clientmaster/fetch_data',
            type: 'POST',
            data: {
                columnName: usercloumnName,
                sort_type: tableSortType,

                c_search_name: name,
                c_search_email: email,
                c_search_phone: phone,
                limit: limit,
                page_num: p
            },
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                if (data.status = 200) {
                    $("#showarr").html('');
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
                }
                else if (data.status == 300) {
                        $('#pagination').html('');
                        $('#userMasterData').html('');
                        $("#showarr").html(data.table);
                    }
            }
        });
    }
    // ------------------------------------------------------------------------------------------------
    function validateEmail(input) {
            input.value = input.value.replace(/[^A-Za-z0-9.@]/g, '');
            input.value = input.value.replace(/(\..*)\./g, '$1');
    }


    function validation() {
        // Username:-
        clientname = $("#client_add_name").val();
        if (clientname == '') {
            u_name.textContent = "Name is required";
            u_name.style.color = "red";
            $("#u_name").show().fadeOut(3000);
        };
        // useremail:-
        clientemail = $("#client_add_email").val();
        if (clientemail == '') {
            u_email.textContent = "Email is required";
            u_email.style.color = "red";
            $("#u_email").show().fadeOut(3000);
        };
        // usernumber:-
        clientnumber = $("#client_add_phone").val();
        if (clientnumber == '') {
            u_phones.textContent = "Phone Number is required";
            u_phones.style.color = "red";
            $("#u_phones").show().fadeOut(3000);
        };
        // address:-
        clientaddress = $("#client_add_address").val();
        if (clientaddress == '') {
            u_address.textContent = "Address is required";
            u_address.style.color = "red";
            $("#u_address").show().fadeOut(3000);
        };
        // country:-
        clientcountry = $("#country").val();
        if (clientcountry == '') {
            u_c_country.textContent = "Country is required";
            u_c_country.style.color = "red";
            $("#u_c_country").show().fadeOut(3000);
        };
        // state:-
        clientstate = $("#state").val();
        if (clientstate == '') {
            u_c_state.textContent = "State is required";
            u_c_state.style.color = "red";
            $("#u_c_state").show().fadeOut(3000);
        };
        // city:-
        clientcity = $("#city").val();
        if (clientcity == '') {
            u_c_city.textContent = "City is required";
            u_c_city.style.color = "red";
            $("#u_c_city").show().fadeOut(3000);
        };
    };
    // --------------------------------Inserting Query-------------------------------------------------
    $('#clientmaster_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '<?php echo base_url() ?>Clientmaster/create_2',
            data: $('#clientmaster_form').serialize(),
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if (data.code === 200) {
                    msgshow(data.msg, 'success')
                    fetchData();
                    tabHide();
                }
                else if (data.status = 'error') {
                    msgshow(data.message, 'danger')

                } else {
                    msgshow('Something Wrong', 'danger')
                }
            }
        });
    });
    //-------------------------------------------------------------------------------------------------
    $(document).ready(function() {
        $('#country').change(function() {
            var country_id = $(this).val();
            // alert(country_id);
            $.ajax({
                url: '<?php echo base_url() ?>Clientmaster/getstate',
                type: 'POST',
                data: {
                    country_id: country_id
                },
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    if (response['states']) {
                        $('#stateBox').html(response['states']);
                    }
                }
            })
        })
        // ================================================================================================
        $(document).on("change", "#state", function() {
            var state_id = $(this).val();
            // alert(state_id);
            $.ajax({
                url: '<?php echo base_url() ?>Clientmaster/getcities',
                type: 'POST',
                data: {
                    state_id: state_id
                },
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    if (response['cities']) {
                        $('#citiesBox').html(response['cities']);
                    }
                }
            })
        })
    });
    //-----------------Delete Query :------------------------------------------------------------------
    function clientdelete(id) {
        var data = id;
        // alert("Your Delete Query is : " + data);
        if (confirm("Are You Sure Want To Delete?")) {
            $.ajax({
                url: '<?php base_url() ?>Clientmaster/clientdelete',
                type: 'POST',
                data: {
                    id: data
                },
                dataType: 'json',
                success: function(data) {
                    // location.reload();
                    if (data.code === 200) {
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

    //-------------------------Update Query -----------------------------------------------------------
    function clientupdate(id) {
        // if (confirm("Are You Want To Update Details?")) {
        $.ajax({
            url: '<?php echo base_url() ?>Clientmaster/clientupdate',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                // console.log(data);
                // alert("Update Successfully");
                tabshow();
                document.getElementById("client_id").value = data[0]['id'];
                document.getElementById("client_add_name").value = data[0]['client_name'];
                document.getElementById("client_add_email").value = data[0]['client_email'];
                document.getElementById("client_add_phone").value = data[0]['client_phone'];
                document.getElementById("client_add_address").value = data[0]['client_address'];
                document.getElementById("country").value = data[0]['contid'];

                getstates(data[0]['contid'], data[0]['stateid']);
                document.getElementById("state").value = data[0]['stateid'];

                getcities(data[0]['stateid'], data[0]['citiid'])
                document.getElementById("city").value = data[0]['citiid'];

                document.getElementById("form_action").value = "edit";
                $("#save_data").html("Update");
            }
        })
        // }
    }
    // ------------------------------------------------------------------------------------------------
    function getstates(country_id, id) {
        $.ajax({
            url: '<?php echo base_url() ?>Clientmaster/getstate',
            type: 'POST',
            data: {
                country_id: country_id
            },
            dataType: 'json',
            success: function(response) {
                // console.log(response);
                if (response['states']) {
                    $('#stateBox').html(response['states']);
                    $('#state').val(id);
                }
            }
        })
    }
    // ------------------------------------------------------------------------------------------------
    function getcities(state_id, id) {
        $.ajax({
            url: '<?php echo base_url() ?>Clientmaster/getcities',
            type: 'POST',
            data: {
                state_id: state_id
            },
            dataType: 'json',
            success: function(response) {
                if (response['cities']) {
                    $('#citiesBox').html(response['cities']);
                    $('#city').val(id);
                }
            }
        })
    }
    // ------------------------------------------------------------------------------------------------
    function tabshow() {
        document.getElementById('nav-profile-tab').innerHTML = "Edit Data";
        $("#nav-home").removeClass("show active");
        $("#nav-profile").addClass("active show");
        $("#nav-home-tab").removeClass("active");
        $("#nav-profile-tab").addClass("active");
        $("#nav-home-tab").attr('aria-selected', 'false');
        $("#nav-profile-tab").attr('aria-selected', 'true');
        $("#save_data").html("Update");
    }
    // ------------------------------------------------------------------------------------------------
    function tabHide() {
        $("#nav-show").html("Add User");
        // $("#client_add_name").val("");

        $("#nav-home").addClass("show active");
        $("#nav-profile").removeClass("active show");
        $("#nav-home-tab").addClass("active");
        $("#nav-profile-tab").removeClass("active");
        $("#nav-home-tab").attr('aria-selected', 'false');
        $("#nav-profile-tab").attr('aria-selected', 'true');

        document.getElementById('nav-profile-tab').innerHTML = "Add Client";
        $("#client_id").val("");
        $("#client_add_name").val("");
        $("#client_add_email").val("");
        $("#client_add_phone").val("");
        $("#client_add_address").val("");
        $("#country").val("");
        $("#state").val("");
        $("#city").val("");
        $("#save_data").html("Save");
        // $("#form_action").val("add");
        // $("#country_div, #state_div, #city_div").show();
        // $("#save_data").html("Save");
    };
    // ================================================================================================

    function resetdata(){
        document.getElementById("c_search_name").value = "";
        document.getElementById("c_search_email").value = "";
        document.getElementById("c_search_phone").value = "";
    }
</script>