<div class="form-group @error('username') has-danger @enderror">
    <label>用户名*：</label>
    @if( !$manager->username )
        <input type="text" name="username" class="form-control" placeholder="用户名" value="{{ old('username')?: $manager->username }}"/>
    @else
        <div class="form-control">{{ $manager->username }}</div>
    @endif
    @error('username')
    <label class="error mt-2 text-danger">{{ $message }}</label>
    @enderror
</div>
<div class="form-group @error('name') has-danger @enderror">
    <label for="">管理员姓名*:</label>
    <input type="text" name="name" class="form-control" placeholder="管理员姓名" value="{{ old('name')?:$manager->name }}">
    @error('name')
    <label class="error mt-2 text-danger">{{ $message }}</label>
    @enderror
</div>
<div class="form-group @error('email') has-danger @enderror">
    <label for="">管理员邮箱*:</label>
    <input type="text" name="email" class="form-control" placeholder="管理员邮箱" value="{{ old('email')?:$manager->email }}">
    @error('email')
    <label class="error mt-2 text-danger">{{ $message }}</label>
    @enderror
</div>
@if( auth('admin')->user()->role_id == 1 )
<div class="form-group @error('name') has-danger @enderror">
    <label for="">管理员所属角色:</label>
    <select name="role_id" id="role_id" class="form-control">
        @isset($roles)
            @foreach( $roles as $role )
                <option value="{{ $role->id }}" {!! $role->id == $manager->role_id?'selected':'' !!} >{!! $role->name !!}</option>
            @endforeach
        @endisset
    </select>
    @error('role_id')
    <label class="error mt-2 text-danger">{{ $message }}</label>
    @enderror
</div>
@endif

<div class="form-group @error('telphone') has-danger @enderror">
    <label for="">管理员电话号码*:</label>
    <input type="text" name="telphone" class="form-control" placeholder="管理员电话号码" value="{{ old('telphone')?:$manager->telphone }}">
    @error('telphone')
    <label class="error mt-2 text-danger">{{ $message }}</label>
    @enderror
</div>
<div class="form-group @error('telphone') has-danger @enderror">
    <label for="">管理员密码*:</label>
    <input type="password" name="password" class="form-control" placeholder="管理员密码" value="{{ old('password') }}">
    @error('password')
    <label class="error mt-2 text-danger">{{ $message }}</label>
    @enderror
</div>
<div class="form-group">
    <label>管理员头像：</label>
    <input type="file" name="avatar" class="file-upload-default" value="{{ $manager->avatar }}">
    <div class="input-group col-xs-12">
        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload avatar Image" value="{{ $manager->avatar }}">
        <span class="input-group-append">
            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
        </span>
    </div>
    @error('avatar')
    <label class="error mt-2 col-sm-12 text-danger">{{ $message }}</label>
    @enderror
</div>
<div class="form-group row">
    <label class="col-sm-12">管理员被是否禁用：</label>
    @isset($manager)
        @foreach($manager->isSetStatus() as $index =>  $manag)
            <div class="col-sm-1">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="is_ban" {{ isset($manager->is_ban) && $manager->is_ban == $index ? 'checked':'' }} value="{{ $index }}"> {{ $manag }}
                    </label>
                </div>
            </div>
        @endforeach
    @endisset
    <div class="clearfix col-md-12"></div>
    @error('is_ban')
    <label class="error mt-2 col-sm-12 text-danger">{{ $message }}</label>
    @enderror
</div>

<button type="submit" class="btn btn-primary">Submit</button>