<?php


namespace App\Http\Controllers;


class DashboardController extends Controller
{

    /**
     * @var string
     */
    protected $viewPath = 'dashboard.';
    /**
     * @var string
     */
    protected $baseRoute = 'dashboard.';

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view($this->viewPath . 'index');
    }
}
