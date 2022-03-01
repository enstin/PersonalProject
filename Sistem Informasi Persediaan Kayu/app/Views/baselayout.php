<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo session()->get('id_user')
          ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/template/dist/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/plugins/select2/css/select2.min.css">

  <!-- ===== -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/aja/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/template/aja/select2/css/select2.min.css">

  <link href="<?= base_url(''); ?>/template/aja/select2.min.css" rel="stylesheet" />


  <!-- jQuery -->
  <script src="<?= base_url(''); ?>/template/plugins/jquery/jquery.min.js"></script>

  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url(''); ?>/template/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="<?= base_url(''); ?>/template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(''); ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url(''); ?>/template/plugins/chart.js/Chart.min.js"></script>
  <!-- InputMask -->
  <script src="<?= base_url(''); ?>/template/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url(''); ?>/template/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url(''); ?>/template/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url(''); ?>/template/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url(''); ?>/template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- bootstrap color picker -->
  <script src="<?= base_url(''); ?>/template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url(''); ?>/template/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?= base_url(''); ?>/template/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url(''); ?>/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url(''); ?>/template/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url(''); ?>/template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(''); ?>/template/dist/js/adminlte.js"></script>
  <!-- Bootstrap Switch -->
  <script src="<?= base_url(''); ?>/template/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url(''); ?>/template/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url(''); ?>/template/dist/js/demo.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(''); ?>/template/dist/js/adminlte.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url(''); ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(''); ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url(''); ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url(''); ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url(''); ?>/template/plugins/select2/js/select2.full.min.js"></script>
  <script src="<?= base_url(''); ?>/template/aja/select2.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- header -->
    <?= view('header'); ?>
    <?= view('sidebar'); ?>
    <!-- konten  -->
    <?= $this->renderSection('content'); ?>
    <!-- /.content-wrapper -->

    <!-- footer -->
    <?= view('foooter'); ?>
    <!-- sidebar -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <!-- page script -->
  <script type="text/javascript">
    function ubah_jml() {
      var tes = document.getElementById("jml").value;
      document.getElementById("jmlsisa").value = tes;
    }
  </script>
  <script type="text/javascript">
    function select_brg() {
      var tes = document.getElementById("namabrg").value;
      var explode = tes.split("|");
      document.getElementById("satuan").value = explode[1];
    }
  </script>
  <script type="text/javascript">
    function select_brgpesan() {
      var tes = document.getElementById("namabrg").value;
      var explode = tes.split("|");
      document.getElementById("satuan").value = explode[2];
      document.getElementById("jml_pesan").value = explode[3];
    }
  </script>
  <script type="text/javascript">
    function select_brgso() {
      var tes = document.getElementById("namabrg").value;
      var explode = tes.split("|");
      document.getElementById("sat").value = explode[2];
    }
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $("#example3").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'md/dd/yyyy'
      })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      $('#reservationdate').datetimepicker({
        format: 'L'
      });
      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });

      $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });

    })
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dtHorizontal').DataTable({
        "scrollX": true
      });
    });
  </script>
  <script>
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>

</body>

</html>