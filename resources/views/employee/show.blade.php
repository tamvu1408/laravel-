@extends('header')
@section('content')
<h4>{{ $user->name }}</h4>

@if (session('success'))
<span class="success">{{ session('success') }}</span>
@endif
<div>
    <form action="{{ route('employee.update', $user) }}" method="POST">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $user->name }}">
            @error('name')
            <strong>{{ $message }}</strong>
            @enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ $user->email }}">
            @error('email')
            <strong>{{ $message }}</strong>
            @enderror
        </div>
        <div>
            <label for="birth_date">Ngày sinh</label>
            <input type="date" name="birth_date" value="{{ $user->birth_date }}">
        </div>
        <div>
            <label for="gender">Giới tính</label>
            <select name="gender" value="">
                <option value="{{ config('constant.MALE') }}" {{ ($user->gender === config('constant.MALE') ) ? "selected":"" }}>Nam</option>
                <option value="{{ config('constant.FEMALE') }}" {{ ($user->gender === config('constant.FEMALE') ) ? "selected":"" }}>Nữ</option>
            </select>
        </div>
        <div>
            <label for="starting_date">Ngày bắt đầu</label>
            <input type="date" name="starting_date" value="{{ $user->starting_date }}">
            @error('starting_date')
            <strong>{{ $message }}</strong>
            @enderror
        </div>
        <div>
            <label for="status">Trạng thái</label>
            <select name="status" value="{{ $user->status }}">
                <option value="{{ config('constant.STATUS_ACTIVE') }}" {{ ($user->status === config('constant.STATUS_ACTIVE') ) ? "selected":"" }}>Hoạt động</option>
                <option value="{{ config('constant.STATUS_INACTIVE') }}" {{ ($user->status === config('constant.STATUS_ACTIVE') ) ? "selected":"" }}>Không hoạt động</option>
            </select>
            @error('status')
            <strong>{{ $message }}</strong>
            @enderror
        </div>
        <div>
            <label for="department">Phòng ban</label>
            <select name="department">
                @foreach ($departments as $d)
                <option value="{{ $d['department']->id }}" {{ ($user->department_id === $d['department']->id ) ? "selected":"" }}>{{ $d['department']->name }}</option>
                @endforeach
            </select>
            @error('department')
            <strong>{{ $message }}</strong>
            @enderror
        </div>
        @can('update', $user)
        <form action="{{ route('employee.update', $user) }}" method="POST">
            @csrf
            <button type="submit">Sửa</button>
        </form>
        @endcan
    </form>
</div>
@endsection