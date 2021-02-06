<script src="{{ asset('assets-back/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets-back/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets-back/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets-back/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets-back/js/atlantis.min.js') }}"></script>
<script src="{{ asset('assets-back/js/plugin/webfont/webfont.min.js') }}"></script>
<script src="{{ asset('assets-back/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets-back/datepicker/js/datepicker.min.js') }}"></script>
<script src="{{ asset('assets-back/js/plugin/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('assets-back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script>
    WebFont.load({
        google: {"families":["Lato:300,400,700,900"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{ asset('assets-back/css/fonts.min.css') }} "]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
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
</script>