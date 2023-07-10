<?php

namespace App\Containers\UserSection\Authentication\Tests\Unit;

use App\Containers\UserSection\Authentication\Actions\ForgotPasswordAction;
use App\Containers\UserSection\Authentication\Tests\TestCase;
use App\Containers\UserSection\Authentication\UI\API\Requests\ForgotPasswordRequest;

/**
 * Class ForgotPasswordActionTest.
 *
 * @group authentication
 * @group unit
 */
class ForgotPasswordActionTest extends TestCase
{
    public function testIfUserNotExists_ShouldNotReturn404(): void
    {
        $data = [
            'email' => 'wrong@mail.test',
        ];

        $request = new ForgotPasswordRequest($data);
        $result = app(ForgotPasswordAction::class)->run($request);

        $this->assertFalse($result);
    }
}
