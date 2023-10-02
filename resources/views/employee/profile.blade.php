@extends('header')
@section('content')

<div class="container text-center">
    <div class="row justify-content-center">
        <h4>Thông tin cá nhân</h4>
        <div class="col-2">
            @if(empty($user->avatar))
            <img src="{{ asset('avatar.png') }}" class="rounded mx-auto d-block" style="max-width: 100%" alt="Avatar">
            @else
            <img src="{{ asset($user->avatar) }}" class="rounded mx-auto d-block" style="max-width: 100%" alt="Avatar">
            @endif
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Chỉnh sửa</button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p>Chỉnh sửa ảnh đại diện</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('employee.update_avatar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="avatar" class="col-form-label">Chọn ảnh: </label>
                                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" onchange="previewImage(this)">
                                    @error('avatar')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                    <img id="image-preview" src="{{ asset($user->avatar ?? 'avatar.png') }}" alt="Preview" style="max-width: 100%">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Chỉnh sửa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <p>{{ $user->name }}</p>
        </div>
        <div class="col-10">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('employee.update', auth()->user()) }}" method="POST">
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
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('department')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
    function previewImage(input) {
        // console.log(input.files[0]);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('image-preview');
                preview.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>