<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite(['resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <div class="navbar-brand">
                <a href="{{ route('employee.index') }}">Employee</a>
                <a href="{{ route('department.index') }}">Department</a>
            </div>
            <div class="d-flex">
                <div>{{ Auth::user()->name }}</div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-sm" type="submit">Đăng xuất</button>
                </form>
            </div>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>