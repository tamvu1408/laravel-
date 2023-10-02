@extends('header')
@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <h4>Thêm nhân viên</h4>
            <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="name">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="username">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}">
                    </div>
                    @error('username')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="birth_date">Ngày sinh</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}">
                    </div>
                    @error('birth_date')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="gender">Giới tính</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror" value="{{ old('gender') }}">
                            <option value="{{ config('constant.MALE') }}">Nam</option>
                            <option value="{{ config('constant.FEMALE') }}">Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="starting_date">Ngày bắt đầu</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('starting_date') is-invalid @enderror" name="starting_date" value="{{ old('starting_date') }}">
                    </div>
                    @error('starting_date')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="status">Trạng thái</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-select @error('status') is-invalid @enderror" value="{{ old('status') }}">
                            <option value="{{ config('constant.STATUS_ACTIVE') }}">Hoạt động</option>
                            <option value="{{ config('constant.STATUS_INACTIVE') }}">Không hoạt động</option>
                        </select>
                    </div>
                    @error('status')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="department">Phòng ban</label>
                    <div class="col-sm-10">
                        <select name="department" class="form-select @error('department') is-invalid @enderror" value="{{ old('department') }}">
                            <option value="">--department--</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('department')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="role">Quyền</label>
                    <div class="col-sm-10">
                        <select name="role" class="form-select @error('role') is-invalid @enderror" value="{{ old('role') }}">
                            <option value="{{ config('constant.ROLE_ADMIN') }}">Admin</option>
                            <option value="{{ config('constant.ROLE_SUBADMIN') }}">Sub-admin</option>
                            <option value="{{ config('constant.EMPLOYEE') }}" selected>Emloyee</option>
                        </select>
                    </div>
                    @error('role')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="password">Mật khẩu</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    </div>
                    @error('password')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="password_confirmation">Xác nhận mật khẩu</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                    </div>
                    @error('password_confirmation')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="avatar">Ảnh đại diện</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}">
                    </div>
                    @error('avatar')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                @can('create', App\Models\User::class)
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
                @endcan
            </form>
        </div>
    </div>
</div>
@endsection