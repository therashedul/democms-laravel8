   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">


   <title>{{ config('app.name', 'Url') }}</title>

   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" href="images/favicon.ico" type="image/ico" />



   <!-- Bootstrap CSS -->
   {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
       integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> --}}
   <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ asset('vendors/bootstrap/dist/css/b4vtabs.css') }}" rel="stylesheet">
   <!-- Font Awesome -->

   <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

   <!-- NProgress -->
   <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
   <!-- Dropzone.js -->
   {{-- <link href="{{ asset('vendors/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet"> --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
   <!-- iCheck -->
   <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
   <!-- bootstrap-progressbar -->
   <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
   <!-- NProgress -->
   {{-- <script src="{{ asset('css/file-manager-1.2.css') }}"></script>
   <script src="{{ asset('css/custom-4.1.css') }}"></script> --}}
   <!-- JQVMap -->
   <link href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
   <!-- bootstrap-daterangepicker -->
   <link href="{{ asset('build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">
   <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
   <!-- bootstrap-wysiwyg -->
   <link href="{{ asset('vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
   <!-- Switchery -->
   <link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">

   <!-- Custom Theme Style -->
   <link href="{{ asset('build/css/custom.css') }}" rel="stylesheet">
