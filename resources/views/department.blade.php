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
        @foreach ($departments as $key => $d)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $d['department']->name }}</td>
            <td>{{ $d['manager'] }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection