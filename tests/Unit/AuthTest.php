<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $user =factory(User::class)->create();
        $this->LoginAssert($this->loginWithEmail($user));
        $this->LoginAssert($this->loginWithMobile($user));


    }


    public function loginWithEmail($user){
        return $this->post(route('login'), [
            'username' => $user->email,
            'password' => '123aa456',
        ]);

    }
    public function loginWithMobile($user){
        return $this->post(route('login'), [
            'username' => $user->mobile,
            'password' => '123aa456',
        ]);

    }

    public function LoginAssert($response)
    {
        $response->assertStatus(200)
            ->assertJson([
                'token' => true,
            ]);
    }
}
