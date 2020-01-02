@extends('layouts.admin')

@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title clearfix">角色列表
                            @if( btnprimission('create') )
                                <a class="pull-right btn btn-outline-primary btn-icon-text" href="{{ route('role.create') }}">添加角色</a>
                            @endif
                        </h4>
                        @include('flash::message')
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered" style="border:1px solid #2c2e33;">
                                <thead>
                                <tr role="row">
                                    <th>ID</th>
                                    <th>角色名称</th>
                                    <th>角色简介</th>
                                    <th class="text-center">添加时间</th>
                                    <th class="text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @isset($roles)
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td class="text-center">{{ $role->created_at }}</td>
                                            <td class="text-center">
                                                @if( btnprimission('edit') )
                                                    <a href="{{ route('role.edit',$role->id) }}" class="btn btn-warning btn-xs mr-2"><i class="fa fa-edit"></i> 编辑</a>
                                                @endif
                                                @if( btnprimission('destroy') )
                                                    <a href="javascript:;" onclick="delItem({{$role->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> 删除</a>
                                                @endif
                                            </td>
                                        </tr>
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
<style>
.layui-layer-content,.layui-layer-btn1{color: #333 !important;}
</style>
@endpush
@push('scripts')
<script type="text/javascript">
    function delItem (id) {
        layer.confirm('确定要删除此条友情链接？', {
            btn: ['是','否'] //按钮
        }, function(){
            $.ajax({
                url:"{{ url(prefixPath().'/role/') }}/" + id,
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