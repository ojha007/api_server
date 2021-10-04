<?php


namespace App\Http\Controllers;


use App\Repositories\MailRepository;
use Carbon\Carbon;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Dacastro4\LaravelGmail\Services\Message\Mail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * @var MailRepository
     */
    protected $repository;

    /**
     * MailController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function compose()
    {
        return view($this->viewPath . 'compose');
    }

    public function sent(Request $request)
    {
        if ($request->ajax()) {
            dd('f');
        }
        if ($request->method() == 'POST') {
            return $this->sentMail($request);
        } else {
            $title = 'Sent Mails';
            $url = route('mails.sent');
            return view($this->viewPath . 'compose', compact('url', 'title'));
        }

    }

    public function sentMail(Request $request): RedirectResponse
    {
        $request->validate([
            'to' => 'required|email',
            'fromEmail' => 'required|email',
            'fromName' => 'required',
            'subject' => 'required',
        ]);
        try {
            $id = $request->get('replyId');
            if ($id) {
                $mail = LaravelGmail::message()->get($id);
                $mail->setReplyThread($id);
            } else {
                $mail = new Mail();
            }
            $mail->to($request->get('to'));
            $fromEmail = $request->get('fromEmail');
            $fromName = $request->get('fromName');
            $mail->subject($request->get('subject'));
            $mail->from($fromEmail, $fromName);
            if ($request->get('ccMail')) {
                $mail->cc($request->get('ccMail'), $request->get('ccName'));
            }
            if ($request->get('bccMail')) {
                $mail->cc($request->get('bccMail'), $request->get('bccName'));
            }
            if ($request->hasFile('attachments')) {
                $files = [];
                foreach ($request->file('attachments') as $file) {
                    $path = Storage::disk('public')->put('mail', $file);
                    $files[] = 'storage/' . $path;

                }
                $mail->attach(implode(',', $files));
            }
            $mail->message($request->get('message'));
            if ($id) $mail->reply();
            else  $mail->send();
            $message = 'Mail sent to ' . $request->get('to') . ' successfully';
            return redirect()
                ->route($this->routePath . 'index')
                ->with('success', $message);
        } catch (\Exception $exception) {
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Failed to sent mails');
        }
    }

    public function trash()
    {
        $mails = [];
        $title = 'Trash';
        return view($this->viewPath . 'mailbox', compact('mails', 'title'));
    }

    public function draft(Request $request)
    {
        if ($request->ajax()) {

        }
        $title = 'Draft';
        $url = route('mails.draft');
        return view($this->viewPath . 'mailbox', compact('url', 'title'));
    }

    public function inbox(): JsonResponse
    {
        $limit = 10;
        $mails = $this->getAllInbox($limit);
        return response()->json([
            'data' => $mails,
            'status' => "SUCCESS",
        ]);
    }

    public function getAllInbox($limit): array
    {
        $mails = [];
        $messages = LaravelGmail::message()
            ->take($limit)
            ->preload()
            ->all($pageToken = null);
        foreach ($messages as $key => $message) {
            $mails[$key]['date'] = Carbon::parse($message->getDate())->longRelativeToNowDiffForHumans();
            $mails[$key]['subject'] = $message->getSubject();
            $mails[$key]['from'] = $message->getFromName() . '-' . $message->getFromEmail();
            $mails[$key]['message'] = Str::limit($message->getPlainTextBody(),500);
            $mails[$key]['id'] = $message->getId();

        }
        return $mails;
    }

    public function index()
    {
        $title = 'Inbox';
        $url = route('mails.inbox');
        return view($this->viewPath . 'mailbox', compact('url', 'title'));
    }

    /**
     * @param $id
     * @return array
     */
    public function view($id): array
    {
        $message = LaravelGmail::message()->get($id);
        return [
            'date' => Carbon::parse($message->getDate())->longRelativeToNowDiffForHumans(),
            'subject' => $message->getSubject(),
            'fromName' => $message->getFromName(),
            'fromEmail' => $message->getFromEmail(),
            'message' => $message->getPlainTextBody(),
            'id' => $message->getId(),
            'attachment' => $message->getAttachments()
        ];
    }

}
