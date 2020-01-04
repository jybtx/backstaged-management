<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="{{ url(prefixPath().DIRECTORY_SEPARATOR.'index') }}">
            <img src="/vendor/images/logo-mini.png" alt="logo" style="width: 100%;" />
        </a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav w-100"></ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-lg-block"></li>
            <li class="nav-item nav-settings d-none d-lg-block"></li>
            <li class="nav-item dropdown border-left"></li>
            <li class="nav-item dropdown border-left"></li>
            <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                    <div class="navbar-profile">
                        <img class="img-xs rounded-circle" src="{!! administrator()->avatar?:'/vendor/images/avatar.png' !!}" alt="">
                        <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ administrator()->username }}</p>
                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                    <h6 class="p-3 mb-0">Profile</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item" onclick="clearCache()">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-notification-clear-all"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">清除缓存</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route(prefixPath() .'.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-logout text-danger"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">{{ trans('Logout') }}</p>
                        </div>
                        <form id="logout-form" action="{{ route(prefixPath() .'.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                    <div class="dropdown-divider"></div>
                    <p class="p-3 mb-0 text-center">Advanced settings</p>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>

<script type="text/javascript">
function clearCache() {
    $.ajax({
        url:"{{ route(prefixPath() .'.clear') }}",
        dataType:'json',
        type:'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{},
        success:function (data) {
            if( data.status == 0 )
            {
                layer.msg(data.msg,{icon:5});
            }
            else
            {
                // setTimeout(function(){
                //     window.location.href = window.location.href;
                // },1500);
                layer.msg(data.msg,{icon:6,time:9000});
            }
        },
        statusCode:{
            401:function(){
                layer.msg('您没有此权限，请联系管理员',{icon:5});
            }
        }
    });
}
</script>
<style>
    .layui-layer-content.layui-layer-padding{color: #333;}
</style>
