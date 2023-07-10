<?php

namespace App\Containers\UserSection\User\Tasks;

use App\Ship\Parents\Tasks\Task as ParentTask;

class FormatPhoneTask extends ParentTask
{
    public function __construct()
    {
        // ..
    }

    public function run(string $phone = null): ?string
    {
        if ('' === trim($phone)) {
            $phone = null;
        }
        if (null !== $phone) {
            $phone = preg_replace('/\D/', '', $phone);
            $phoneLength = strlen($phone);

            if (10 < $phoneLength && $phoneLength < 12) {
                /**
                 * Меняем 8 на +7 в русских номерах
                 */
                $phone = mb_substr($phone, -11, 11, 'UTF-8');

                if (strpos($phone, '8') === 0) {
                    $phone[0] = 7;
                }

            } elseif (10 === $phoneLength) {
                $phone = (int)'7' . $phone;
            } elseif ($phoneLength < 10) {
                /**
                 * $phoneLength < 10
                 */
                $phone = null;
            }
        }

        return $phone;
    }
}
