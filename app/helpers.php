<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('spanByStatus')) {
    function spanByStatus($status, $withPull = null): string
    {
        switch ($status) {
            case '1':
                $class = 'bg-green';
                $status = 'Confirmed';
                break;
            case '0':
                $class = 'bg-yellow';
                $status = 'Pending';
                break;
            case 'Pending':
                $class = 'bg-yellow';
                break;
            case 'Started':
                $class = 'bg-green';
                break;
            case 'Rejected':
                $class = 'bg-red';
                break;
            default:
                $class = 'bg-blue';
        }
        return '<span style="cursor: default;"
        class="label btn btn-flat  ' . $class . ' ' . ($withPull) . '">'
            . ucfirst($status) . '</span>';
    }
}

function getDefaultAccount()
{
    try {
        $a = Storage::disk('local')->get(config('myob.defaultAccount'));
        return json_decode($a);
    } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
        return null;
    }
}


if (!function_exists('logException')) {
    function logException(Exception $exception)
    {
        \Illuminate\Support\Facades\Log::error(
            $exception->getTraceAsString()
            . '<==================================>'
            . $exception->getMessage());
    }
}
if (!function_exists('successResponse')) {
    function successResponse(): object
    {

        return (object)[
            'message' => 'SUCCESS',
            'status' => 201,
            'data' => []
        ];
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($input)
    {
        if ($input) {
            $date = str_replace('/Date(', '', $input);
            $parts = explode('+', $date);
            return date("Y-m-d", $parts[0] / 1000);
        }
        return '';
    }
}
