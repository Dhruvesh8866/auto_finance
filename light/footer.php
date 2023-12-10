<!-- Javascript -->
<script src="../assets/bundles/libscripts.bundle.js"></script>    
<script src="../assets/bundles/vendorscripts.bundle.js"></script>



<script src="../assets/js/theme.js"></script>

<!-- jQuery 
<script src="datatable/jquery.min.js"></script>-->
<!-- Bootstrap 4 -->
<script src="datatable/bootstrap.bundle.min.js"></script>
<!-- DataTables -->

<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTables.bootstrap4.min.js"></script>
<script src="datatable/dataTables.responsive.min.js"></script>
<script src="datatable/responsive.bootstrap4.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
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
    
</script>

</body>
</html>