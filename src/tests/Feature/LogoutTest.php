<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザーが正常にログアウトできることをテスト
     */
    public function test_user_can_logout_successfully()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    /**
     * ログアウト後にマイページにアクセスできないことをテスト
     */
    public function test_user_cannot_access_protected_page_after_logout()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)->post('/logout');

        $response = $this->get('/mypage');

        $response->assertRedirect('/login');
    }
}
