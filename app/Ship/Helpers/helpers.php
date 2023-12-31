<?php

/*
|--------------------------------------------------------------------------
| Ship Helpers
|--------------------------------------------------------------------------
|
| Write only general helper functions here.
| Container specific helper functions should go into their own related Containers.
| All files under app/{section_name}/{container_name}/Helpers/ folder will be autoloaded by Apiato.
|
*/
if (!function_exists('format_phone')) {
    function format_phone(string $phone): string
    {
        return \App\Ship\Services\PhoneFormatter::format($phone);
    }
}
