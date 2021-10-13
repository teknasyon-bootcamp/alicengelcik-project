<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEWS | Control Panel</title>

    <link rel="stylesheet" href="/assets/panel/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/panel/dist/css/adminlte.min.css">
    <script>
        function fileValidation() {
            var fileInput =
                document.getElementById('image');
            var filePath = fileInput.value;
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            }
        }
        function StatusValidation() {
            var fileInput =document.getElementById('accountstatus');
            var statusvalue = fileInput.value;
            if (statusvalue==2){
                confirm("Please be careful! Once you confirm this action, the deleted information cannot be recovered!")
                $('.alert').alert()
            }
            }
    </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
</nav>