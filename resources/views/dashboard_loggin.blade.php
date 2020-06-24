@include('headers.dashboard_h') 
</head>
<body>


    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-90 p-b-30">
                <form class="login100-form validate-form" action="{{$action}}" method="post">

                    @csrf <!-- {{ csrf_field() }} -->
                    <span class="login100-form-title p-b-40">
                        {{$text}} to dashboard
                    </span>

                    <div class="text-center p-t-55 p-b-30">
                        <span class="txt1">
                            {{$text}} with email
                        </span>
                    </div>
                   


                    @if ($errors->any())
                    <div class="alert alert-success">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-20" data-validate = "Please enter password">
                        <span class="btn-show-pass">
                            <i class="fa fa fa-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password" placeholder="password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            {{$text}}
                        </button>
                    </div>
                    @if($signup===false)
                    <div class="flex-col-c p-t-224">
                        <span class="txt2 p-b-10">
                            Don’t have an account?
                        </span>

                        <a href="/dashboard-signup" class="txt3 bo1 hov1">
                            Sign up now
                        </a>
                    </div>
                    @endif


                </form>
            </div>
        </div>
    </div>



    <!--===============================================================================================-->
    <script src="dashboardd/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="dashboardd/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="dashboardd/vendor/bootstrap/js/popper.js"></script>
    <script src="dashboardd/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="dashboardd/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="dashboardd/vendor/daterangepicker/moment.min.js"></script>
    <script src="dashboardd/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="dashboardd/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="dashboardd/js/main.js"></script>





</body>
</html>

