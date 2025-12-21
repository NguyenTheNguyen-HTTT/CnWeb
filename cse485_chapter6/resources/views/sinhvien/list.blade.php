@extends('layouts.app')

@section('content')
    <h2>Danh sách Sinh Viên</h2>

    <a href="{{ route('sinhvien.create') }}" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;">Thêm Sinh Viên Mới</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sinh Viên</th>
                <th>Email</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($danhSachSV as $sv)
                <tr>
                    <td>{{ $sv->id }}</td>
                    <td>{{ $sv->ten_sinh_vien }}</td>
                    <td>{{ $sv->email }}</td>
                    <td>
                        <a href="#">Sửa</a> | <a href="#">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection