<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqRequest;
use App\Http\Responses\ErrorResponse;
use App\Models\FAQ;
use App\Repositories\FaqRepository;

class FaqController extends Controller
{

    /**
     * @var FaqRepository
     */
    protected $repository;
    protected $viewPath = 'faqs.';
    protected $routePath = 'faqs.';

    public function __construct()
    {
        $this->repository = new FaqRepository(new FAQ());
    }

    public function index()
    {
        $faqs = $this->repository->getAll();
        return view($this->viewPath . 'index', compact('faqs'));
    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function edit(FAQ $faq)
    {
        return view($this->viewPath . 'edit', compact('faq'));
    }

    public function update()
    {

    }

    public function store(FaqRequest $request)
    {
        try {
            $attributes = $request->validated();
            $this->repository->create($attributes);
            return redirect()
                ->route($this->routePath . 'index')
                ->with('success', 'FAQ created successfully');
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }
}
