<?php


namespace App\Http\Responses\Worker;


use App\Jobs\SendUserInvitedEmail;
use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable
{


    /**
     * @var
     */
    private $routePath;
    private $user;
    private $password_generated;

    /**
     * StoreResponse constructor.
     * @param $user
     * @param $password_generated
     * @param $routePath
     */
    public function __construct($user, $password_generated, $routePath)
    {
        $this->routePath = $routePath;
        $this->user = $user;
        $this->password_generated = $password_generated;
    }

    public function toResponse($request)
    {

        dispatch(new SendUserInvitedEmail($this->user, $this->password_generated));
        if ($request->wantsJson()) {
            return response()->json(['message' => 'SUCCESS', 'code' => 201]);
        }
        return redirect()
            ->route($this->routePath . 'index')
            ->with('success', 'Worker Created successfully');
    }
}
