<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * 管理ダッシュボード
     */
    public function index()
    {
        return view('admin.dashboard');
    }

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
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'owner',
            'email_verified_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', '店舗代表者を作成しました。');
    }
}
