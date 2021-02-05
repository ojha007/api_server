<?php


namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Spatie\Permission\Models\Role;

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
        $workers = Role::findByName(User::WORKER)->users()->paginate(10);
        $bookings = Booking::select('id', 'name', 'email', 'phone', 'is_verified')
            ->whereDate('created_at', Carbon::today())
            ->orderByDesc('id')
            ->paginate(10);
        $tasks = Task::with('workers')
            ->orderByDesc('id')
            ->paginate(10);
        $enquiries = Enquiry::whereDate('created_at', Carbon::today())
            ->orderByDesc('id')
            ->paginate(10);
        return view($this->viewPath . 'index', compact('workers', 'bookings', 'tasks', 'enquiries'));
    }

    public function inbox(): \Illuminate\Http\JsonResponse
    {
        $mails = [];
//        $messages = LaravelGmail::message()->subject('test')->unread()->preload()->all();
        $messages = LaravelGmail::message()->raw('in:inbox is:unread')->preload()->all();;
        foreach ($messages as $message) {
            $mails['body'] = $message->getHtmlBody();
            $mails['subject'] = $message->getSubject();
        }
        return response()->json([
            'data' => $mails,
            'status' => "SUCCESS",
        ]);
    }
}
