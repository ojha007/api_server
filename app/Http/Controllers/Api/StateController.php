<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{

    /**
     * @param $country_id
     * @return SuccessResponse
     */
    public function getAllStatesByCountry($country_id): SuccessResponse
    {
        $data = DB::table('states')
            ->select('id', 'name')
            ->where('country_id', '=', $country_id)
            ->get()->mapWithKeys(function ($country) {
                return [$country->id => $country->name];
            });
        return new SuccessResponse($data);
    }
}
