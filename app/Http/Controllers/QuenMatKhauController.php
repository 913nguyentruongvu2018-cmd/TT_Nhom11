<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class QuenMatKhauController extends Controller
{
    
    public function hienFormQuenMK()
    {
        return view('quenmatkhau.nhap-email');
    }

    // xu ly gui ma
    public function guiMaXacNhan(Request $request)
    {
        $request->validate([
            'Email' => 'required|email|exists:nguoidung,Email'
        ], [
            'Email.email' => 'Định dạng Email không hợp lệ.',
            'Email.exists' => 'Email này chưa được đăng ký trong hệ thống!',
            'Email.required' => 'Vui lòng nhập email.'
        ]);

        $email = $request->Email;
        $code = rand(100000, 999999);

        Session::put('reset_code', $code);
        Session::put('reset_email', $email);

        try {
            Mail::send('emails.reset', ['code' => $code], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Mã xác nhận đổi mật khẩu');
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }

        return redirect('/nhap-ma')->with('success', 'Đã gửi mã! Vui lòng kiểm tra Mailinator.');
    }


    public function hienFormNhapMa()
    {
        if (!Session::has('reset_email')) {
            return redirect('/quen-mat-khau');
        }
        return view('quenmatkhau.nhap-ma');
    }

    // xu ly doi mk
    public function xacNhanDoiPass(Request $request)
    {
        $request->validate([
            'Code' => 'required',
            'MatKhauMoi' => 'required|min:6',
            'XacNhanMatKhau' => 'required|same:MatKhauMoi'
        ], [
            'Code.required' => 'Vui lòng nhập mã xác nhận.',
            'MatKhauMoi.min' => 'Mật khẩu phải từ 6 ký tự.',
            'MatKhauMoi.required' => 'Vui lòng nhập mật khẩu mới.',
            'XacNhanMatKhau.required' => 'Vui lòng nhập lại mật khẩu.',
            'XacNhanMatKhau.same' => 'Mật khẩu xác nhận không khớp.'
        ]);

        $sessionCode = Session::get('reset_code');
        $sessionEmail = Session::get('reset_email');

        if ($request->Code != $sessionCode) {
            return back()->with('error', 'Mã xác nhận không đúng!');
        }

        $user = NguoiDung::where('Email', $sessionEmail)->first();
        if ($user) {
            $user->update([
                'MatKhau' => Hash::make($request->MatKhauMoi)
            ]);

            Session::forget('reset_code');
            Session::forget('reset_email');

            return redirect('/dang-nhap')->with('success', 'Đổi mật khẩu thành công! Hãy đăng nhập.');
        }

        return back()->with('error', 'Lỗi hệ thống, vui lòng thử lại.');
    }
}
