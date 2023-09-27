<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <div>
            <a href="{{ route('employee.index') }}">Employee</a>
            <a href="{{ route('department.index') }}">Department</a>
        </div>
        <div>
            <div>{{ Auth::user()->name }}</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Đăng xuất</button>
            </form>
        </div>
    </header>
    <div>
        @yield('content')
    </div>