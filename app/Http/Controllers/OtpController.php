<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendOTP;
use App\Models\KetQua;
use App\Models\SinhVien;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $messages = [
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
        ];
        $request->validate([
            'email' => 'required|email',
        ], $messages);

        $email = $request->input('email');
        $sinhVien = Ketqua::whereHas('sinhvien', function ($query) use ($email) {
            $query->where('email', $email);
        })->first();
        // dd($sinhVien);
        if ($sinhVien) {

            $otp = SendOTP::generateOTP();
            $sinhVien->otp = $otp;
            $sinhVien->save();

            // Gửi mã OTP qua email
            Mail::to($email)->send(new SendOTP($otp));

            // Chuyển hướng người dùng đến trang nhập OTP
            return view('verifyotp', compact('otp', 'email'));
        } else {
            return redirect()->route('tracuudiem')->with('error', 'Email không có trong danh sách đăng ký');
        }
    }

    public function verifyOtp(Request $request)
    {
        $otp = $request->input('otp');
        $email = $request->input('email');
        $ketqua = Ketqua::whereHas('sinhvien', function ($query) use ($email) {
            $query->where('email', $email);
        })->first();
        if ($ketqua && $ketqua->otp == $otp) {
            $ketqua->otp = null;
            $ketqua->save();
            return view('tracuudiem', compact('ketqua', 'email'));
        } else {
            $ketqua->otp = null;
            $ketqua->save();
            return redirect()->route('tracuudiem')->with('error', 'Mã OTP không chính xác!');
        }
    }
}
