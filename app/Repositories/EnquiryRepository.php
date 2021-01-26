<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Employee;
use App\Models\Enquiry;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class EnquiryRepository extends Repository
{

    /**
     * @var Employee
     */
    protected $model;

    /**
     * EmployeeRepository constructor.
     * @param Enquiry $model
     */
    public function __construct(Enquiry $model)
    {
        $this->model = $model;
    }

    public function setOrUpdateAddress(array $array, $type): bool
    {
        unset($array['country_id']);
        $attributes = array_merge($array, [
            'type' => $type
        ]);
        DB::table('enquiry_address')
            ->updateOrInsert([
                'enquiry_id' => $array['enquiry_id'],
                'type' => $type
            ], $attributes);
        return true;
    }

    public function findById($id): array
    {
        $a = $this->query()
            ->where('e.id', '=', $id)
            ->get();
        return $this->transform($a);
    }

    public function transform($enquiry): array
    {
        $pickUp = $enquiry->where('type', '=', Enquiry::PICKUP)->first();
        $delivery = $enquiry->where('type', '=', Enquiry::DELIVERY)->first();
        return [
            'id' => $enquiry->first()->id,
            'title' => $enquiry->first()->title,
            'description' => $enquiry->first()->description,
            'email' => $enquiry->first()->email,
            'name' => $enquiry->first()->user_name,
            'pickup_address' => [
                'country' => $pickUp->country ?? '',
                'state' => $pickUp->state ?? '',
                'city' => $pickUp->city ?? '',
                'postal_code' => $pickUp->postal_code ?? '',
            ],
            'delivery_address' => [
                'country' => $delivery->country ?? '',
                'state' => $delivery->state ?? '',
                'city' => $delivery->city ?? '',
                'postal_code' => $delivery->postal_code ?? '',
            ]
        ];
    }

    public function query(): \Illuminate\Database\Query\Builder
    {
        return DB::table('enquiries as e')
            ->select('title', 'e.id', 'description',
                'email', 'u.name as user_name', 'postal_code',
                'date', 'c.name as country', 'ea.type',
                's.name as state', 'street_one', 'street_two', 'city')
            ->join('enquiry_address as ea', 'ea.enquiry_id', '=', 'e.id')
            ->join('states as s', 'ea.state_id', '=', 's.id')
            ->join('users as u', 'e.user_id', '=', 'u.id')
            ->join('countries as c', 'c.id', '=', 's.country_id');
    }

    public function getAll(): \Illuminate\Support\Collection
    {
        return $this->query()
            ->get()
            ->groupBy('id')
            ->map(function ($enquiry) {
                return $this->transform($enquiry);
            });
    }
}
