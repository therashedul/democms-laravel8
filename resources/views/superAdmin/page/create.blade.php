@extends('layouts.deshboard')
@section('content')
    <div class="container">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif

        <div class="bootstrap-iso">
            <form method="POST" action="{{ route('superAdmin.page.store') }}" enctype="multipart/form-data">
                @csrf
                @php
                    $userid = $user['id'];
                @endphp
                <x-forms.superAdmin.page.pagecreate :userid="$userid" :pages="$pages" />
            </form>

            {{-- <script language="javascript">
                // Ajex search 
                $('.slugsearch').on('keyup', function() {
                    var strng = document.getElementById("mySelect").value;
                    const spt = strng.split(" ");
                    var imp = spt.join('_');
                    var slg = document.getElementById("slugValue").value = imp;
                    $value = $(this).val();

                    $.ajax({
                        type: 'get',
                        url: "{{ route('superAdmin.page.slugsearch') }}",
                        data: {
                            'slugsearch': $value
                        },
                        success: function(data) {
                            if (data) {
                                document.getElementById("slugValue").value = data + '_1';

                            } else {
                                document.getElementById("slugValue").value = imp;
                            }

                            // alert(data);
                            // $('.slugValue').data
                            // $('table').html(data);
                        }
                    });
                })
            </script>
            <script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'csrftoken': '{{ csrf_token() }}'
                    }
                });
            </script> --}}
        </div>
        <x-forms.superAdmin.page.pagecreatemodal />
    @endsection
