   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Laravel') }}</title>

   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" href="images/favicon.ico" type="image/ico" />

   <!-- Bootstrap -->
   <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
   <!-- Font Awesome -->
   <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
   <!-- NProgress -->
   <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
   <!-- iCheck -->
   <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

   <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
   <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
   <!-- bootstrap-progressbar -->
   <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
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
