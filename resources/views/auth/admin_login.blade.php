{{-- <?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); error_reporting(0); ?> --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login - {{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="ArchitectUI HTML Bootstrap 4 Dashboard Template">

    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{asset('assets/admin/css/main.d810cf0ae7f39f28f336.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/common.style.css') }}?{{ filemtime(public_path('assets/css/common.style.css')) }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!--/web-fonts-->
    <link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/slick-theme.css')}}"/>
    <script src="{{asset('assets/js/slick.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('assets/js/main.js')}}" type="text/javascript"> </script>
    <script>
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script>
    <style>

        #refresh-captcha {
        display: inline-block;
        visibility: visible;
        }
        #captchaText, #p-captchaText, #i-captchaText {
            font-weight: bold;
            font-size: 18px;
            color: white;
            margin-bottom: 10px;
            text-transform: none;
        }
        #captchaText , #p-captchaText, #i-captchaText{
            font-weight: bold;
            font-size: 18px;
            color: white;
            margin-bottom: 10px;
            text-transform: none;
        }

        #captcha,#p-captcha, #i-captcha{
            text-transform: none !important;
        }
        #refresh-captcha, #p-refresh-captcha, #i-refresh-captcha{
            background-color:transparent;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #refresh-captcha:hover {
            background-color: ccc;
        }
    </style>
</head>

<body>

    <div class="app-container app-theme-white body-tabs-shadow" style="overflow-y: hidden">
        <div class="app-container">
            <div class="h-100">
                <div class="h-100 no-gutters row">
                    <div class="d-none d-lg-block col-lg-8 col-md-12">
                        <div class="slider-light">
                            <div class="slick-slider">
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('{{asset('assets/admin/img/2.jpg')}}');"></div>
                                        <div class="slider-content">
                                            <h3>Document Management System </h3>
                                            <p>This module will contain all functionalities from the present physical file system which is relevant to e-file manager module
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('{{asset('assets/admin/img/3.jpg')}}');"></div>
                                        <div class="slider-content">
                                            <h3>Document Management System </h3>
                                            <p>This module will contain all functionalities from the present physical file system which is relevant to e-file manager module
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('{{asset('assets/admin/img/1.jpg')}}');"></div>
                                        <div class="slider-content">
                                            <h3>Document Management System </h3>
                                            <p>This module will contain all functionalities from the present physical file system which is relevant to e-file manager module
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="h-100 d-flex justify-content-center align-items-center col-md-12 col-lg-4" style="background:#2155d9;">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-10" style="color: wheat;">
                            <div class="app-logo"></div>
                            <h4 class="mb-0">
                                <center> <b><span class="d-block">Welcome back,</span>
                                <span>Please sign in to your account.</span></b></center>
                            </h4>
                            <!-- <h6 class="mt-3">No account? <a href="javascript:void(0);" class="text-primary">Sign up now</a></h6> -->
                            <div class="divider row"></div>
                            <div>
                               <form action="{{route('admin.login')}}" method="POST" enctype="multipart/form-data" id="loginFrm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <b><label for="exampleEmail">User Name</label></b>
                                                <input placeholder="Username or Email address" name="username" id="username" class="form-control" type="text" autocomplete="off" onKeyPress="if(this.value.length==40) return false;" />
                                                @if ($errors->has('username'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <b><label for="examplePassword">Password</label></b>
                                                <input placeholder= "Password" name="password" id="password" class="form-control" type="password" autocomplete="off" onKeyPress="if(this.value.length==16) return false;" />
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword" class>Enter Captcha</label>
                                                <input placeholder="Security Code" autocomplete="new-password" name="code" id="code" class="form-control" type="text" onKeyPress="if(this.value.length==6) return false;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <?php echo showCZACaptcha($this);?><a href="javascript:void(0);" onclick="reloadCZACaptcha(this);"> <i class="fa-solid fa-arrows-rotate"></i> </a>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12 col-lg-12">
                                            <div class="position-relative form-group">
                                                <b><label for="captcha">Enter Captcha:<font color="red">*</font>  <span id="captchaText">{{ $captcha }}</span></b>
                                                <button type="button" id="refresh-captcha" >
                                                    <i class="fa fa-refresh" style="font-size:22px;color:rgb(14, 141, 14);"></i></label>
                                                </button>
                                                <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Security Code">
                                                @if ($errors->has('captcha'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('captcha') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="divider row"></div>
                                    <div class="d-flex align-items-center">
                                        <div class="ml-auto">
                                            <a href="javascript:void(0);" class="btn-lg btn btn-link" style="margin-bottom: 11%; color:white;">Recover Password</a>
                                            <button type="submit" class="btn btn-primary btn-lg" id="login-button" style="margin-top: -11%;">Login to Dashboard</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="p_func" value="Log In">
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/admin/js/vendor/jquery-min.js')}}"></script>
    <script src="{{ asset('assets/js/crypto-js.min.js') }}" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
        $('input').attr('autocomplete', 'off');
      });

      $(document).on("click","#login-button",function(){
            //alert('h');
            var password= $("#password").val();

            if(password){

                password=cryptojs(password).ciphertext;
                //alert(1);
                $("#password").val(password);
                $("#loginFrm").submit();
            }

      });

      document.getElementById('refresh-captcha').addEventListener('click', function() {
        fetch("{{ route('refresh-captcha') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}",
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('captchaText').innerText = data.captcha;
        })
        .catch(error => console.error('Error:', error));
      });

      function cryptojs(password){
        if (password.length > 0) {
                var salt = CryptoJS.enc.Hex.parse("{{ $salt }}");
                var iv = CryptoJS.enc.Hex.parse("{{ $iv }}");
                var key = CryptoJS.PBKDF2("{{ $key }}", salt, {
                    hasher: CryptoJS.algo.SHA512,
                    keySize: {{ $keySize }},
                    iterations: {{ $iterations }}
                });

                var encrypted = CryptoJS.AES.encrypt(password, key, { iv: iv });

                var encryptedData = {
                    ciphertext: CryptoJS.enc.Base64.stringify(encrypted.ciphertext),
                    salt: CryptoJS.enc.Hex.stringify(salt),
                    iv: CryptoJS.enc.Hex.stringify(iv)
                };

                return encryptedData;
        }
      }
    </script>


    <script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins.js')}}"></script>
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
    <script src="{{asset('assets/js/common.functions.js')}}"></script>
    <script src="{{asset('assets/js/sha256/jquery.sha256.min.js')}}"></script>
    <script src="{{asset('assets/js/sha256/apply.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/js/main.d810cf0ae7f39f28f336.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
