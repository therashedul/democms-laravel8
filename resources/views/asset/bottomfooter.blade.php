 {{-- <form action="{{ route('post.time') }}" method="post">
       @csrf
       <input type="text" name="duration" value="123">
       <button class="btn  btn-primary">submit</button>
   </form> --}}
 <!-- jQuery -->
 {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <!-- Bootstrap -->
 <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 <!-- Bootstrap -->
 <!-- FastClick -->
 <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
 <!-- NProgress -->
 <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
 <!-- bootstrap-progressbar -->
 <script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
 <!-- bootstrap-daterangepicker -->
 <script type="text/javascript" src="{{ asset('build/js/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>
 <script type="text/javascript" src="{{ asset('build/js/bootstrap-datetimepicker.fr.js') }}" charset="UTF-8"></script>

 {{-- =========================== --}}

 <!-- iCheck -->
 <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
 <!-- Skycons -->
 <script src="{{ asset('vendors/skycons/skycons.js') }}"></script>
 <!-- DateJS -->
 <script src="{{ asset('vendors/DateJS/build/date.js') }}"></script>
 <!-- jQuery Tags Input -->
 <script src="{{ asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
 <!-- Switchery -->
 <script src="{{ asset('vendors/switchery/dist/switchery.min.js') }}"></script>

 <!-- Custom Theme Scripts -->
 <script src="{{ asset('build/js/custom.min.js') }}"></script>
 <script type="text/javascript">
     $(document).ready(function() {
         // show the alert
         window.setTimeout(function() {
             $(".alert").alert('close');
         }, 2000);
     });
 </script>
