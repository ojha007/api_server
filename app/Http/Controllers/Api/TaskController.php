<?php


namespace App\Http\Controllers\Api;


use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\ValidationResponse;
use App\Models\Task;
use App\Models\TaskFile;
use App\Models\TaskJourney;
use App\Models\TaskStatus;
use App\Repositories\TaskJourneyRepository;
use App\Repositories\TaskRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TaskController extends \App\Http\Controllers\TaskController
{
    /**
     * @var TaskRepository
     */
    protected $repository;

    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->repository = new TaskRepository(new Task());
    }

    public function latestStatusQuery(): Builder
    {
        return DB::table('task_status')
            ->select('task_id', 'status', 'id')
            ->where('user_id', auth()->id())
            ->whereIn('id',
                DB::table('task_status')
                    ->selectRaw('max(id) as id')
                    ->groupBy('task_id')
                    ->pluck('id')
            );
    }

    public function index()
    {
        try {
            $latestStatus = $this->latestStatusQuery();
            $tasks = DB::table('tasks')
                ->select('tasks.code', 'tasks.id', 'tasks.title', 'taskStatus.status', 'tasks.description', 'task_workers.id as taskWorkerId')
                ->join('task_workers', 'tasks.id', '=', 'task_workers.task_id')
                ->join('bookings', 'bookings.id', '=', 'tasks.booking_id')
                ->joinSub($latestStatus, 'taskStatus', 'taskStatus.task_id', '=', 'tasks.id')
                ->where('bookings.is_verified', true)
                ->where('task_workers.worker_id', '=', auth()->id())
                ->orderByDesc('moving_date')
                ->get();
            return new SuccessResponse($tasks);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }


    public function changeStatus(Request $request, $id)
    {
        $status = $request->get('status');
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Pending,Started,Rejected,Completed',
            'reason' => 'nullable',
        ]);
        if ($validator->fails())
            return new ValidationResponse($validator);
        try {
            $latestStatus = $this->latestStatusQuery()->first();
            if ($latestStatus->status == 'Started' && $request->get('status') == 'Started') {
                return new ValidationResponse(null, 'Another Task is already started.');
            }
            TaskStatus::create([
                'status' => $request->get('status'),
                'task_id' => $id,
                'user_id' => auth()->id(),
                'reason' => $request->get('reason'),
            ]);

            $time = $request->get('time');
            $journeyStatus = null;
            if ($status == TaskStatus::STARTED) $journeyStatus = TaskJourney::START;
            elseif ($status == TaskStatus::COMPLETED) $journeyStatus = TaskJourney::END;
            $taskWorkerId = DB::table('task_workers')->where('task_id', $id)->first();
            if ($time && $journeyStatus && $taskWorkerId) {
                $journey = [
                    'task_worker_id' => $taskWorkerId->id,
                    'status' => $journeyStatus,
                    'time' => $time
                ];
                (new TaskJourneyRepository(new TaskJourney()))->storeJourney($journey);
            }
            return new SuccessResponse();
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }


    public function storeImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
            'status' => 'required|in:START,END,MIDDLE'
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 401);
        $file_data = $request->input('file');
        //generating unique file name;
        $file_name = 'images/' . Str::uuid() . time() . '.png';
        @list($type, $file_data) = explode(';', $file_data);
        @list(, $file_data) = explode(',', $file_data);
        if ($file_data != "") {
            Storage::disk('public')
                ->put($file_name, base64_decode($file_data));
            TaskFile::create([
                'url' => Storage::url($file_name),
                'task_id' => $id,
                'type' => $request->get('status'),
            ]);
        }
        return new SuccessResponse();
    }

    public function show($id)
    {
        try {
            $latestStatus = DB::table('task_status')
                ->select('task_id', 'status', 'id')
                ->where('task_id', '=', $id)
                ->orderByDesc('created_at')
                ->limit(1);
            $task = DB::table('tasks as t')
                ->select(['t.title', 't.code', 'ts.status', 'ts.id as taskId',
                    'b.name', 'email', 'phone', 'moving_date', 'tw.id as taskWorkerId',
                    'moving_from_suburb', 'moving_to_suburb',
                    'pickup_address', 'comments', 'b.description',
                    'quotes', 'size_of_moving', 'additional_service',
                    'access_parking', 'dropoff_address', 'pickup_address',
                    'pickup_latitude', 'pickup_longitude', 'dropoff_latitude', 'dropoff_longitude',
                    'inventory', 'b.id as bookingId', 't.created_at as taskTime'])
                ->join('bookings as  b', 'b.id', '=', 't.booking_id')
                ->join('task_workers as tw', 'tw.task_id', '=', 't.id')
                ->joinSub($latestStatus, 'ts', 'ts.task_id', '=', 't.id')
                ->where('b.is_verified', true)
                ->where('tw.worker_id', auth()->id())
                ->first();
            $images = DB::table('task_files')
                ->select('url', 'type')
                ->where('task_id', '=', $id)
                ->get()
                ->map(function ($image) {
                    return [
                        'url' => asset($image->url),
                        'type' => $image->type
                    ];
                });
            if ($task)
                $task->images = $images;
            return new SuccessResponse($task);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

}
