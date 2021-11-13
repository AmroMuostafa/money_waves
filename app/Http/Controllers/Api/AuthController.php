<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;
use App\Http\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    use ApiResponser;

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->messages()->all(), Response::HTTP_BAD_REQUEST);
        }

        $customer = Customer::firstOrCreate([
            'phone' => $request->phone
        ]);

        return $this->success((object) array());
    }

    public function verify_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->messages()->all(), Response::HTTP_BAD_REQUEST);
        }

        $customer = Customer::where('phone', $request->phone)->first();

        if ($request->code == '1234')
        {
            return $this->success([
                'token' => explode('|', $customer->createToken('required_token_for_apis')->plainTextToken)[1]
            ]);
        }
        else
        {
            return $this->error("Invalid code", 200);
        }
    }

}
