<!DOCTYPE html>
<html lang="en">

<head>
    <title>Klinik</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <script src="assets/js/jquery-3.3.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- data tables css -->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="assets/toastr/toastr.min.css">

    <!-- FullCalendar -->
    <link href="assets/css/fullcalendar.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- <script src="assets/js/vendor-all.min.js"></script> -->
    
    <style type="text/css">
    
    #calendar {
        max-width: 950px;
    }
    .col-centered{
        float: none;
        margin: 0 auto;
    }
    .fc-button{
        color: #fff;
        background: #135dff;
        border-color: #0654ff;
    }
    .fc-button:hover{
        color: #fff;
        background: #2066ff;
        border-color: #135dff;
        /*text-decoration: none;*/
    }
    </style>

    <script>
        $(function() {
            $("#title").autocomplete({
                source: 'functions/autonama.php'
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(".select2").select2({
            });
        });
    </script>

</head>