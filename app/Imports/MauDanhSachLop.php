<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class MauDanhSachLop implements WithHeadings
{

    public function headings(): array
    {
        return [
            'Đợt học',
            'Cở sở',
            'Lớp học',
            'Mã lớp học phần',
            'Tên học phần',
            'Mã sinh viên',
            'Họ đệm',
            'Tên',
            'Lớp danh nghĩa',
        	'Giới tính',
            'Ngày sinh',
            'Số điện thoại',
            'Email',
            'Ghi chú',
        ];
    }
}
