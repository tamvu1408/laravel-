@extends('header')
@section('content')
<h4>Employee</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
@can('create', App\Models\User::class)
<a class="btn btn-primary btn-sm" href="{{ route('employee.create') }}">Thêm</a>
@endcan
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        @foreach($users as $key => $user)
        <tbody>
            <tr>
                <td scope="row">{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->role === config('constant.ROLE_ADMIN'))
                    <p>ADMIN</p>
                    @elseif ($user->role === config('constant.ROLE_SUBADMIN'))
                    SUBADMIN
                    @else
                    EMPLOYEE
                    @endif
                </td>
                <td>
                    @if ($user->status === config('constant.STATUS_ACTIVE'))
                    <p>Đang hoạt động</p>
                    @else
                    <p>Ngừng hoạt động</p>
                    @endif
                </td>
                <td style="display: flex">
                    @can('view', $user)
                    <a href="{{ route('employee.show', $user) }}" class="btn btn-primary btn-sm">Xem</a>
                    @endcan

                    @can('delete', $user)
                    <form action="{{ route('employee.delete', $user) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                    @endcan
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
    <div class="pagination-container">
        <ul class="pagination">
            @if ($users->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @endif

            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
            <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
            @endforeach

            @if ($users->currentPage() < $users->lastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
@endsection