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
