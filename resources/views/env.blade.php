<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Setup and Configar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            outline: none;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            background: url("bg.png"), -webkit-linear-gradient(bottom, #0250c5, #d43f8d);
        }

        ::selection {
            color: #fff;
            background: #d43f8d;
        }

        .container {
            width: 480px;
            background: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 50px 35px 10px 35px;
        }

        .container header {
            font-size: 35px;
            font-weight: 600;
            margin: 0 0 30px 0;
        }

        .container .form-outer {
            width: 100%;
            overflow: hidden;
        }

        .container .form-outer form {
            display: flex;
            width: 400%;
        }

        .form-outer form .page {
            width: 25%;
            transition: margin-left 0.3s ease-in-out;
        }

        .form-outer form .page .title {
            text-align: left;
            font-size: 25px;
            font-weight: 500;
        }

        .form-outer form .page .field {
            width: 330px;
            height: 45px;
            margin: 45px 0;
            display: flex;
            position: relative;
        }

        form .page .field .label {
            position: absolute;
            top: -30px;
            font-weight: 500;
        }

        form .page .field input {
            height: 100%;
            width: 100%;
            border: 1px solid lightgrey;
            border-radius: 5px;
            padding-left: 15px;
            font-size: 18px;
        }

        form .page .field select {
            width: 100%;
            padding-left: 10px;
            font-size: 17px;
            font-weight: 500;
        }

        form .page .field button {
            width: 100%;
            height: calc(100% + 5px);
            border: none;
            background: #d33f8d;
            margin-top: -20px;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: 0.5s ease;
        }

        form .page .field button:hover {
            background: #000;
        }

        form .page .btns button {
            margin-top: -20px !important;
        }

        form .page .btns button.prev {
            margin-right: 3px;
            font-size: 17px;
        }

        form .page .btns button.next {
            margin-left: 3px;
        }

        .container .progress-bar {
            display: flex;
            margin: 40px 0;
            user-select: none;
        }

        .container .progress-bar .step {
            text-align: center;
            width: 100%;
            position: relative;
        }

        .container .progress-bar .step p {
            font-weight: 500;
            font-size: 18px;
            color: #000;
            margin-bottom: 8px;
        }

        .progress-bar .step .bullet {
            height: 25px;
            width: 25px;
            border: 2px solid #000;
            display: inline-block;
            border-radius: 50%;
            position: relative;
            transition: 0.2s;
            font-weight: 500;
            font-size: 17px;
            line-height: 25px;
        }

        .progress-bar .step .bullet.active {
            border-color: #d43f8d;
            background: #d43f8d;
        }

        .progress-bar .step .bullet span {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .progress-bar .step .bullet.active span {
            display: none;
        }

        .progress-bar .step .bullet:before,
        .progress-bar .step .bullet:after {
            position: absolute;
            content: '';
            bottom: 11px;
            right: -51px;
            height: 3px;
            width: 44px;
            background: #262626;
        }

        .progress-bar .step .bullet.active:after {
            background: #d43f8d;
            transform: scaleX(0);
            transform-origin: left;
            animation: animate 0.3s linear forwards;
        }

        @keyframes animate {
            100% {
                transform: scaleX(1);
            }
        }

        .progress-bar .step:last-child .bullet:before,
        .progress-bar .step:last-child .bullet:after {
            display: none;
        }

        .progress-bar .step p.active {
            color: #d43f8d;
            transition: 0.2s linear;
        }

        .progress-bar .step .check {
            position: absolute;
            left: 50%;
            top: 70%;
            font-size: 15px;
            transform: translate(-50%, -50%);
            display: none;
        }

        .progress-bar .step .check.active {
            display: block;
            color: #fff;
        }

        form .page .field input.rediobtn {
            width: 50%;
            height: 50%;
        }
        .debug-panel .form-check-inline,
        .appenv-panel .form-check-inline{
            align-items: normal;
        }   
        
        .debug-panel label.false-text,
        .debug-panel label.true-text{
            font-size: 1rem;
        }
        .field.appenv-panel{

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12">


                <header>App Installer</header>
                <div class="progress-bar">
                    <!-- <div class="step">
                <p>Name</p>
                <div class="bullet">
                    <span>1</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Contact</p>
                <div class="bullet">
                    <span>2</span>
                </div>
                <div class="check fas fa-check"></div>
            </div> -->
                    <!--
            <div class="step">
                <p>Birth</p>
                <div class="bullet">
                    <span>3</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>

            <div class="step">
                <p>Submit</p>
                <div class="bullet">
                    <span>4</span>
                </div>
                <div class="check fas fa-check"></div>
            </div> -->
                </div>

                {{-- {{ env('APP_URL') }} --}}
                <div class="form-outer">
                    <form method="POST" action="{{ route('envindex') }}">
                        @csrf
                        <div class="page slide-page">
                            <div class="title">App Info:</div>
                            <div class="field">
                                <div class="label">App Name</div>
                                <input type="hidden" class="form-control" name="appname" value="APP_NAME">
                                <input type="text" class="form-control" name="appvalue"
                                    value="{{ env('APP_NAME') }}">
                            </div>
                            <div class="field appenv-panel">
                                <div class="label">App Env</div>
                                {{-- {{ env('APP_ENV') }} --}}
                                <input type="hidden" class="form-control" name="appenv" value="APP_ENV">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input rediobtn" type="radio" name="envvalue"
                                        value="local" {{ env('APP_ENV') == 'local' ? 'checked' : '' }}>
                                    <label class="form-check-label local-text" for="inlineRadio1">Local</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input rediobtn" type="radio" name="envvalue"
                                        value="production" {{ env('APP_ENV') == 'production' ? 'checked' : '' }}>
                                    <label class="form-check-label production-text" for="inlineRadio2">Production</label>
                                </div>
                                {{-- <input type="text" class="form-control" name="envvalue" value="{{ env('APP_ENV') }}"> --}}
                            </div>
                            <div class="field debug-panel">
                                <div class="label">Debug</div>
                                <input type="hidden" class="form-control" name="appdebug" value="APP_DEBUG">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input rediobtn" type="radio" name="debugvalue"
                                        value="true" {{ env('APP_DEBUG') == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label true-text" for="inlineRadio1">True</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input rediobtn" type="radio" name="debugvalue"
                                        value="false" {{ env('APP_DEBUG') == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label false-text" for="inlineRadio2">False</label>
                                </div>
                                {{-- <select name="debugvalue">
                            @if (env('APP_DEBUG') == '1')
                                <option value="true">True</option>
                                <option value="false">False</option>
                            @else
                                <option value="false">False</option>
                                <option value="true">True</option>
                            @endif
                        </select> --}}
                            </div>
                            <div class="field">
                                <div class="label">App url</div>
                                <input type="hidden" class="form-control" name="appurl" value="APP_URL">
                                <input type="text" class="form-control" name="urlvalue" value="{{ env('APP_URL') }}">
                            </div>
                            <div class="field">
                                <button class="firstNext next">Next</button>
                            </div>
                        </div>
                        <div class="page">
                            <div class="title">Database Info:</div>
                            <div class="field">
                                <div class="label">Host Name</div>
                                <input type="hidden" class="form-control" name="dbhostname" value="DB_HOST">
                                <input type="text" class="form-control" name="hostvalue"
                                    value="{{ env('DB_HOST') }}">
                            </div>
                            <div class="field">
                                <div class="label">Port Number</div>
                                <input type="hidden" class="form-control" name="dbport" value="DB_PORT">
                                <input type="text" class="form-control" name="portvalue"
                                    value="{{ env('DB_PORT') }}">
                            </div>
                            <div class="field">
                                <div class="label">Database Name</div>
                                <input type="hidden" class="form-control" name="dbname" value="DB_DATABASE">
                                <input type="text" class="form-control" name="dbvalue"
                                    value="{{ env('DB_DATABASE') }}">
                            </div>
                            <div class="field">
                                <div class="label">Username</div>
                                <input type="hidden" class="form-control" name="dbusername" value="DB_USERNAME">
                                <input type="text" class="form-control" name="uservalue"
                                    value="{{ env('DB_USERNAME') }}">
                            </div>
                            <div class="field">
                                <div class="label">Password</div>
                                <input type="hidden" class="form-control" name="dbpassword" value="DB_PASSWORD">
                                <input type="text" class="form-control" name="dbpasswordvalue"
                                    value="{{ env('DB_PASSWORD') }}">
                            </div>
                            <div class="field btns">
                                <button class="prev-1 prev">Previous</button>
                                <!-- <button class="next-1 next">Next</button> -->
                                <button class="submit">Submit</button>
                            </div>
                        </div>
                        <div class="page">
                            <div class="title">Date of Birth:</div>
                            <div class="field">
                                <div class="label">Date</div>
                                <input type="text">
                            </div>
                            <div class="field">
                                <div class="label">Gender</div>
                                <select>
                                    <option value="true">Male</option>
                                    <option value="false">Female</option>
                                </select>
                            </div>
                            <div class="field btns">
                                <button class="prev-2 prev">Previous</button>
                                <button class="next-2 next">Next</button>
                            </div>
                        </div>
                        <div class="page">
                            <div class="title">Login Details:</div>
                            <div class="field">
                                <div class="label">Username</div>
                                <input type="text">
                            </div>
                            <div class="field">
                                <div class="label">Password</div>
                                <input type="password">
                            </div>
                            <div class="field btns">
                                <button class="prev-3 prev">Previous</button>
                                <button class="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const slidePage = document.querySelector(".slide-page");
        const nextBtnFirst = document.querySelector(".firstNext");

        const prevBtnSec = document.querySelector(".prev-1");
        // const nextBtnSec = document.querySelector(".next-1");
        const prevBtnThird = document.querySelector(".prev-2");
        const nextBtnThird = document.querySelector(".next-2");
        const prevBtnFourth = document.querySelector(".prev-3");

        const submitBtn = document.querySelector(".submit");
        const progressText = document.querySelectorAll(".step p");
        const progressCheck = document.querySelectorAll(".step .check");
        const bullet = document.querySelectorAll(".step .bullet");

        let current = 1;

        nextBtnFirst.addEventListener("click", function(event) {
            event.preventDefault();
            slidePage.style.marginLeft = "-25%";
            bullet[current - 1].classList.add("active");
            progressCheck[current - 1].classList.add("active");
            progressText[current - 1].classList.add("active");
            current += 1;
        });
        // nextBtnSec.addEventListener("click", function (event) {
        //     event.preventDefault();
        //     slidePage.style.marginLeft = "-50%";
        //     bullet[current - 1].classList.add("active");
        //     progressCheck[current - 1].classList.add("active");
        //     progressText[current - 1].classList.add("active");
        //     current += 1;
        // });
        nextBtnThird.addEventListener("click", function(event) {
            event.preventDefault();
            slidePage.style.marginLeft = "-75%";
            bullet[current - 1].classList.add("active");
            progressCheck[current - 1].classList.add("active");
            progressText[current - 1].classList.add("active");
            current += 1;
        });
        submitBtn.addEventListener("click", function() {
            // bullet[current - 1].classList.add("active");
            // progressCheck[current - 1].classList.add("active");
            // progressText[current - 1].classList.add("active");
            current += 1;
            setTimeout(function() {
                alert("Your Form Successfully Signed up");
                location.reload();
            }, 800);
        });

        prevBtnSec.addEventListener("click", function(event) {
            event.preventDefault();
            slidePage.style.marginLeft = "0%";
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
        prevBtnThird.addEventListener("click", function(event) {
            event.preventDefault();
            slidePage.style.marginLeft = "-25%";
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
        prevBtnFourth.addEventListener("click", function(event) {
            event.preventDefault();
            slidePage.style.marginLeft = "-50%";
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
    </script>

</body>

</html>
