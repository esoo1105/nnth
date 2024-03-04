<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class MauSinhVien implements WithHeadings
{

    public function headings(): array
    {
        return [
            'Đợt học',
            'Mã lớp học phần',
            'Mã sinh viên',
            'Họ đệm',
            'Tên',
            'Lớp danh nghĩa',
        	'Giới tính',
            'Ngày sinh',
            'Số điện thoại',
            'Email',
            'Số tiền đã đóng',
            'Số tiền còn lại',
            'Ghi chú',
        ];
    }
}
