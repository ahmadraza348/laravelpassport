<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public const SUCCESS_MESSAGE = 'Request processed successfully';
    public const FAILED_MESSAGE = 'Unable to process request';
    public const EXCEPTION_MESSAGE = 'Something went wrong';
    public const UNAUTHORIZED_MESSAGE = 'Unauthorized access';
    public const INVALID_CREDENTIALS = 'Invalid credentials';

    public const SUCCESS_STATUS = 'success';
    public const ERROR_STATUS = 'error';
}