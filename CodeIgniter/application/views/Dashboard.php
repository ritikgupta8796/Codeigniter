<?php
$this->load->view('include/header_1.php');
?>



<section>
    <div class="container  p-2">
      <div class="row">
        <div class="col-sm-6 ">
          <div class="card shadow" style=" background: white;  border: 1px light-gray; box-sizing: shadow;box-shadow: 1px 2px 5px 2px;">
            <a href="<?php echo base_url() ?>Usermaster" class="text-decoration-none">
              <div class="card-body pe-5 ps-5 ">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="icon flex-shrink-0 bg-violet">
                    <img src="<?php echo base_url('/assets/using_image/programmer.png') ?>" alt="" style="width: 30px; height: 35px;">
                    <!-- <svg class="svg-icon svg-icon-sm svg-icon-heavy"> -->
                    <!-- <use xlink:href="#user-1"> </use> -->
                    </svg>
                  </div>
                  <div class="mx-3">
                    <h6 class="h4 fw-light text-gray-600 mb-3">User Master</h6>
                  </div>
                  <div class="number">
                    <strong class="text-lg">
                      <?php
                      echo $this->db->count_all_results('usermaster');
                    //   $sql = "select * from usermaster";
                    //   $res = $query_execute->total_rows($sql);
                    //   echo $res;
                      ?>
                    </strong>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <?php
        // echo $_SESSION['Name'];
        ?>

        <div class="col-sm-6">
          <div class="card shadow" style=" background: white;  border: 1px light-gray; box-sizing: shadow;box-shadow: 1px 2px 5px 2px;">
            <a href="<?php echo base_url() ?>Clientmaster" class="text-decoration-none">
              <div class="card-body pe-5 ps-5 ">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="icon flex-shrink-0 bg-violet">
                    <img src="<?php echo base_url('/assets/using_image/target.png') ?>" alt="" style="width: 30px; height: 35px;">
                    <!-- <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                    <use xlink:href="#user-1"> </use> -->
                    </svg>
                  </div>
                  <div class="mx-3">
                    <h6 class="h4 fw-light text-gray-600 mb-3">Client Master</h6>
                  </div>
                  <div class="number">
                    <strong class="text-lg">
                      <?php
                      echo $this->db->count_all_results('clientmaster');
                    //   $sql = "select * from clientmaster";
                    //   $res = $query_execute->total_rows($sql);
                    //   echo $res;
                      ?>
                    </strong>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="card shadow" style=" background: white;  border: 1px light-gray; box-sizing: shadow;box-shadow: 1px 2px 5px 2px;">
            <a href="<?php echo base_url() ?>Itemmaster" class="text-decoration-none">
              <div class="card-body pe-5 ps-5 ">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="icon flex-shrink-0 bg-violet">
                    <img src="<?php echo base_url('/assets/using_image/procurement.png') ?>" alt="" style="width: 30px; height: 35px;">
                    <!-- <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                    <use xlink:href="#user-1"> </use> -->
                    </svg>
                  </div>
                  <div class="mx-3">
                    <h6 class="h4 fw-light text-gray-600 mb-3">Item Master</h6>
                  </div>
                  <div class="number">
                    <strong class="text-lg">
                      <?php
                      echo $this->db->count_all_results('itemmaster');
                    //   $sql = "select * from itemmaster";
                    //   $res = $query_execute->total_rows($sql);
                    //   echo $res;
                      ?>
                    </strong>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="card shadow" style=" background: white;  border: 1px light-gray; box-sizing: shadow;box-shadow: 1px 2px 5px 2px;">
            <a href="<?php echo base_url() ?>Invoicemaster"   class="text-decoration-none">
              <div class="card-body pe-5 ps-5 ">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="icon flex-shrink-0 bg-violet">
                    <img src="<?php echo base_url('/assets/using_image/invoice.png') ?>" alt="" style="width: 30px; height: 35px;">
                    <!-- <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                    <use xlink:href="#user-1"> </use> -->
                    </svg>
                  </div>
                  <div class="mx-3">
                    <h6 class="h4 fw-light text-gray-600 mb-3">Invoice</h6>
                  </div>
                  <div class="number"><strong class="text-lg">
                  <?php
                  echo $this->db->count_all_results('invoicemaster');
                    //   $sql = "select * from invoicemaster";
                    //   $res = $query_execute->total_rows($sql);
                    //   echo $res;
                      ?>
                  </strong></div>
                </div>
              </div>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>




























<?php
$this->load->view('include/footer_1.php');
?>