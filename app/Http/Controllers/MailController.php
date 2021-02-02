<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class MailController extends Controller
{

    /**
     * @var string
     */
    protected $viewPath = 'mails.';
    /**
     * @var string
     */
    protected $routePath = 'mails.';

    /**
     * MailController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $unreadMails = DB::table('notifications')
            ->whereNull('read_at')
            ->get();
        return view($this->viewPath . 'index', compact('unreadMails'));
    }
}
