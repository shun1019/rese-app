<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * 店舗代表者作成フォーム
     */
    public function createOwner()
    {
        return view('admin.create-owner');
    }

    /**
     * 店舗代表者登録処理
     */
    public function storeOwner(StoreOwnerRequest $request)
    {
        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'role'              => 'owner',
            'email_verified_at' => Carbon::now(),
        ]);

        return redirect()->route('mypage')->with('success', '店舗代表者を作成しました。');
    }

    /**
     * メール送信フォーム表示
     */
    public function showMailForm()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.send-mail', compact('users'));
    }

    /**
     * メール送信処理
     */
    public function sendMail(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = User::findOrFail($request->user_id);

        Mail::to($user->email)->send(new AdminNotificationMail($request->subject, $request->message));

        return redirect()->route('admin.mail.form')->with('success', 'メールを送信しました。');
    }
}
