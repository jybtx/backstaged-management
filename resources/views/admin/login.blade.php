<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }} - {{ trans('Background Management System') }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/style.css') }}">
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-center mb-3">{{ trans('Background Management System') }}</h3>   
                        @if( isset($faild) )
                        <h6 class="card-title text-center"><code>{{ $faild }}</code></h6>
                        @endif
                        <form method="POST" action="{{ route( prefixPath() .'.login' ) }}">
                            <div class="form-group @error(config('backstaged.username')) has-danger @enderror">
                                <label>{{ trans('Username') }} *</label>
                                <input type="text" name="{{ config('backstaged.username') }}" class="form-control p_input" value="{{ old(config('backstaged.username')) }}"  autocapitalize="off" autocorrect="off" autocomplete="off" spellcheck="false" placeholder="{{ trans('Username') }}">
                                @error( config('backstaged.username') )
                                    <code>{{ $message }}</code>                                  
                                @enderror
                            </div>
                            <div class="form-group @error('password') has-danger @enderror"">
                                <label>{{ trans('Password') }} *</label>
                                <input type="password" class="form-control p_input" name="password" placeholder="{{ trans('Password') }}">
                                @error('password')
                                    <code>{{ $message }}</code>       
                                @enderror
                            </div>
                            <div class="form-group @error('captcha') has-danger @enderror">
                                <label>{{ trans('Captcha') }} *</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" name="captcha" class="form-control p_input"  autocapitalize="off" autocorrect="off" autocomplete="off" spellcheck="false" placeholder="{{ trans('Captcha') }}" >
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <img src="{!! captcha_src() !!}" onclick="this.src='{!! captcha_src() !!}?'+Math.random()" style="cursor: pointer" alt="验证码">
                                    </div>
                                </div>
                                @error('captcha')
                                    <code>{{ $message }}</code>                                   
                                @enderror
                            </div>
                            <br />
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block enter-btn">  {{ trans('Login') }}
                                </button>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('vendor/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('vendor/js/off-canvas.js') }}"></script>
<script src="{{ asset('vendor/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('vendor/js/misc.js') }}"></script>
<script src="{{ asset('vendor/js/settings.js') }}"></script>
<script src="{{ asset('vendor/js/todolist.js') }}"></script>
    <!-- endinject -->
</body>
</html>