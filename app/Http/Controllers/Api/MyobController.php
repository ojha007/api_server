<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Services\MyobServices;
use Illuminate\Http\Request;

class MyobController extends Controller
{


    /**
     * @var string[]
     */
    private $header;

    public function __construct()
    {
        $myob = new MyobServices();
        $accessToken = $myob->getAccessToken();
        $this->header = array(
            'Authorization: Bearer ' . $accessToken,
            'x-myobapi-key: ' . config('myob.api_key'),
            'x-myobapi-version: v0',
            'Accept: application/json',
            'Content-Type: application/json',
        );
    }

    public function storeInvoice(Request $request)
    {
        $addsbInvoiceJsonData = '{
							    "contact" : {
							        "uid" : "{contact_uid}"
							        },
							    "invoiceNumber" : "IV00000229",
							    "issueDate" : "2014-08-19",
							    "dueDate" : "2014-08-26",
							    "gstInclusive" : true,
							    "lines" : [
							        {
							    "account" : {
							        "uid" : "{account_uid}"
							        },
							    "item" : {
							        "uid" : "{item_uid}"
							        },
							    "taxType" : {
							        "uid" : "{account_type_uid}"
							        },
							    "unitOfMeasure" : "Qty",
							    "description" : "Hammers",
							    "quantity" : 2,
							    "unitPrice" : 5.99,
							    "total" : 11.98
							    }
							    ],
							    "notes" : "An invoice note",
							    "purchaseOrderNumber" : "PO0000056",
							    "total" : 11.98,
							    "gst" : 1.09,
							    "amountPaid" : 0,
							    "amountDue" : 11.98,
							    "status" : "Open",
							    "displayStatus" : "Not Paid"
							}';
    }


}

