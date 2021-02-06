<!-- Fonts and icons -->
<script src="{{ asset('assets-back/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {"families":["Lato:300,400,700,900"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{ asset('assets-back/css/fonts.min.css') }}"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<!-- Core JS Files -->
<script src="{{ asset('assets-back/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets-back/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets-back/js/core/bootstrap.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('assets-back/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets-back/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
<!-- jQuery Scrollbar -->
<script src="{{ asset('assets-back/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('assets-back/js/plugin/chart.js/chart.min.js') }}"></script>
<!-- jQuery Sparkline -->
<script src="{{ asset('assets-back/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Chart Circle -->
<script src="{{ asset('assets-back/js/plugin/chart-circle/circles.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ asset('assets-back/js/plugin/datatables/datatables.min.js') }}"></script>
<!-- Bootstrap Notify -->
<script src="{{ asset('assets-back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<!-- jQuery Vector Maps -->
<script src="{{ asset('assets-back/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets-back/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('assets-back/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
<!-- Atlantis JS -->
<script src="{{ asset('assets-back/js/atlantis.min.js') }}"></script>
<!-- JQuery Validator -->
<script src="{{ asset('assets-back/js/plugin/jquery-validation/jquery.validate.js') }}"></script>

<script>
    $('.only-string').keypress(function(e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });

    $('.only-number').keypress(function (e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
    });

    function logout()
    {
        $('#formLogout').submit();
    }

</script>