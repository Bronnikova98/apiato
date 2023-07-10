<?php

namespace App\Containers\UserSection\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception as ParentException;
use Symfony\Component\HttpFoundation\Response;

class InvalidEmailVerificationDataException extends ParentException
{
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;
    protected $message = 'Invalid Email Verification Data Provided.';
}
