<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 9/3/2019
 * Time: 1:25 PM
 */

namespace App\Exceptions;

use RuntimeException;

class ApiValidationException extends RuntimeException
{
    protected $message, $errors, $status ;
    public $original;

    public function __construct($message, $errors, $status)
    {
        $this->message = $message;
        $this->errors = $errors;
        $this->status = $status;
        $this->original = ['message' => $message,'errors' => $errors];
    }

    public function report(): array
    {
        return ['message' => $this->message,'errors' => $this->errors,'status'=> $this->status];
    }

    public function render(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'errors' => $this->errors], $this->status);
    }

    public function getStatusCode(){
        return $this->status;
    }

}
