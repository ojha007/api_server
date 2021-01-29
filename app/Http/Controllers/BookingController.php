<?php


namespace App\Http\Controllers;


use App\Http\Requests\BookingRequest;
use App\Http\Responses\Booking\CreateResponse;
use App\Http\Responses\Booking\IndexResponse;
use App\Http\Responses\Booking\ShowResponse;
use App\Http\Responses\Booking\StoreResponse;
use App\Http\Responses\ErrorResponse;
use App\Models\Booking;
use App\Repositories\BookingRepository;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{

    /**
     * @var string
     */
    protected $routerPath = 'bookings.';

    /**
     * @var string
     */
    protected $viewPath = 'bookings.';

    /**
     * @var BookingRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->repository = new BookingRepository(new Booking());
    }

    public function index(): IndexResponse
    {
        $bookings = $this->repository->getAll();
        return new IndexResponse($this->viewPath, $bookings);
    }

    public function create(): CreateResponse
    {
        return new CreateResponse($this->viewPath);
    }

    public function store(BookingRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $this->repository->create($attributes);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
        return new StoreResponse($this->routerPath);
    }

    public function show($id)
    {
        try {
            $booking = $this->repository->getById($id);
            return new ShowResponse($this->viewPath, $booking);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function edit($id)
    {
        try {
            $booking = $this->repository->getById($id);
            return view($this->viewPath . 'edit', compact('booking'));
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function update($id, BookingRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $booking = $this->repository->update($id, $attributes);
            DB::commit();
            return view($this->viewPath . 'edit', compact('booking'));
        } catch (\Exception $exception) {
            DB::commit();
            return new ErrorResponse($exception);
        }
    }
}

