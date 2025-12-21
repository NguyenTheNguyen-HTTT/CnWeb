@extends('layouts.app')

@section('content')
    <h2>Thêm Sinh Viên Mới</h2>

    <form action="{{ route('sinhvien.store') }}" method="POST">
        @csrf
        <label for="ten_sinh_vien">Tên Sinh Viên:</label>
        <input type="text" name="ten_sinh_vien" id="ten_sinh_vien" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br><br>

        <button type="submit">Thêm Sinh Viên</button>
    </form>

    <br>
    <a href="{{ route('sinhvien.index') }}">Quay lại danh sách</a>
@endsection