<?php

namespace App\Http\Controllers;

use App\Models\KhoaHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        //

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Khoahoc::where('ten_khoahoc', 'LIKE', $request->khoahoc . '%')
                ->orWhere('ma_khoahoc', 'LIKE', '%' . $request->khoahoc . '%')
                ->get();
            $output = '';

            if (count($data) > 0) {

                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

                foreach ($data as $row) {
                    // ' . route('chitiet', $row->id) . '
                    $output .= '<li class="list-group-item"><a href="' . route('chitiet', $row->id) . '">' . $row->ma_khoahoc . ' - ' . $row->ten_khoahoc . '<a/></li>';
                }

                $output .= '</ul>';
            } else {

                $output .= '<li class="list-group-item">' . 'Không có kết quả' . '</li>';
            }
            return $output;
        }
    }

}
