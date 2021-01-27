<?php


namespace App\Http\Controllers;


use App\Http\Responses\UpcomingSchedule\IndexResponse;

class UpcomingScheduleController extends Controller
{

    protected $routePath = 'upcoming-schedule.';

    protected $viewPath = 'enquiry.upcoming-schedule.';

    public function __construct()
    {
    }

    public function index(): IndexResponse
    {
        return new IndexResponse($this->viewPath);
    }
}
