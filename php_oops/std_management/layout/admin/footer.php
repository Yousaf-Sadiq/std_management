</div>
</div>

<!--**********************************
   Footer start
  ***********************************-->
<div class="footer footer-outer">
  <div class="copyright">
    <p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">DexignLab</a> 2024</p>
  </div>
</div>

</div>

<?php require_once "component/modal.php" ?>

<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="<?php echo AdminAsset; ?>vendor/global/global.min.js"></script>
<script src="<?php echo AdminAsset; ?>vendor/chart.js/Chart.bundle.min.js"></script>
<script src="<?php echo AdminAsset; ?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<!-- Dashboard 1 -->
<script src="<?php echo AdminAsset; ?>js/dashboard/dashboard-1.js"></script>
<script src="<?php echo AdminAsset; ?>vendor/wow-master/dist/wow.min.js"></script>
<script src="<?php echo AdminAsset; ?>vendor/bootstrap-datetimepicker/js/moment.js"></script>
<script src="<?php echo AdminAsset; ?>vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo AdminAsset; ?>vendor/bootstrap-select-country/js/bootstrap-select-country.min.js"></script>


<!-- <script src="<?php echo AdminAsset; ?>js/vendor/ckeditor/ckeditor.js"></script> -->
<!-- <script src="https://cdn.ckeditor.com/4.16.1/classic/ckeditor.js"></script> -->

<script async src="https://cdn.ckeditor.com/ckeditor5/38.0.0/classic/ckeditor.js"></script>

<script src="<?php echo AdminAsset; ?>js/custom.min.js"></script>

<script src="<?php echo AdminAsset; ?>js/dlabnav-init.js"></script>

<script src="<?php echo AdminAsset; ?>js/demo.js"></script>
<script src="<?php echo AdminAsset; ?>js/styleSwitcher.js"></script>


<!-- Apex Chart -->
<script src="<?php echo AdminAsset; ?>vendor/apexchart/apexchart.js"></script>
<!-- Chart piety plugin files -->
<script src="<?php echo AdminAsset; ?>vendor/peity/jquery.peity.min.js"></script>
<script src="<?php echo AdminAsset; ?>vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
<!--swiper-slider-->
<script src="<?php echo AdminAsset; ?>vendor/swiper/js/swiper-bundle.min.js"></script>


<!-- Datatable -->
<script src="<?php echo AdminAsset; ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo AdminAsset; ?>js/plugins-init/datatables.init.js"></script>

<script>

  function ALertMSG(id, msg, classes) {
    const alertPlaceholder = document.getElementById(id)



    const appendAlert = (message, type) => {
      const wrapper = document.createElement('div')
      wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
         <div class="media">
        <div class="media-body">
        `,
        `   <p class="mb-0">${message}</p>`,
        '    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span></button>',
        '</div>',
        '</div>'
      ].join('')

      alertPlaceholder.append(wrapper)

      wrapper.style.transition = "all 0.75s ease-in-out";
      setTimeout(() => {
        wrapper.style.opacity = 0;

        setTimeout(() => {
          wrapper.remove()
        }, 1000);
      }, 1500);

    }




    appendAlert(msg, classes)

  }
</script>

</body>

<!-- Mirrored from akademi.dexignlab.com/flask/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Sep 2024 05:08:48 GMT -->

</html>