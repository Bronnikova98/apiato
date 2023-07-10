<?php

namespace App\Containers\UserSection\User\UI\CLI\Commands;

use App\Containers\UserSection\User\Actions\CreateAdminAction;
use App\Ship\Parents\Commands\ConsoleCommand as ParentConsoleCommand;

class CreateAdminCommand extends ParentConsoleCommand
{
    protected $signature = 'apiato:create:admin';

    protected $description = 'Create a new User with the ADMIN role';

    public function handle(): void
    {
        $fName = $this->ask('Enter the f_name for this user');
        $lName = $this->ask('Enter the l_name for this user');
        $mName = $this->ask('Enter the m_name for this user');
        $email = $this->ask('Enter the email address of this user');
        $password = $this->secret('Enter the password for this user');
        $password_confirmation = $this->secret('Please confirm the password');

        if ($password !== $password_confirmation) {
            $this->error('Passwords do not match - exiting!');

            return;
        }

        $data = [
            'f_name' => $fName,
            'l_name' => $lName,
            'm_name' => $mName,
            'email' => $email,
            'password' => $password,
        ];

        app(CreateAdminAction::class)->run($data);

        $this->info('Admin ' . $email . ' was successfully created');
    }
}
