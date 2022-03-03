<?php


namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Support\Str;
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
        $workers = Role::findByName(User::WORKER)
            ->users()
            ->orderByDesc('created_at')
            ->paginate(5);
        $bookings = Booking::select('id', 'name', 'email', 'phone', 'is_verified')
            ->whereDate('created_at', Carbon::today())
            ->orderByDesc('id')
            ->paginate(5);
        $tasks = Task::with('workers')
            ->orderByDesc('id')
            ->paginate(5);
        $enquiries = Enquiry::orderByDesc('id')
            ->paginate(5);
        return view($this->viewPath . 'index', compact('workers', 'bookings', 'tasks', 'enquiries'));
    }


}
