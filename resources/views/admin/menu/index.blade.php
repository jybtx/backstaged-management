@extends('layouts.admin')

@section('content')    
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title clearfix">
                        菜单列表
                        @if( btnprimission('create') )
                            <a class="pull-right btn btn-outline-primary btn-icon-text" href="{{ route('menu.create') }}">添加管菜单</a>
                        @endif
                    </h4>
                    @include('flash::message')
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered" style="border:1px solid #2c2e33;">
                            <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>菜单名称</th>
                                <th>控制器名称</th>
                                <th class="text-center">描述</th>
                                <th class="text-center">添加时间</th>
                                <th class="text-center">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                @isset( $menus )
                                @foreach( $menus  as $k => $val )
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>{{ $val->name }}</td>
                                    <td>{!! $val->controller !!}</td>
                                    <td class="text-center">{!! $val->description !!}</td>
                                    <td class="text-center">{!! $val->created_at !!}</td>
                                    <td class="text-center">
                                        @if( $val['child'] )
                                            <a class="btn btn-warning btn-xs mr-2" href="{!! route('menu.edit',$val->id) !!}"><i class="fa fa-edit"></i> 修改</a>
                                        @else
                                            <a class="btn btn-warning btn-xs mr-2" href="{!! route('menu.edit',$val->id) !!}"><i class="fa fa-edit"></i> 修改</a>
                                            <a class="btn btn-danger btn-xs" href="javascript:;" onclick="delItem({!! $val->id !!})"><i class="fa fa-trash"></i> 删除</a>
                                        @endif
                                    </td>
                                </tr>
                                    @if( $val['child'] )
                                        @foreach( $val['child'] as $v )
                                        <tr>
                                            <td>{{ $v->id }}</td>
                                            <td>{!! str_repeat( '&nbsp;&nbsp;&nbsp;&nbsp;', $k) !!} |--- {{ $v->name }}</td>
                                            <td>{!! $v->controller !!}</td>
                                            <td class="text-center">{!! $v->description !!}</td>
                                            <td class="text-center">{!! $v->created_at !!}</td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-xs mr-2" href="{!! route('menu.edit',$v->id) !!}"><i class="fa fa-edit"></i> 修改</a>
                                                <a class="btn btn-danger btn-xs" href="javascript:;" onclick="delItem({!! $v->id !!})"><i class="fa fa-trash"></i> 删除</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/css/font-awesome.min.css') }}">
@endpush
@push('scripts')
<script type="text/javascript">
    function delItem (id) {
        layer.confirm('确定要删除此管理员？', {
            btn: ['是','否'] //按钮
        }, function(){
            $.ajax({
                url:"{{ url(prefixPath().'/menu/') }}/" + id,
                dataType:'json',
                type:'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{'id':id},
                success:function (data) {
                    if( data.status == 0 )
                    {
                        layer.msg(data.msg,{icon:5});
                    }
                    else
                    {
                        setTimeout(function(){
                            window.location.href = window.location.href;
                        },1500);
                        layer.msg(data.msg,{icon:6});
                    }
                },
                statusCode:{
                    401:function(){
                        layer.msg('您没有此权限，请联系管理员',{icon:5});
                    }
                }
            });
        }, function(){});
    }
</script>
@endpush