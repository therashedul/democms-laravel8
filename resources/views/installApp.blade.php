<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Install App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="text-center" id="initFeedBack" style="display: none">
        <h3><img src="{{ url('img/loader.gif') }}" /> Initiatizing System ....</h3>
        <hr />
    </div>

    <center>
        <button id="installApp" style="margin: 10px auto" class="btn btn-primary btn-lg"><i class="fa fa-download"></i>
            Install App!</button>
    </center>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script>
        function showFeedBack(el, str, error = true, url = null) {

            let baseurl = "{{url('/')}}";
            if (url != null) {
                if (!error) {
                    var newDiv = $('<div/>').addClass('alert alert-success flush').html(
                        '<h5><i class="fa fa-check-circle"></i> ' + str + '</h5>').delay(8000).fadeOut('normal',
                        function() {
                            window.location = url;
                        });
                } else {
                    var newDiv = $('<div/>').addClass('alert alert-danger flush').html('<h5><i class="fa fa-close"></i> ' +
                        str + '</h5>').delay(8000).fadeOut('normal', function() {
                        window.location = url;
                    });
                }
                $(el).before(newDiv);
            } else {
                if (!error) {
                    var newDiv = $('<div/>').addClass('alert alert-success flush').html(
                        '<h5><i class="fa fa-check-circle"></i> ' + str + '</h5>').delay(5000).fadeOut(
                            function() {
                                window.location = baseurl;
                            });

                } else {
                    var newDiv = $('<div/>').addClass('alert alert-info flush').html('<h5><i class="fa fa-close"></i> ' +
                            str + '</h5>').delay(3000).fadeOut('normal', function() {
                                window.location = baseurl;
                    });
                }
                $(el).before(newDiv);

            }
        }

        $(function() {
            let baseurl = "{{url('/')}}";

            $('body').on('click', '#installApp', function(e) {
                e.preventDefault();
               
                $('#initFeedBack').css('display', 'block');
                $('#installApp').attr("disabled", true);
       
                $.ajax({
                    url: '{{ route('app.systemInt') }}',
                    error: function(error) {
                        $('#installApp').attr("disabled", false);
                    },
                    success: function(data) {
                        // alert(data);
                        $('#installApp').attr("disabled", false);
                        if (data == 1) {
                            $('#initFeedBack').css('display', 'none');
                            showFeedBack('#initFeedBack',
                                'Make Sure, DB connection is working,<br/><br/><i>Tip: check your .env file</i>'
                            );
                            setTimeout(function() {
                                $('#systemInt').attr("disabled", false);
                            }, 2000);
                        } else if (data == 2) {
                            $('#initFeedBack').css('display', 'none');
                            showFeedBack('#initFeedBack',
                                'Make Sure, DB connection is working,<br/><br/><i>Tip: check your .env file</i>'
                            );
                        } else if (data == 3) {
                            $('#initFeedBack').css('display', 'none');
                            showFeedBack('#initFeedBack', 'Successfully initialised!', false);
                            setTimeout(function() {
                                window.location = baseurl;
                            }, 2000);
                        } else {
                            $('#initFeedBack').css('display', 'none');
                            showFeedBack('#initFeedBack', 'Successfully initialised!', false);
                            setTimeout(function() {
                                window.location = baseurl;
                            }, 2000);
                        }
                    },
                    type: 'GET',
                });
            });
        });
    </script>

         {{-- showFeedBack('#initFeedBack', 'Successfully initialised!', false);
                            setTimeout(function() {
                               window.open('https://support.wwf.org.uk', '_blank');
                            }, 2000); --}}
</body>

</html>
