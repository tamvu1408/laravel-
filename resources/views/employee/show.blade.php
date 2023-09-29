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
            <h4>{{ $user->name }}</h4>
            <form action="{{ route('employee.update', $user) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="name">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                    </div>
                    @error('name')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                    </div>
                    @error('email')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="birth_date">Ngày sinh</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ $user->birth_date }}">
                    </div>
                    @error('birth_date')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="gender">Giới tính</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-select">
                            <option value="{{ config('constant.MALE') }}" {{ ($user->gender === config('constant.MALE') ) ? "selected":"" }}>Nam</option>
                            <option value="{{ config('constant.FEMALE') }}" {{ ($user->gender === config('constant.FEMALE') ) ? "selected":"" }}>Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="starting_date">Ngày bắt đầu</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('starting_date') is-invalid @enderror" name="starting_date" value="{{ $user->starting_date }}">
                    </div>
                    @error('starting_date')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="status">Trạng thái</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="{{ config('constant.STATUS_ACTIVE') }}" {{ ($user->status === config('constant.STATUS_ACTIVE') ) ? "selected":"" }}>Hoạt động</option>
                            <option value="{{ config('constant.STATUS_INACTIVE') }}" {{ ($user->status === config('constant.STATUS_INACTIVE') ) ? "selected":"" }}>Không hoạt động</option>
                        </select>
                    </div>
                    @error('status')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="department">Phòng ban</label>
                    <div class="col-sm-10">
                        <select name="department" class="form-select @error('department') is-invalid @enderror">
                            @foreach ($departments as $d)
                            <option value="{{ $d['department']->id }}" {{ ($user->department_id === $d['department']->id ) ? "selected":"" }}>{{ $d['department']->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('department')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                @can('update', $user)
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Sửa</button>
                </div>
                @endcan
            </form>
        </div>
    </div>
</div>
@endsection