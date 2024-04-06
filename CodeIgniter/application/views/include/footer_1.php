
        <!-- Page Footer-->
        <!-- <footer class="position-absolute bottom-0 bg-darkBlue text-white text-center py-3 w-100 text-xs" id="footer"> -->
        <footer class="" id="footer">
            <!-- <div class="container-fluid">
              <div class="row gy-2">
                <div class="col-sm-6 text-sm-start">
                  <p class="mb-0">Your company &copy; 1999-2023</p>
                </div>
                <div class="col-sm-6 text-sm-end">
                  <p class="mb-0">Design by <a href="https://sansoftwares.com/"
                      class="text-white text-decoration-none">SanSoftwares</a></p>
                </div>
              </div>
            </div> -->
        </footer>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <!-- sorting arror script in w3school  -->
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->

    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script> -->
    <script src="<?php echo base_url() ?>assets/vendor/just-validate/js/just-validate.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets/js/charts-home.js"></script> -->
    <!-- Main File-->
    <!-- <script src="<?php echo base_url() ?>assests/js/front.js"></script> -->
    <!-- <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
    <!-- jquery -->



  <script src="<?php echo base_url() ?>assets/js/autocomplete.js"></script>




    <script>
      function injectSvgSprite(path) {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", path, true);
        ajax.send();
        ajax.onload = function (e) {
          var div = document.createElement("div");
          div.className = 'd-none';
          div.innerHTML = ajax.responseText;
          document.body.insertBefore(div, document.body.childNodes[0]);
        }
      }
      injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
    </script>
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?> https://use.fontawesome.com/releases/v5.7.1/css/all.css"> -->
  </body>

  </html>