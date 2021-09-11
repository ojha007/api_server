<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class EnquiryResource extends JsonResource
{

    public function toArray($request): array
    {

        $enquiry = [
            'id' => $this->id ?? '',
            'email' => $this->email ?? '',
            'firstName' => $this->first_name ?? '',
            'lastName' => $this->last_name ?? '',
            'mobileNumber' => $this->mobile_number ?? '',
            'address1' => $this->address1 ?? '',
            'address2' => $this->address2 ?? '',
            'city' => $this->city ?? '',
            'postalCode' => $this->postal_code ?? '',
            'pickupDate' => $this->pickup_date ?? '',
            'deliveryDate' => $this->delivery_date ?? '',
            'optionalNumber' => $this->optional_number ?? '',
            'age' => $this->age ?? '',
            'comment' => $this->comment ?? '',
            'userId' => $this->user_id ?? '',
        ];
        if (!empty($this->quotation)) {
            $enquiry += [
                'quotationId' => $this->quotation->id,
                'quotationTitle' =>$this->quotation->title,
            ];
        }
        return $enquiry;
    }

}
