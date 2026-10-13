<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021
        <a href="https://adminlte.io">AdminLTE.io</a>.
    </strong>
    All rights reserved.

    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
    </div>
</footer>

<aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('build/plugins/jquery/jquery.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('build/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Resolve jQuery UI and Bootstrap tooltip conflict -->
<script>
    if (window.jQuery && $.ui && $.widget && $.ui.button) {
        $.widget.bridge('uibutton', $.ui.button);
    }
</script>

<!-- Bootstrap -->
<script src="{{ asset('build/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('build/plugins/chart.js/Chart.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('build/plugins/sparklines/sparkline.js') }}"></script>

<!-- JQVMap -->
<script src="{{ asset('build/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('build/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

<!-- jQuery Knob -->
<script src="{{ asset('build/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- Moment -->
<script src="{{ asset('build/plugins/moment/moment.min.js') }}"></script>

<!-- Date Range Picker -->
<script src="{{ asset('build/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Tempusdominus -->
<script src="{{ asset('build/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Summernote -->
<script src="{{ asset('build/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- OverlayScrollbars -->
<script src="{{ asset('build/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('build/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('build/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- DataTables Responsive -->
<script src="{{ asset('build/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('build/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<!-- AdminLTE -->
<script src="{{ asset('build/dist/js/adminlte.js') }}"></script>

<!-- Demo scripts: optional -->
<script src="{{ asset('build/dist/js/demo.js') }}"></script>

<!-- Dashboard demo: remove if not needed -->
{{-- <script src="{{ asset('build/dist/js/pages/dashboard.js') }}"></script> --}}

<!-- Page-specific scripts -->
@stack('scripts')
</body>

</html>
