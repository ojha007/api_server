<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;

class DashboardController extends Controller
{

    private function totalWorker(): int
    {
        return 10;
    }

    private function totalTask(): int
    {
        return 100;
    }

    private function completedTask(): int
    {
        return 10;

    }

    private function rejectedTask(): int
    {
        return 1;
    }

    public function index(): SuccessResponse
    {
        $data = [
            'totalWorker' => $this->totalWorker(),
            'totalTask' => $this->totalTask(),
            'completedTask' => $this->completedTask(),
            'rejectedTask' => $this->rejectedTask(),
        ];
        return new SuccessResponse($data);
    }
}
