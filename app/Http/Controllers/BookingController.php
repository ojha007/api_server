<?php


namespace App\Http\Controllers;


use App\Http\Requests\BookingRequest;
use App\Http\Responses\Booking\CreateResponse;
use App\Http\Responses\Booking\IndexResponse;
use App\Http\Responses\Booking\ShowResponse;
use App\Http\Responses\Booking\StoreResponse;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Jobs\BookingConfirmedJob;
use App\Models\Booking;
use App\Models\Task;
use App\Models\User;
use App\Repositories\BookingRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
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
        $bookings = $this->repository->getAllByUser();
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
            $attributes['user_id'] = auth()->id();
            if ($request->get('additional_service'))
                $attributes['additional_service'] = implode(',', $request->get('additional_service'));
            $this->repository->create($attributes);
            DB::commit();
            return new StoreResponse($this->routerPath);
        } catch (Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
    }

    public function show($id)
    {
        try {
            $booking = $this->repository->getByIdWith($id, 'task.workers', 'user', 'payment');
            $workers = (new UserRepository(new User()))
                ->getUsersByRole(User::WORKER)
                ->pluck('name', 'id');
            return new ShowResponse($this->viewPath, $booking, $workers);
        } catch (Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function edit($id)
    {
        try {
            $booking = $this->repository->getById($id);
            return view($this->viewPath . 'edit', compact('booking'));
        } catch (Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function update($id, BookingRequest $request)
    {

        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $attributes['user_id'] = auth()->id();
            $this->repository->update($id, $attributes);
            DB::commit();
            return redirect()->route($this->routerPath . 'show', $id)
                ->with('success', 'Booking Edited successfully.');
        } catch (Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
    }

    public function confirmed(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->get('booking_id');
            $attributes['is_verified'] = true;
            $attributes['quotes'] = $request->get('quotes');
            $attributes['time'] = $request->get('time');
            $booking = $this->repository->update($id, $attributes);
            $max = (new TaskRepository(new Task()))->maxId();
            $bookingTitle = $booking->name . '(' . $booking->moving_date . " " . $request->get('time') . ') ';
            $booking->task()->create([
                'code' => 'T' . str_pad($max + 1, 4, 0, STR_PAD_LEFT),
                'title' => $bookingTitle,
                'booking_id' => $id,
                'date' => $booking->moving_date
            ]);
            if ($request->get('amount'))
                $booking->payment()->create([
                    'amount' => $request->get('amount'),
                    'payment_currency' => $request->get('payment_currency'),
                    'description' => null,
                    'booking_id' => $id,
                    'created_by' => auth()->id(),
                ]);

            $email = $this->repository->getById($id)->email;
            $this->dispatch(new BookingConfirmedJob($email, $booking));
            DB::commit();
            return new SuccessResponse();
        } catch (Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
    }


}

