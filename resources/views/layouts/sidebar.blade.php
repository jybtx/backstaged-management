<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ url(prefixPath().DIRECTORY_SEPARATOR.'index') }}"><img src="/vendor/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="{{ url(prefixPath().DIRECTORY_SEPARATOR.'index') }}"><img src="/vendor/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{!! administrator()->avatar?:'/vendor/images/avatar.png' !!}" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{!! administrator()->name !!}</h5>
                        <span>{!! administrator()->username !!}</span>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        @isset( $sidebarMenu )
            @foreach( $sidebarMenu as $vo )
                @if( $vo['child'] )
                <li class="nav-item menu-items {!! active_class( if_uri_pattern( explode(',',$vo['active']) ) ) !!}">
                    <a class="nav-link" data-toggle="collapse" href="#page-{{ $vo['id'] }}-layouts-{{ $vo['controller'] }}" aria-expanded="{!! active_class(if_uri_pattern(explode(',',$vo['active'])), 'ture', 'false') !!}" aria-controls="page-{{ $vo['id'] }}-layouts-{{ $vo['controller'] }}">
                        <span class="menu-icon">
                            <i class="mdi {{ $vo['icon'] }}"></i>
                        </span>
                        <span class="menu-title">{{ $vo['name'] }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse {!! active_class(if_uri_pattern(explode(',',$vo['active'])), 'show', '') !!}" id="page-{{ $vo['id'] }}-layouts-{{ $vo['controller'] }}">
                        <ul class="nav flex-column sub-menu">
                            @foreach( $vo['child'] as $child )
                            <li class="nav-item">
                                <a class="nav-link {!! active_class( if_uri_pattern( [ $child['active'] ]), 'active') !!}" href="{!! url($child['url']) !!}">{!! $child['name'] !!}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                @else
                <li class="nav-item menu-items {!! active_class( if_uri_pattern( explode(',',$vo['active']) ) ) !!}">
                    <a class="nav-link" href="{{ url($vo['url']) }}">
                      <span class="menu-icon">
                        <i class="mdi {{ $vo['icon'] }}"></i>
                      </span>
                      <span class="menu-title">{{ $vo['name'] }}</span>
                    </a>
                  </li>
                @endif
            @endforeach
        @endisset
    </ul>
</nav>