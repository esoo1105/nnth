<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\LoaiKhoaHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoaiKhoaHocController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkQuyen:Admin');
    }
    public function index()
    {
        $loaikhoahoc = LoaiKhoaHoc::all();
        return view('loaikhoahoc', compact('loaikhoahoc'));
    }

    public function create()
    {
        return view('loaikhoahoc-add');
    }

    public function store(Request $request)
    {
        $messages = [
            'ten_loaikhoahoc.required' => 'Vui lòng nhập loại khóa học.',
            'ten_loaikhoahoc.unique' => 'Loại khóa học này đã tồn tại.',
        ];

        $request->validate([
            'ten_loaikhoahoc' => [
                'required',
                Rule::unique('loaikhoahocs', 'ten_loaikhoahoc'),
            ],
        ], $messages);

        LoaiKhoaHoc::create([
            'ten_loaikhoahoc' => $request->ten_loaikhoahoc,
        ]);
        return redirect('loaikhoahoc')->with('message', 'Thêm loại khóa học thành công');
    }

    public function show($id)
    {
        //
    }

    public function edit(int $id)
    {
        $loaikhoahoc = LoaiKhoaHoc::find($id);
        return view('loaikhoahoc-edit', compact('loaikhoahoc'));
    }
    public function update(Request $request, $id)
    {

        $messages = [
            'ten_loaikhoahoc.required' => 'Vui lòng nhập loại khóa học.',
            'ten_loaikhoahoc.unique' => 'Loại khóa học này đã tồn tại.',
        ];

        $request->validate([
            'ten_loaikhoahoc' => [
                'required',
                Rule::unique('loaikhoahocs', 'ten_loaikhoahoc')->ignore($id),
            ],
        ], $messages);

        DB::table('loaikhoahocs')->where('id', $id)->update([
            'ten_loaikhoahoc' => $request->ten_loaikhoahoc,
        ]);
        return redirect('loaikhoahoc')->with('message', 'Thêm loại khóa học thành công');
    }

    public function destroy($id)
    {
        Loaikhoahoc::destroy($id);
        return redirect()->back()->with('message', 'Xóa thành công');

    }
}
