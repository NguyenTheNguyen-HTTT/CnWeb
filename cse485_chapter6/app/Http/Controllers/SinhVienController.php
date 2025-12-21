<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;

class SinhVienController extends Controller
{
   public function index() 
    { 
        $danhSachSV = SinhVien::all(); 
        return view('sinhvien.list', compact('danhSachSV')); 
    } 
 
  
    public function create()
    {
        return view('sinhvien.create');
    }
 
    public function store(Request $request) 
    { 
        
        $request->validate([
            'ten_sinh_vien' => 'required|string|max:255',
            'email' => 'required|email|unique:sinh_viens,email',
        ]);

         $data = $request->all(); 
 
        SinhVien::create($data); 
 
  
        return redirect()->route('sinhvien.index'); 
    } 
}
