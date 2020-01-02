@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">添加菜单</h4>
                    @include('flash::message')
                    <form class="forms-sample" action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.menu._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('vendor/js/file-upload.js') }}"></script>
@endpush