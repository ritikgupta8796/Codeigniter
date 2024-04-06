<?php $this->load->view('include/header_1'); ?>

<section class="pt-0">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button onclick="tabHide()" class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Item Data</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Add Item</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active pt-2 ps-2 pe-2" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="container-fluid card shadow rounded-1 pt-4" style="    padding-top: 0.5rem!important;">
                <div class="container  mt-2 ps pe-5" style="padding-left: 2rem!important; padding-right: 2rem!important;">
                    <form action="#" id="item_search">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="">
                                    Item Name :<input type="text" name="item_Name" id="item_Name" class="form-control shadow-sm w-100" oninput="this.value = this.value.replace(/[^A-Za-z.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="20" autofocus>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    Price :<input type="text" name="item_Price" id="item_Price" class="form-control shadow-sm w-100" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="6">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    Description :<input type="text" name="item_Desc" id="item_Desc" class="form-control shadow-sm w-100">
                                </div>
                            </div>
                            <div class="col-md-2 mb-5">
                                <div class="col-12 col-md-2">
                                    <button onclick="showitemmaster()" class="btn btn-primary mt-4 text-light" type="submit" style="height: 34px; margin-top: 23.5px!important; width: 100px; margin-left: -18px; padding-top : 3px;"><a class="text-light fs-5" style="text-decoration : none; margin-top: -5px!important;">Search</a></button>
                                </div>
                            </div>
                            <!-- Reset -->
                            <div class="col-md-1 mb-5">
                                <div class="col-12 col-md-1">
                                    <button class="btn btn-danger mt-4 text-light" type="submit" style="height: 34px; margin-top: 23.5px!important; width: 100px; margin-left: -80px; padding-top : 3px;" onclick="resetdata()"><a class="text-light fs-5" style="text-decoration : none; margin-top: -5px!important;">Reset</a></button>
                                </div>
                            </div>
                            <!-- Reset -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="ps-0 pe-2 rounded" style="margin-top: -15px">
                <div class="conatiner card shadow rounded ps-2 pe-2">
                    <input type="hidden" id="sort_type" value="asc" class="change">
                    <div class="flex gap-2 m-2">
                        <div class="font-semibold text-base capitalize" style="font-size: 15px;">Number of
                            record :</div>
                        <div class="font-semibold text-base border-2 rounded pl-5" style="margin-left: 85px; margin-top: -25px;">
                            <select id="limit" class="px-2" onchange="fetchData();">
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
                        <table id="datalist" class="table table-bordered table-bordered bg-light">
                            <thead>
                                <tr class="text-center" style="color: #0074d9;">
                                    <th scope="col"><b>SNo</b></th>
                                    <th scope="col" onclick="typeChange('item_name');" style="cursor:pointer;"><b>Item
                                            Name</b><i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i></th>
                                    <th scope="col"  style="cursor:pointer;"><b>Price</b></th>
                                    <th scope="col" style="width:30%; cursor:pointer;"><b>Description</b></th>
                                    <th scope="col" onclick=""><b>Image</b>
                                    </th>
                                    <th colspan="2" class="text-center" style="width:15%;"><b>Action</b></th>
                                </tr>
                            </thead>

                            <tbody id="itemmasterdata"> </tbody>
                        </table>
                        <!-- <div id="page_number_view"> </div> -->
                        <div id="pagination"></div>

                        <input class="" type="hidden" id="page_number" value="1">
                    </div>
                    <div class="row" id="showarr"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade ps-4 pe-4" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="container-fluid  mt-2 rounded-1 pt-2 ">
                <form id="itemform" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 col-12 mb-2">
                            <div class="">
                                Item Name <span class="text-danger">*</span><input type="text" name="i_name" id="i_name" class="form-control shadow-sm w-100" oninput="this.value = this.value.replace(/[^A-Za-z.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="30">
                                <span id="itm_name" style="font-size:13px; display:none"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div class="">
                                Price <span class="text-danger">*</span><input type="text" name="i_price" id="i_price" class="form-control shadow-sm w-100" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="7">
                                <span id="itm_price" style="font-size:13px; display:none"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div class="">
                                Description <span class="text-danger">*</span><textarea class="form-control shadow-sm" placeholder="Describe Only 200 Words" name="i_desc" id="i_desc" style="height: 100px" maxlength="200"></textarea>
                                <span id="itm_desc" style="font-size:13px; display:none"></span>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">A</div> -->
                        <!-- <div class="col-md-6">B</div> -->
                        <div class="col-md-6 col-12 mb-5 pt-5 ps-4 pe-4 mb-2">
                            <!--style="border: 1px solid red"-->
                            <small>Upload Image <span class="text-danger">* (Note: Supported Image Extension .jpg .png
                                    and Maximum Size: 10 MB)</span></small>
                            <input type="file" name="image" id="image_input" accept="image/''"><span class="text-danger"></span>
                        </div>
                        <input type="hidden" name="sno" id="sno">
                        <input type="hidden" name="form_action" id="form_action" value="add">
                        <button class="btn btn-primary mb-1 col-md-1 col-12" id="save_data" onclick="validation();" type="submit">Save</button>
                    </div>
                    <div class="row" id="viewimageupload">
                        <div class="col-6"></div>
                        <div class="col-6 text-end d-none preview">
                            <img src="" alt="" id="image_show" style="height : 150px; width: 150px;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('include/footer_1.php'); ?>

<link rel="stylesheet" href="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.css">
<script src="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.js"></script>
<script>
    function msgshow(msg, code) {
        SnackBar({
            status: code,
            position: "br",
            message: msg
        })
    }
    // ------------------------------------------------------------------------------------------------
    function validation() {
        // ItemName:-
        itemname = $("#i_name").val();
        if (itemname == '') {
            itm_name.textContent = "  Name is required ";
            itm_name.style.color = "red";
            $("#itm_name").show().fadeOut(3000);
        };
        // ItemPrice:-
        itemprice = $("#i_price").val();
        if (itemprice == '') {
            itm_price.textContent = "  Name is required ";
            itm_price.style.color = "red";
            $("#itm_price").show().fadeOut(3000);
        };
        // ItemDescription:-
        itemprice = $("#i_desc").val();
        if (itemprice == '') {
            itm_desc.textContent = "  Name is required ";
            itm_desc.style.color = "red";
            $("#itm_desc").show().fadeOut(3000);
        };
    }
    // ------------------------------------------------------------------------------------------------
    // $(document).ready(function() {

    $("#itemform").on("submit", function(event) {
        var data = new FormData(this);
        console.log(data);
        event.preventDefault();
        $.ajax({
            url: '<?php echo base_url() ?>Itemmaster/insert_item',
            method: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(result) {
                // location.reload(true);
                if (result.code == 200) {
                    msgshow(result.msg, 'success')
                    fetchData();
                    // tabHide();
                    $("#home-tab-pane").addClass("show active");
                    $("#profile-tab-pane").removeClass("active show");
                    $("#home-tab").removeClass("active");
                    $("#profile-tab").addClass("active");
                    $("#home-tab").attr('aria-selected', 'false');
                    $("#profile-tab").attr('aria-selected', 'true');
                } else if (result.status == 'error') {
                    msgshow(result.message, 'danger')

                } else {
                    msgshow('Something Wrong', 'danger')
                }
            },
        });
    });
    // ------------------------------------------------------------------------------------------------
    $(document).ready(function() {
        fetchData();
        getTotalRecords();
        $('#item_search').on('submit', function(e) {
            e.preventDefault();
            fetchData();
        });
    });
    // ------------------------------------------------------------------------------------------------
    function getTotalRecords() {
        $.ajax({
            url: '<?php echo base_url() ?>Itemmaster/getTotalRecords',
            type: 'POST',
            dataType: 'json',
            success: function(result) {
                // alert("result");
                console.log(result);
            }
        })
    }
    // ------------------------------------------------------------------------------------------------

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

    // ------------------------------------------------------------------------------------------------
    function fetchData(page_num = '', type = '', columnName = '') {
        var usercloumnName = columnName;
        var tableSortType = $('#sort_type').val();

        var name = $('#item_Name').val();
        var email = $('#item_Price').val();
        var phone = $('#item_Desc').val();
        var limit = $("#limit").val();
        var last_page = $("#last").attr('data-page');
        if (type == 'pagi') {
            var p = $(page_num).attr('data-page');
        } else {
            var p = '1';
        }
        $.ajax({
            url: '<?php base_url() ?>Itemmaster/fetchData',
            type: 'POST',
            data: {
                columnName: usercloumnName,
                sort_type: tableSortType,

                item_Name: name,
                item_Price: email,
                item_Desc: phone,
                limit: limit,
                page_num: p
            },
            dataType: 'json',
            success: function(data) {

                if (data.status == 200) {
                    $("#showarr").html('');
                    $('#itemmasterdata').html(data.table);
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
                } else if ((data.status == 300)) {
                    $('#pagination').html('');
                    $('#itemmasterdata').html('');
                    $("#showarr").html(data.table);
                }

                // $('#itemmasterdata').html(data.table);
                // $('#pagination').html(data.pagi);
                // var next_page = parseInt(p) + 1;
                // var prev_page = parseInt(p) - 1;
                // if (p == '1') {
                //     $("#prev").css('display', 'none');
                // } else {
                //     $('#prev').attr('data-page', parseInt(prev_page));
                // }
                // if (p == last_page) {
                //     $("#next").css('display', 'none');
                // } else {
                //     $('#next').attr('data-page', parseInt(next_page));
                // }
            }
        });
    }
    //-------------------------------------------------------------------------------------------------
    function itemdelete(id) {
        var data = id;
        if (confirm("Are You Sure Want To Delete?")) {
            $.ajax({
                url: '<?php base_url() ?>Itemmaster/itemdelete',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: data
                },
                success: function(data) {
                    // alert("Delete Successfully !");
                    // location.reload(true);
                    if (data.code = 200) {
                        msgshow(data.msg, 'danger')
                        fetchData();
                    } else {
                        msgshow(data.msg, 'danger')
                        fetchData();
                    }
                }
            });
        }
    }
    //-------------------------------------------------------------------------------------------------
    function itemupdate(id) {
        var data = id;
        $.ajax({
            url: "<?php base_url() ?>Itemmaster/item_data_update",
            method: "POST",
            data: {
                id: data
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                // print_r(data);die;
                tabshow();
                var imagepath = "<?php echo base_url() ?>uploads/";
                // var finalpath = imagepath+imagename;
                // console.log(imagepath);
                $('#sno').val(data[0]['id']);
                $('#i_name').val(data[0]['item_name']);
                $('#i_price').val(data[0]['item_price']);
                $("#i_desc").val(data[0]['item_desc']);
                // debugger
                $("#image").val(data[0]['item_image']);
                $(".preview").removeClass("d-none");
                $("#image_show").attr('src', imagepath + data[0]['item_image']);
                $("#save_data").html("Update");
                // $("#dno").val()
            }
        });
    };
    // ------------------------------------------------------------------------------------------------
    function tabshow() {
        document.getElementById('profile-tab').innerHTML = "Edit User";
        $("#home-tab-pane").removeClass("show active");
        $("#profile-tab-pane").addClass("active show");
        $("#home-tab").removeClass("active");
        $("#profile-tab").addClass("active");
        $("#home-tab").attr('aria-selected', 'false');
        $("#profile-tab").attr('aria-selected', 'true');

        $("#save_data").html("Update");
    }
    // ------------------------------------------------------------------------------------------------
    function tabHide() {
        document.getElementById('profile-tab').innerHTML = "Add Item";
        document.getElementById("i_name").value = "";
        document.getElementById("i_price").value = "";
        document.getElementById("i_desc").value = "";
        document.getElementById("sno").value = "";
        // document.getElementById("image").value = "";
        $(".preview").addClass("d-none");


        // document.getElementById("image_input").value = "";
        // document.getElementById("viewimageupload").style.display = "none";
        // document.getElementById("viewimageupload").value = "";
        $("#save_data").html("Save");
    }


    function resetdata(){
        // alert();
        document.getElementById("item_Name").value = "";
        document.getElementById("item_Price").value = "";
        document.getElementById("item_Desc").value = "";
    }
</script>