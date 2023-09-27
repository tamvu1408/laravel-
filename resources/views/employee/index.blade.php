@extends('header')
@section('content')
<h4>Employee</h4>
@if (session('success'))
<span class="success">{{ session('success') }}</span>
@endif
<div>
    <table>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th></th>
        </tr>
        @foreach($users as $key => $user)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if ($user->role === config('constant.ROLE_ADMIN'))
                ADMIN
                @elseif ($user->role === config('constant.ROLE_SUBADMIN'))
                SUBADMIN
                @else
                EMPLOYEE
                @endif
            </td>
            <td>{{ $user->status }}</td>
            <td style="display: flex">
                @can('view', $user)
                <a href="{{ route('employee.show', $user) }}">Xem</a>
                @endcan
                @can('delete', $user)
                <form action="{{ route('employee.delete', $user) }}" method="POST">
                    @csrf
                    <button type="submit">Xóa</button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection