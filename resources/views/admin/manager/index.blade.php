@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title clearfix">管理员列表
                        @if( btnprimission('create') )
                            <a class="pull-right btn btn-outline-primary btn-icon-text" href="{{ route('manager.create') }}">添加管理员</a>
                        @endif
                    </h4>
                    
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered" style="border:1px solid #2c2e33;">
                            <thead>
                                <tr role="row">
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th class="text-center">管理员姓名</th>
                                    <th class="text-center">管理员邮箱</th>
                                    <th class="text-center">管理员所属角色</th>
                                    <th class="text-center">管理员被是否禁用</th>
                                    <th class="text-center">管理员电话号码</th>
                                    <th class="text-center">管理员头像</th>
                                    <th class="text-center">添加时间</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($data)
                                    @foreach($data as $vo)
                                        <tr>
                                            <td>{{ $vo->id }}</td>
                                            <td>{{ $vo->username }}</td>
                                            <td class="text-center">{{ $vo->name }}</td>
                                            <td class="text-center">{{ $vo->email }}</td>
                                            <td class="text-center">{{ $vo->role->name }}</td>
                                            <td class="text-center">{!! $vo->isShowList($vo->is_ban) !!}</td>
                                            <td class="text-center">{{ $vo->telphone }}</td>
                                            <td class="text-center"><img src="{{ $vo->avatar?:'/vendor/images/avatar.png' }}" alt=""></td>
                                            <td class="text-center">{{ $vo->created_at }}</td>
                                            <td class="text-center">
                                                @if( btnprimission('edit') )
                                                <a href="{{ route('manager.edit',$vo->id) }}" class="btn btn-warning btn-xs mr-2"><i class="fa fa-edit"></i> 编辑</a>
                                                @endif
                                                @if( btnprimission('destroy') )
                                                <a href="javascript:;" onclick="delItem({{$vo->id}});" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> 删除</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                    {{ $data->links() }}
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
        layer.confirm('确定要删除此管理员？', {
            btn: ['是','否'] //按钮
        }, function(){
            $.ajax({
                url:"{{ url( prefixPath().'/manager/') }}/" + id,
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