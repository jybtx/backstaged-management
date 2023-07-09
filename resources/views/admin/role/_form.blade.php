<div class="form-group @error('name') has-danger @enderror">
    <label for="">角色名称*：</label>
    <input type="text" name="name" class="form-control" placeholder="角色名称" value="{{ old('name')?:$roles->name??'' }}">
    @error('name')
    <label class="error mt-2 text-danger">{{ $message }}</label>
    @enderror
</div>
<div class="form-group @error('description') has-danger @enderror">
    <label for="">角色简介*：</label>
    <textarea name="description" rows="10" class="form-control" placeholder="角色简介">{{ old('description')?:$roles->description??'' }}</textarea>
    @error('description')
    <label class="error mt-2 text-danger">{{ $message }}</label>
    @enderror
</div>

<div class="border-bottom mt-4 mb-4"></div>
@isset($menus)
    @foreach($menus as $key => $value)
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right">{!! $value->name !!}： 请选择相关权限</label>
        <div class="form-check form-check-primary" style="margin-top: 5px;">
            <label class="form-check-label">
                 <input type="checkbox"
                        name="data[{!! $value->id !!}][]"
                        data-id="{!! $value->id !!}"
                        data-pid="{!! $value->pid !!}"
                        data-roleId="{!! $roles->id !!}"
                        data-tags="{!! $value->controller !!}"
                        {!! @in_array( $value->controller , json_decode( $value->getPermissionActive( $value->id , $roles->id )->authority ,true)  ) ? 'checked' : '' !!}
                        value="{!! $value->controller !!}">全选
            </label>
        </div>
    </div>
        @if( $value['child'] )
            @foreach( $value['child'] as $key => $val )
            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12 control-md-padding text-right">{!! $val->name !!}：</label>
                @if( $val->active_model )
                    @foreach( json_decode($val->active_model) as $v )
                        <div class="form-check form-check-primary mr-4" style="margin-top:0px;">
                            <label class="form-check-label">
                                <input type="checkbox"
                                       name="data[{!! $val->id !!}][]"
                                       data-id="{!! $val->id !!}"
                                       data-pid="{!! $val->pid !!}"
                                       data-roleId="{!! $roles->id !!}"
                                       {!! @in_array( $v->value , json_decode( $value->getPermissionActive( $val->id , $roles->id )->authority ,true)  ) ? 'checked' : '' !!}
                                       value="{!! $v->value !!}" >{!! $v->name !!}
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
            @endforeach
        @endif
    @endforeach
@endisset
<div class="border-bottom mt-4 mb-4"></div>

<button type="submit" class="btn btn-primary">Submit</button>

@push('scripts')
<script  type="text/javascript">
    $("input[type='checkbox']").on('click',function(){
        var id = $(this).attr('data-id');
        if($(this).is(':checked')){
            $("input[data-pid='"+id+"']").each(function(){
                //此处如果用attr，会出现第三次失效的情况
                $(this).prop("checked",true);
            });
        }else{
            $("input[data-pid='"+id+"']").each(function(){
                // $(this).removeAttr("checked",true);
                $(this).prop("checked",false);
            });
        }
    });
</script>
@endpush