<?php


namespace App\Http\Controllers;


use App\Models\Mail;
use App\Repositories\MailRepository;
use Illuminate\Http\Request;
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
     * @var MailRepository
     */
    protected $repository;

    /**
     * MailController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->repository = new MailRepository(new Mail());
    }

    public function compose()
    {

        return view($this->viewPath . 'compose');
    }

    public function sent(Request $request)
    {
        if ($request->method() == 'POST') {
            return $this->sentMail($request);
        } else {
            $mails = DB::table('mails')
                ->whereNull('deleted_at')
                ->where('draft', '=', false)
                ->orderByDesc('created_at')
                ->get();
            $title = 'Sent Mails';
            return view($this->viewPath . 'mailbox', compact('mails', 'title'));
        }

    }

    public function sentMail(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate($this->mailValidation());
        try {
            DB::beginTransaction();
            $attributes = $request->except('_token');
            $this->repository->create($attributes);
            $is_draft = $request->get('draft') == 1;
            $route = $this->routePath . ($is_draft ? 'draft' : 'sent');
            $message = $is_draft ? 'Message saved at draft' : 'Mail sent to ' . $request->get('to') . ' successfully';
            DB::commit();
            return redirect()
                ->route($route)
                ->with('success', $message);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Failed to sent mails');
        }
    }

    public function trash()
    {
        $mails = DB::table('mails')
            ->whereNotNull('deleted_at')
            ->get();
        $title = 'Trash';
        return view($this->viewPath . 'mailbox', compact('mails', 'title'));
    }

    public function draft()
    {
        $title = 'Draft';
        $mails = DB::table('mails')
            ->whereNull('deleted_at')
            ->where('draft', '=', true)
            ->get();
        return view($this->viewPath . 'mailbox', compact('mails', 'title'));
    }

    public function edit($id)
    {
        try {
            $route = route('mails.update', $id);
            $edit = true;
            $mail = DB::table('mails')->where('id', '=', $id)->first();
            return view($this->viewPath . 'compose', compact('mail', 'route', 'edit'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('failed', 'Failed to Update the mail');
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate($this->mailValidation());
        try {
            DB::beginTransaction();
            $attributes = $request->except('_token');
            $this->repository->update($id, $attributes);
            $is_draft = $request->get('draft') == 1;
            $message = $is_draft ? 'Message saved at draft' : 'Mail sent to ' . $request->get('to') . ' successfully';
            $route = $this->routePath . ($is_draft ? 'draft' : 'sent');
            DB::commit();
            return redirect()
                ->route($route)
                ->with('success', $message);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Failed to sent mails');
        }
    }

    public function mailValidation(): array
    {
        return [
            'to' => 'required|email',
            'subject' => 'required|string|min:5|max:255',
            'message' => 'required|string|min:5',
            'draft' => 'required|boolean'
        ];
    }

    public function copy($id)
    {
        $mail = $this->repository->getById($id);
        return view($this->viewPath . 'compose', compact('mail'));
    }

}
