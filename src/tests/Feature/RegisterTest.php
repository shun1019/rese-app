<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 正常にユーザー登録できるかテスト
     */
    public function test_user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'name' => '山田太郎',
            'email' => 'yamada@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/email/verify');
        $this->assertDatabaseHas('users', [
            'email' => 'yamada@example.com',
        ]);
    }

    /**
     * 名前が空だとエラーになることを確認
     */
    public function test_name_is_required()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * メール形式が不正だとエラーになることを確認
     */
    public function test_email_must_be_valid_format()
    {
        $response = $this->post('/register', [
            'name' => '佐藤次郎',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * メールアドレスが重複している場合エラー
     */
    public function test_email_must_be_unique()
    {
        User::factory()->create(['email' => 'test@example.com']);

        $response = $this->post('/register', [
            'name' => '重複テスト',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * パスワードが未入力または短いとエラー
     */
    public function test_password_is_required_and_must_be_min_8()
    {
        $response1 = $this->post('/register', [
            'name' => '田中花子',
            'email' => 'tanaka@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);
        $response1->assertSessionHasErrors(['password']);

        $response2 = $this->post('/register', [
            'name' => '田中花子',
            'email' => 'tanaka2@example.com',
            'password' => 'pass123',
            'password_confirmation' => 'pass123',
        ]);
        $response2->assertSessionHasErrors(['password']);
    }
}
