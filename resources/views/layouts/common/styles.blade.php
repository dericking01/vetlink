<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ===============================================-->
<!--    Document Title-->
<!-- ===============================================-->
<title>Vetlink</title>

<!-- ===============================================-->
<!--    Favicons-->
<!-- ===============================================-->
{{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/') }}assets/img/favicons/apple-touch-icon.jpeg">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/') }}assets/img/favicons/favicon-32x32.png"> --}}
<link rel="icon" type="image/png" sizes="20x16"
    href="{{ asset('/') }}assets/img/favicons/sab.png">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}assets/img/favicons/favicon.ico">
<link rel="manifest" href="{{ asset('/') }}assets/img/favicons/manifest.json">
<meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
<link href="vendors/choices/choices.min.css" rel="stylesheet" />
<meta name="theme-color" content="#ffffff">
<script src="{{ asset('/') }}assets/js/config.js"></script>
<script src="{{ asset('/') }}vendors/simplebar/simplebar.min.js"></script>
<script src="vendors/choices/choices.min.js"></script>

<!-- ===============================================-->
<!--    Stylesheets-->
<!-- ===============================================-->
<link rel="preconnect" href="https://fonts.gstatic.com/">
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
    rel="stylesheet">
<link href="{{ asset('/') }}vendors/select2/select2.min.css" rel="stylesheet">
<link href="{{ asset('/') }}vendors/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css" rel="stylesheet">
<link href="{{ asset('/') }}vendors/datatables.net-bs5/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="{{ asset('/') }}vendors/leaflet/leaflet.css" rel="stylesheet">
<link href="{{ asset('/') }}vendors/leaflet.markercluster/MarkerCluster.css" rel="stylesheet">
<link href="{{ asset('/') }}vendors/leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet">
<link href="{{ asset('/') }}vendors/flatpickr/flatpickr.min.css" rel="stylesheet">
<link href="{{ asset('/') }}vendors/simplebar/simplebar.min.css" rel="stylesheet">
<link href="{{ asset('/') }}assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
<link href="{{ asset('/') }}assets/css/theme.min.css" rel="stylesheet" id="style-default">
<link href="{{ asset('/') }}assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
<link href="{{ asset('/') }}assets/css/user.min.css" rel="stylesheet" id="user-style-default">
<link href="{{ asset('/') }}vendors/choices/choices.min.css" rel="stylesheet" />
<script>
    var isRTL = JSON.parse(localStorage.getItem('isRTL'));
    if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
    }
</script>
 <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
 <link rel="stylesheet" href="{{ asset('summernote/summernote-bs4.min.css') }}">
