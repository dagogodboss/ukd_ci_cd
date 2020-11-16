<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use App\User\Verification\CustomerVerification;
use App\Http\Requests\Api\Customer\FileManagerRequest;
use App\Models\Customer\CustomerEmployment;
use Exception;
use Illuminate\Http\JsonResponse;

class FileManager extends Controller
{
    public function addFile(FileManagerRequest $request, CustomerVerification $customer)
    {
        $customer->create(array_merge(
            $this->appendData($request), $request->all()
        ));
        return jsonResponse(['data' => user()]);
    }

    public function appendData($request)
    {
        return [
            'given_id_card' => true,
            'given_utility_bill' => true,
            'given_bank_statement' => true,
            'customer_id' => $request->user()->id,
            'documents' => $this->uploadFiles($request),
        ];
    }

    private function uploadFiles($request){
        $documents = [
            'id_cards' => ($request->file('id_cards')) ? $request->file('id_cards'): null,
            'utility' => ($request->file('utility')) ? $request->file('utility'): null,
            'bankStatement' => ($request->file('bankStatement')) ? $request->file('bankStatement'): null,
        ];
        $uploaded =[];
        foreach ($documents as $key => $document) {
            if (!empty($document)) {
                try{
                    $fileName = uniqid().time().'.'.$document->getClientOriginalExtension();
                    array_push($uploaded, [
                        $key => [
                            'name' => $fileName,
                            'file' =>  $document,
                        ]
                    ]);
                    try {
                        $document->move(public_path('customer/verification/documents'), $fileName);
                    } catch (\Throwable $th) {
                        return $th->getMessage();
                    }
                }catch(Exception $e){
                    return invalidRequest($e->getMessage());
                }
            }
        }
        return (empty($uploaded)) ?  ['no_file' => 'File Not Uploaded'] : $uploaded;
    }

    public function uploadSignature(Request $request):JsonResponse{
        try {
            user()->employment()->update([
                'other_files' => $request->signature
            ]);
            return jsonResponse(['data' => user()->name]);
        } catch (\Throwable $th) {
            return  invalidRequest($th->getMessage());
        }
    }
}
