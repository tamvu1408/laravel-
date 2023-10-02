@extends('header')
@section('content')
<h4>Department</h4>

<div>
    <table>
        <tr>
            <th>stt</th>
            <th>Phòng ban</th>
            <th>Quản lý</th>
        </tr>
        @foreach ($departments as $key => $department)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $department->name }}</td>
            <td>{{ $department->manager->name ?? '' }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection