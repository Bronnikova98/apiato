<?php

namespace App\Containers\UserSection\Authentication\Tests\Unit;

use App\Containers\UserSection\Authentication\Classes\LoginCustomAttribute;
use App\Containers\UserSection\Authentication\Tests\TestCase;
use Illuminate\Support\Facades\Config;

/**
 * Class LoginCustomAttributeTest.
 *
 * @group authentication
 * @group unit
 */
class LoginCustomAttributeTest extends TestCase
{
    public function testGivenValidLoginAttributeThenExtractUsername(): void
    {
        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $result = LoginCustomAttribute::extract($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }

    private function assertAttributeIsExtracted(array $result, array $userDetails): void
    {
        list($username, $loginAttribute) = $result;
        $this->assertSame($username, strtolower($userDetails['email']));
        $this->assertSame($loginAttribute, 'email');
    }

    public function testWhenNoLoginAttributeIsProvidedShouldUseEmailFieldAsDefaultFallback(): void
    {
        Config::offsetUnset('userSection-authentication.login.attributes');
        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $result = LoginCustomAttribute::extract($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }
}
