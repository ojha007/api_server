<?php
if (!function_exists('spanByStatus')) {
    function spanByStatus($status, $withPull = null): string
    {
        switch ($status) {
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
