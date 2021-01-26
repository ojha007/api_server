<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{

    public function getAllCountries(): SuccessResponse
    {
        $data = DB::table('countries')
            ->select('id', 'name')
            ->get()->mapWithKeys(function ($country) {
                return [$country->id => $country->name];
            });
        return new SuccessResponse($data);
    }
}
