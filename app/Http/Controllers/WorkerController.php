<?php


namespace App\Http\Controllers;


use App\Http\Responses\Worker\IndexResponse;

class WorkerController extends Controller
{

    /**
     * @var string
     */
    protected $routePath = 'workers.';
    /**
     * @var string
     */
    protected $viewPath = 'workers.';

    public function __construct()
    {
    }

    public function index(): IndexResponse
    {
        return new IndexResponse($this->viewPath);
    }

    public function create()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }

}
