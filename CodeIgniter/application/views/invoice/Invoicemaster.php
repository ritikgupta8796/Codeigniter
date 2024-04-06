<?php $this->load->view('include/header_1'); ?>


<?php

// echo $this->db->count_all_results('invoicemaster');
// $sql = "select id from invoicemaster";
// $res = $query_execute->total_rows($sql);
//

?>
<!--  -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button onclick="tabHide()" class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All Invoice</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Add Invoice</button>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <!-- <form action="" id="myform"> -->
  <div class="tab-pane fade show active ps-2 pe-2 mt-2" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
    <div class="container-fluid mt-1 shadow rounded-3 card  " style="padding-bottom: 2rem!important; padding-top: 1rem!important;">
      <div class="container  mt-2 ps pe-5" style="padding-left: 2rem!important; padding-right: 2rem!important;">
        <form action="" id="myform">
          <!-- form -->
          <div class="row ">

            <!-- <div class="col-md-2">
            Invoice Number<input type="text" name="search_user_id" class="form-control shadow-sm  w-100" id="search_user_id">
          </div> -->
            <div class="col-12 col-md-3 w-25">
              Client Name :<input type="text" name="search_user_name" class="form-control form-control-sm shadow-sm" id="search_user_name" oninput="this.value = this.value.replace(/[^A-Za-z.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="20">
            </div>
            <div class="col-12 col-md-3 w-50">
              Email :<input type="text" name="search_user_email" class="form-control form-control-sm shadow-sm" id="search_user_email" oninput="validateEmail(this)" maxlength="35">
            </div>
            <!-- <div class="col-md-2">
            Phone<input type="text" name="search_user_phone" class="form-control shadow-sm w-100" id="search_user_phone">
          </div> -->

            <div class="col-12 col-md-3 w-50">
              <button id="submitSearch" class="btn btn-primary w-50  h-50  mt-4 text-light" type="button" style="padding-top: 3px; height: 34px;"><a class="text-light fs-5 pb-2" style="text-decoration : none; margin-top: -5px!important;" onclick="fetchData()">Search</a></button>

            </div>
            <div class="col-12 col-md-3 w-50" style="margin-left: -70px;">
              <button id="submitReset" class="btn btn-danger w-50  mt-4 text-light" type="button" style="width: 95px; height: 34px; margin-left: -50px; padding-top: 3px;"><a class="text-light fs-5 pb-2" style="text-decoration : none; " onclick="resetdata()">Reset</a></button>

            </div>

            <!-- <div class="col-md-4" style="border: 1px solid gray">
                mn
            </div> -->
          </div>

      </div>
      </form>
    </div>
    <div class="container-fluid card " style="margin-top: -15px">
      <input type="hidden" id="sort_type" value="asc" class="change">
      <div class="flex gap-2 m-2">
        <div class="font-semibold text-base capitalize" style="font-size: 15px;">Number of record :</div>
        <div class="font-semibold text-base border-2 rounded" style="margin-left: 130px; margin-top: -25px;">
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
        <table class="table table-bordered table-bordered bg-light">
          <thead>
            <tr class="text-center" style="color: #0074d9;">
              <th scope="col"><b>S No.</b> </th>
              <th id="table_invoice_id" onclick="typeChange('invoice_id');" style="cursor:pointer;"><b>Invoice Id</b></th>
              <th id="table_invoice_date" onclick="typeChange('invoice_date');" style="cursor:pointer;"><b>Invoice Date</b>
                <i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i>
              </th>
              <th id="table_client_name" onclick="typeChange('client_name');" style="cursor:pointer;"><b>Client Name</b>
                <i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i>
              </th>
              <th id="table_client_email" onclick="typeChange('client_email');" style="cursor:pointer; "><b>Email</b>
                <i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i>
              </th>
              <th id="table_client_address" onclick="sortTable('client_address'); typeChange();" style="cursor:pointer;"><b>Address</b></th>
              <th id="table_total_amount" onclick="typeChange('total_amount');" style="cursor:pointer;"><b>Total Amount</b>
                <i class="fa fa-sort" style="margin-left: 5px; height: 5px;"></i>
              </th>
              <th scope="col" onclick="sortTable('Phone'); typeChange();"><b>PDF</b></th>
              <th scope="col" onclick="sortTable('Phone'); typeChange();"><b>Mail</b></th>
              <th colspan="2" id="table_total_action" onclick="sortTable('action'); typeChange();"><b>Action</b></th>
            </tr>
          </thead>

          <!-- fetch data below -->
          <tbody id="invoiceMasterData"> </tbody>
        </table>
        <div id="pagination"></div>
        <input class="" type="hidden" id="page_number" value="1">
        <!-- pagination above -->
      </div>
      <div class="row" id="showarr"></div>
    </div>
  </div>

  <!-- Modal START -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title text-danger shadow-sm" id="exampleModalLabel"><b>Send Email</b></h5>
        </div>
        <div class="modal-body shadow-sm">
          <form action="" id="">
            <input type="hidden" id="invoiceemailid" name="invoiceemailid" readonly>
            <div class="input-group-sm mt-1">
              <label for=""><b>To </b></label>
              <input type="text" id="invoiceemail" class="form-control form-control-sm shadow-sm" name="invoiceemail" onkeyup="mailValidateEmail();" readonly/>
              <span id="Error" style="color: red; font-size: 13px;"></span>
              <span id="invoice_email_validation" style="font-size:13px; display:none;"></span>
            </div>
            <div class="input-group-sm mt-0">
              <label for=""><b>cc</b></label>
              <input type="text" id="çc" class="form-control form-control-sm shadow-sm" name="cc" onkeyup="validateemailcc();" />
              <span id="Errorcc" style="color: red; font-size: 13px;"></span>
            </div>
            <div class="input-group-sm mt-0">
              <label for=""><b>Subject</b> </label>
              <input type="text" class="form-control form-control-sm shadow-sm" id="subject" name="subject" readonly>
              <span id="invoice_subject_validation" style="font-size:13px; display:none;"></span>
            </div>
            <div class="input-group-sm mt-3">
              <label for=""><b>Body</b></label>
              <textarea name="body" id="body" cols="10" rows="5" class="form-control shadow-sm" ></textarea>
              <span id="invoice_body_validation" style="font-size:13px; display:none;"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer bg-dark">
          <button type="button" class="btn btn-danger shadow-sm" onclick="validemail(); Getmail()">Send
            Email</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Of Email Modal -->

  <div class="tab-pane fade mt-2 ms-2 me-2" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    <!-- Add Invoice Page Start -->
    <form class="mt-3 p-4 shadow-sm" id="addupdateForm">
      <div class="container-fluid mt-1  card shadow-none rounded-0 ps-3 pe-3 pt-4 pb-5 h-5 " style="height: 252px;">
        <!-- <form action="" method="POST" id="addupdateForm"> -->
        <div class="row mb-4">
          <div class="col-3">
            <p id="changeUpadte">Invoice Number</p>
            <p class="input-group-text shadow-sm" style="width: 60px; margin-top: -10px; height: 30px;">SAN
              <input type="text" id="edit_invoice_number" name="edit_invoice_number" class="form-control form-control-sm shadow-sm text-center" value="" style="width: 70px; margin-left: 11px;" readonly />
            </p>
            <!--
              <p class="card rounded-0 shadow-none w-25"> SAN </p>
            -->
          </div>
          <div class="col-3">
            <label for="">Invoice Date<b class="text-danger">*</b></label>
            <input type="date" id="invoice_date" value="<?php echo date('Y-m-d') ?>" class="form-control form-control-sm shadow-sm" name="invoice_date" />
            <span id="idate" style="font-size:13px ;display:none"></span>
            <input type="hidden" id="type" name="type" value="#addupdate">
          </div>
        </div>
        <!-- end of date and invoice block  -->
        <hr>
        <input type="hidden" name="invoiceid" id="invoiceid">
        <div class="row">
          <!-- AutoComplete -->
          <div class="col-3 pt-2 pb-2">
            <p>Client Name</p>
            <input type="text" name="clientname" id="clientname" value="" class="form-control form-control-sm shadow-sm" onkeyup="clientsearch()" ; placeholder="Client Name" required oninput="this.value = this.value.replace(/[^A-Za-z.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="20">
            <span id="c_name" style="font-size:13px; display:none"></span>
            <input type="hidden" id="clientid" name="clientid">
          </div>
          <!-- End of AutoComplete -->

          <div class="col-3 pt-2 pb-2">
            <p>Email</p>
            <input type="text" name="clientemail" id="clientemail" disabled value="" class="form-control form-control-sm shadow-sm" placeholder="Email" readonly />
            <span id="c_email" style="font-size:13px; display:none;"></span>
          </div>
          <div class="col-3 pt-2 pb-2">
            <p>Phone Number</p>
            <input type="text" name="clientnumber" id="clientnumber" value="" disabled class="form-control form-control-sm shadow-sm" placeholder="Phone Number" readonly />
          </div>
          <div class="col-3 pt-2 pb-2">
            <p>Address</p>
            <input type="text" id="clientaddress" value="" disabled class="form-control form-control-sm shadow-sm" placeholder="Address" name="clientaddress" />
          </div>
        </div>
        <!-- end of it  -->
      </div>
      <!-- </form> -->

      <div class="addMoreTable p-1">
        <table id="pagination_new" class="table  table-hover mt-3 shadow-sm" width="100%">
          <thead>
            <tr>
              <!-- <input class="itemsno" type="hidden" id="isno" name="isno[]" value=""> -->
              <th name="" id="">Item Name</th>
              <th name="" id="">Item Price</th>
              <th name="" id="">Quantity</th>
              <th name="" id="">Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="Trow">
            <tr>

              <!-- Item Name -->
              <td required>
                <input type="text" onkeydown="itemsearch()" class="item_name form-control w-75 form-control-sm item_name" name="item_name[]" placeholder="Item Name" id="itemname" required oninput="this.value = this.value.replace(/[^A-Za-z.]/g, '').replace(/(\..*)\./g, '$1');" / maxlength="20">
                <span id="itemname_valid" style="font-size:13px; display:none;"></span>
                <input class="itemsno" type="hidden" id="isno" name="isno[]">
              </td>
              <!-- Item Price -->
              <td>
                <input type="text" style="text-align:right" class="itemprice form-control w-75 form-control-sm" name="item_price[]" readonly id="itemprice">
                <span id="itemprice_valid" style="font-size:13px; display:none;"></span>
              </td>
              <!-- Item Quanntity -->
              <td>
                <input type="number" min="1" class="form-control w-75 form-control-sm onlynumeric itemquantity amount" name="item_quantity[]" style="text-align:right" id="item_quantity" maxlength="5">
                <span id="itemquntity_validate" style="font-size: 13px; display:none;"></span>
              </td>
              <!-- Total & Item Id -->
              <td>
                <input type="text" class="itemtotal form-control w-75 form-control-sm" name="item_Total[]" readonly id="item_total" style="text-align:right">
                <input type="hidden" name="item_id[]" class="itemid same" id="itemid" onchange="checksame(this);">
              </td>
              <!-- Remove Button -->
              <td align="center">
                <button type="button" class="btn btn-danger btn-sm removeBtn" onClick="removeRow(this)"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <!-- Add More Button -->
              <td colspan="2" align="right">
                <input type="button" class="btn btn-success btn-sm addRow" value="Add More" style="margin-right:700px;" />
              </td>

              <!-- Total Sum  -->
              <td align="right">
                <label for="total_amount"><b> Total Amount </b></label>
              </td>
              <td align="left">
                <input type="text" name="Total_amount" class="form-control w-75 form-control-sm onlynumeric" id="total_amount" value="" style="text-align:right" readonly>
              </td>
              <td>
                <input type="hidden" name="form_action" id="form_action" value="add">
                <button type="button" class="btn btn-primary btn-sm" id="addbtn" onclick=" Addinvoiceitemlist()">Submit </button>
                <button type="button" class="btn btn-info btn-sm" id="updatebtn" style="display:none;" onclick="updateinvoice()">Update</button>
              </td>
            </tr>
            <tr>
              <!-- <td class="text-center">
                <button type="button" class="btn btn-primary btn-sm addRow " style="width: 80px; margin-left: 450px;">
                  <a href="../itemmaster/" style="text-decoration: none; color: white">Add Item</a>
                </button>
              </td> -->
            </tr>
          </tfoot>
          </tbody>
        </table>
      </div>
    </form>
  </div>
</div>

<?php
$this->load->view('include/footer_1');
?>

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
  // $(document).ready(function() {
  $('.addRow').click(function(e) {
    var prnt = $(this).parents('div.addMoreTable');
    var trFrstChild = prnt.find("table tbody tr:first-child");
    var cloneChild = trFrstChild.clone();
    cloneChild.find("input[type='text'],input[type='number'],input[type='hidden'],select,textarea").val('');
    calaculateAmt(this);
    cloneChild.find('.amount').on('change', function() {
      calaculateAmt(this);
    });
    var appendedTo = prnt.find("table tbody").append(cloneChild);
    $('.removeBtn').removeClass('disabled');
  });
  // Amountcal();
  // }
  // );
  // ------------------------------------------------------------------------------------------------
  // function numeric() {
  //   var values = $("#total_amount").val()
  // }
  var calaculateAmt = function(obj) {
    var parentTr = $(obj).parents('tr');
    var price = parseInt(parentTr.find('.itemprice').val());
    var quantity = parseInt(parentTr.find('.itemquantity').val());
    if (isNaN(quantity)) {
      quantity = 0;
    }
    parentTr.find('.itemtotal').val(price * quantity);
    finalCalculation();
  };
  // finalCalculation();

  // function Amountcal() {
  $('.amount').on('change', function() {
    calaculateAmt(this);
  });
  // }

  function finalCalculation() {
    var sum = 0;
    $(".itemtotal").each(function() {
      sum += parseInt($(this).val());
    });
    $("#total_amount").val(sum);
  }

  function removeRow(fld) {
    var prnt = $(fld).closest('.addMoreTable');
    var trLength = prnt.find('table tbody').children('tr').length;
    if (trLength > 1) {
      $(fld).closest('tr').remove();
      finalCalculation()
    } else {
      $(fld).addClass('disabled');
      return false;
    }
  }
  // ------------------------------------------------------------------------------------------------
  // client name autocomplete :-
  function clientsearch() {
    var type = 'clientsearch';
    $("#clientname").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "<?php echo base_url() ?>Invoicemaster/autoClinetSearch",
          dataType: "json",
          async: "false",
          mode: "abort",
          asyn: false,
          type: 'POST',
          data: {
            type: type,
            clientsearch: request.term
          },
          success: function(returnObj) {
            response($.map(returnObj.data, function(item, input) {
              return {
                label: item.name,
                value: item.client_name,
                phon: item.client_phone,
                email: item.client_email,
                address: item.address,
                id: item.id
              }
            }));
          }
        })
      },
      minLength: 0,
      selectFirst: true,
      selectOnly: true,
      select: function(event, ui) {
        $('#clientemail').val(ui.item.email);
        $('#clientnumber').val(ui.item.phon);
        $('#clientaddress').val(ui.item.address);
        $('#clientid').val(ui.item.id);
      }
    }).focus(function() {});
  };

  var input = document.getElementById('clientname');
  input.addEventListener('keydown', function(event) {
    const key = event.key;
    if (key === "Backspace") {
      $('#clientemail').val('');
      $('#clientnumber').val('');
      $('#clientaddress').val('');
      $('#clientid').val('');
    }
  });
  // client Name autocomplete Completed :-
  // ------------------------------------------------------------------------------------------------
  // ITeMSeaRcH :-
  function itemsearch() {
    var type = 'itemsearch';
    $(".item_name").autocomplete({
        source: function(request, response) {
          $.ajax({
            url: "<?php echo base_url() ?>Invoicemaster/autoItemSearch",
            dataType: "json",
            async: "false",
            mode: "abort",
            asyn: false,
            type: 'POST',
            data: {
              type: type,
              itemsearch: request.term
            },
            success: function(returnObj) {
              response($.map(returnObj.data, function(item, index) {
                console.log(index);
                return {
                  label: item.item_name,
                  value: item.item_name,
                  price: item.item_price,
                  id: item.id
                }
              }));
            }
          })
        },
        minLength: 1,
        selectFirst: true,
        selectOnly: true,
        select: function(event, ui) {
          var parentTr = $(this).parents('tr');
          parentTr.find('.itemid').val(ui.item.id).trigger('change');
          parentTr.find('.itemprice').val(ui.item.price).trigger('change');
          parentTr.find('.itemquantity').val(1).trigger('change');
        },
        focus: function(event, ui) {}
      })
      .focus(function() {
        $(this).autocomplete("search");
      });
  }
  // ------------------------------------------------------------------------------------------------:

  // inserting query :-
  function Addinvoiceitemlist() {
    var formElem = document.getElementById('addupdateForm');
    var formData = new FormData(formElem);
    formData.append("type", "addUpdateinvoicemaster");
    $.ajax({
      url: '<?php echo base_url() ?>Invoicemaster/addUpdateinvoicemaster',
      data: formData,
      type: 'POST',
      contentType: false,
      cache: false,
      processData: false,
      async: true,
      dataType: 'json',
      success: function(data) {
        // tabshow();

        if (data.code == 200) {
          msgshow(data.msg, 'success');
          fetchData();
          $("#home-tab-pane").addClass("show active");
          $("#profile-tab-pane").removeClass("active show");
          $("#home-tab").removeClass("active");
          $("#profile-tab").addClass("active");
          $("#home-tab").attr('aria-selected', 'false');
          $("#profile-tab").attr('aria-selected', 'true');
        } else if (data.status = 'error') {
          msgshow(data.message, 'danger')
        } else {
          msgshow('Something Wrong', 'danger')
        }

      }


    });
  }
  // ----------------------------------------------------------------------------------------------
  $(document).ready(function() {
    fetchData();
    nextInvoiceNo();
  });
  // ------------------------------------------------------------------------------------------------

  // ----------------------------------------------------------------------------------------------
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

    var invoice_name = $('#search_user_name').val();
    var invoice_email = $('#search_user_email').val();
    // var invoice_phone = $('#search_user_phone').val();
    var limit = $("#limit").val();
    var last_page = $("#last").attr('data-page');
    if (type == 'pagi') {
      var p = $(page_num).attr('data-page');
    } else {
      var p = '1';
    }
    $.ajax({
      url: '<?php base_url() ?>Invoicemaster/fetch_Data',
      type: 'POST',
      data: {
        columnName: usercloumnName,
        sort_type: tableSortType,

        // search_user_id: invoice_idno,
        search_user_name: invoice_name,
        search_user_email: invoice_email,
        // search_user_phone: invoice_phone,
        limit: limit,
        page_num: p
      },
      dataType: 'json',
      success: function(data) {

        if (data.status == 200) {
          $("#showarr").html('')
          $('#invoiceMasterData').html(data.table);
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
          $('#invoiceMasterData').html('');
          $("#showarr").html(data.table)
        }



      }
    });
  }

  function nextInvoiceNo() {
    $.ajax({
      url: '<?php base_url() ?>Invoicemaster/getnextinvoice',
      type: 'POST',
      dataType: 'json',
      success: function(data) {
        let no = parseFloat(data.data.id) + 1;
        $("#edit_invoice_number").val(no);
      }
    });
  }




  function deleteinvoice(id) {
    // alert(id);
    var data = id;
    if (confirm("Are You Want To Delete?")) {
      $.ajax({
        url: '<?php base_url() ?>Invoicemaster/deleteinvoice',
        type: 'POST',
        data: {
          id: data
        },
        dataType: 'json',
        success: function(data) {
          // alert("Data Delete Successfully");
          location.reload(true);
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

  // ------------------------------------------------------------------------------------------------
  function invoiceupdate(id) {
    $.ajax({
      url: '<?php echo base_url() ?>Invoicemaster/invoiceupdate',
      method: 'POST',
      data: {
        id: id
      },
      dataType: 'json',
      success: function(data) {
        // console.log(data);
        tabshow();
        // document.getElementById("edit_invoice_number").value = data.cleint_data[0].invoice_id //data[0]['id'];
        document.getElementById("edit_invoice_number").value = data.cleint_data[0].id //data[0]['id'];
        var element = document.getElementById("changeUpadte");
        element.innerHTML = "<span>Invoice Id </span>";

        document.getElementsByName("invoice_date").value = data.cleint_data[0].id
        document.getElementById("clientid").value = data.cleint_data[0].client_id
        document.getElementById("invoiceid").value = data.cleint_data[0].id
        document.getElementById("clientname").value = data.cleint_data[0].client_name
        document.getElementById("clientemail").value = data.cleint_data[0].client_email
        document.getElementById("clientnumber").value = data.cleint_data[0].client_phone
        document.getElementById("clientaddress").value = data.cleint_data[0].address
        document.getElementById("total_amount").value = data.cleint_data[0].total_amount
        document.getElementById("form_action").value = "edit";
        $("#updatebtn").html("Update");

        var items = data.item_data;
        console.log(items);
        var trFrstChild = $('div.addMoreTable').find("table tbody tr:first-child");
        trFrstChild.siblings('tr').remove();
        trFrstChild.find('.itemid').val("");
        trFrstChild.find('.item_name').val("");
        trFrstChild.find('.itemprice ').val("");
        trFrstChild.find('.itemquantity').val("");
        trFrstChild.find('.itemtotal').val("");

        $.each(items, function(index, item) {
          // console.log(item);
          if (index == 0) {

            trFrstChild.find('.itemid').val(item.item_id);
            trFrstChild.find('.item_name').val(item.item_name);
            trFrstChild.find('.itemprice ').val(item.item_price);
            trFrstChild.find('.itemquantity').val(item.item_qty);
            trFrstChild.find('.itemtotal').val(item.common_amount);
          } else {
            var cloneChild = trFrstChild.clone();
            cloneChild.find("input[type='text'],input[type='number'],input[type='hidden'],select,textarea").val('');
            cloneChild.find('.itemsno').val(item.in_item_id);
            cloneChild.find('.itemid').val(item.item_id);
            cloneChild.find('.item_name').val(item.item_name);
            cloneChild.find('.itemprice').val(item.item_price);
            cloneChild.find('.itemquantity').val(item.item_qty);
            cloneChild.find('.itemtotal').val(item.common_amount);
            cloneChild.find('.amount').on('change', function() {
              calaculateAmt(this);
            });
            $('div.addMoreTable').find("table tbody").append(cloneChild);
          }
        });
      }
    });
  }

  // function addQuantityTorow (itemid, )


  // ----------------------------------------Reset---------------------------------------------------
  function resetdata() {
    document.getElementById("search_user_name").value = "";
    document.getElementById("search_user_email").value = "";
    fetchData();
  }

  // ------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------
  function tabshow() {
    document.getElementById('profile-tab').innerHTML = "Edit Invoice";
    $("#home-tab-pane").removeClass("show active");
    $("#profile-tab-pane").addClass("active show");
    $("#home-tab").removeClass("active");
    $("#profile-tab").addClass("active");
    $("#home-tab").attr('aria-selected', 'false');
    $("#profile-tab").attr('aria-selected', 'true');
    $("#updatebtn").html("Update");
  }
  // ------------------------------------------------------------------------------------------------
  function tabHide() {
    nextInvoiceNo();
    // window.location.reload();
    var trFrstChild = $('div.addMoreTable').find("table tbody tr:first-child");
    trFrstChild.siblings('tr').remove();
    trFrstChild.find('.itemid').val("");
    trFrstChild.find('.item_name').val("");
    trFrstChild.find('.itemprice ').val("");
    trFrstChild.find('.itemquantity').val("");
    trFrstChild.find('.itemtotal').val("");

    document.getElementById("changeUpadte").innerHTML = "Invoice Number";
    document.getElementById("clientid").value = "";
    document.getElementById("invoiceid").value = "";
    document.getElementById("total_amount").value = "";
    document.getElementById("clientnumber").value = "";
    document.getElementById('profile-tab').innerHTML = "Add Invoice";

    document.getElementById("clientname").value = "";
    document.getElementById("clientemail").value = "";
    document.getElementById("clientaddress").value = "";

  }
  //-------------------------------------------------------------------------------------------------
  function getpdf(id) {
    $.ajax({
      url: "<?php echo base_url() ?>Invoicemaster/Pdf",
      data: {
        id: id
      },
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
        console.log(data.fileUrl);
        if (data.fileUrl != undefined) {
          window.open(data.fileUrl, '_blank');
        }
      }
    });
  };
  // ------------------------------------------------------------------------------------------------
  // MAILER :-
  function modalemail(id, client_email, client_name, total_amount) {
    let body = "Dear " + client_name + ",";
    let body1 = "Your Invoice has been raised of Amount Rs." + total_amount + ".00";
    // document.getElementById("subject").innerHTML = "Invoice Details - # ";
    $("#subject").val("Invoice Details - #" + id + "");
    document.getElementById("body").innerHTML = "" + body + "\n" + body1 + "";
    document.getElementById('invoiceemailid').value = id;
    document.getElementById("invoiceemail").value = client_email;



  }
  // ------------------------------------------------------------------------------------------------
  // Mailer Validation
  function validemail() {
    invoiceemail = $("#invoiceemail").val();
    if (invoiceemail == '') {
      invoice_email_validation.textContent = "  This Feild is Required.";
      invoice_email_validation.style.color = "red";
      $("#invoice_email_validation").show().fadeOut(3000);
    } else {
      invoice_email_validation.textContent = "";
    }
    subject = $("#subject").val();
    if (subject == '') {
      invoice_subject_validation.textContent = "This feild is required";
      invoice_subject_validation.style.color = "red";
      $("#invoice_subject_validation").show().fadeOut(3000);
    } else {
      invoice_subject_validation.textContent = "";
    }
    body = $("#body").val();
    if (body == '') {
      invoice_body_validation.textContent = " This Field Is Required";
      invoice_body_validation.style.color = "red";
      $("#invoice_body_validation").show().fadeOut(3000);
    } else {
      invoice_body_validation.textContent = '';
    }

  }


  function validateEmail(input) {
    // function validateEmail(input) {
    input.value = input.value.replace(/[^A-Za-z0-9.@]/g, ''); // Include numbers (0-9)
    input.value = input.value.replace(/(\..*)\./g, '$1'); // Include "@" and "."
    // }
  }

  // ------------------------------------------------------------------------------------------------
  function Getmail() {
    // alert();
    var id = $("#invoiceemailid").val();
    var email = $("#invoiceemail").val();
    var cc = $("#çc").val();
    var subject = $("#subject").val();
    var body = $("#body").val();
    // window.location.reload(onclick);
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url() ?>Invoicemaster/mailer",
      data: {
        id: id,
        email: email,
        cc: cc,
        subject: subject,
        body: body,
        type: 'sendmail'
      },
      dataType: 'Json',
      success: function(data) {
        window.location.reload(onclick);
        if (data.statuscode == 200) {
          $("#exampleModal").modal('hide');
          $("#exampleModal").removeClass('show');
          viewmsg("success", data.msg);
        } else {
          viewmsg("success", data.msg);
        }

      },

    })
  }



  function checksame(newval) {
    let itemSno = document.querySelectorAll(".same");
    let valarr = [];
    itemSno.forEach((a) => {
      valarr.push(a.value);

    });
    // console.log(valarr);
    let count = 0;
    for (let i = 0; i < valarr.length; i++) {
      if (valarr[i] == newval.value) {
        count++;
      }
    }
    if (count > 1) {
      alert('Item name already exists! Increase the item quantity');
      $(newval).closest('tr').find('button').trigger('click');
      // $(newval).closest('tr').find('.itemprice').val("");
      // $(newval).closest('tr').find('.item_name').val("");
      // $(newval).closest('tr').find('.itemquantity').val("");
      // $(newval).closest('tr').find('.itemtotal').val("");
      finalCalculation();
    }
  }
</script>