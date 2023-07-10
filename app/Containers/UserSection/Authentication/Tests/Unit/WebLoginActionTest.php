<?php

namespace App\Containers\UserSection\Authentication\Tests\Unit;

use App\Containers\UserSection\Authentication\Actions\WebLoginAction;
use App\Containers\UserSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\UserSection\Authentication\Tests\TestCase;
use App\Containers\UserSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\UserSection\User\Models\User;
use Illuminate\Support\Facades\Config;

/**
 * Class WebLoginActionTest.
 *
 * @group authentication
 * @group unit
 */
class WebLoginActionTest extends TestCase
{
    private array $userDetails;
    private LoginRequest $request;
    private mixed $action;

    public function testLogin(): void
    {
        $user = $this->action->run($this->request);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame($user->name, $this->userDetails['name']);
    }

    public function testLoginWithInvalidEmailThrowsAnException(): void
    {
        $this->expectException(LoginFailedException::class);
        $this->expectExceptionMessage('Invalid Login Credentials.');

        $this->request = new LoginRequest(['email' => 'wrong@email.com', 'password' => $this->userDetails['password']]);

        $this->action->run($this->request);
    }

    public function testLoginWithInvalidPasswordThrowsAnException(): void
    {
        $this->expectException(LoginFailedException::class);
        $this->expectExceptionMessage('Invalid Login Credentials.');

        $this->request = new LoginRequest(['email' => $this->userDetails['email'], 'password' => 'wrong-password']);

        $this->action->run($this->request);
    }

    public function testLoginWithUppercaseEmail(): void
    {
        Config::set('userSection-authentication.login.case_sensitive', false);

        $user = $this->action->run($this->request);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame($user->name, $this->userDetails['name']);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'name' => 'Mahmoud',
        ];
        $this->getTestingUser($this->userDetails);
        $this->actingAs($this->testingUser, 'web');
        $this->request = new LoginRequest($this->userDetails);
        $this->action = app(WebLoginAction::class);
    }
}
