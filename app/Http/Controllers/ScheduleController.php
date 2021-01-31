<?php


namespace App\Http\Controllers;


use App\Http\Responses\UpcomingSchedule\IndexResponse;

class ScheduleController extends Controller
{

    protected $routePath = 'schedules.';

    protected $viewPath = 'schedule.';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): IndexResponse
    {
        return new IndexResponse($this->viewPath);
    }
}
