<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers=Customer::all();
        return response()->json([
            'status'=>true,
            'message'=>'Customers retrieved successfully',
             'data'=>$customers
        ],200);
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Customer found successfully',
            'data' => $customer
        ], 200);

    }

    public function store(CreateCustomerRequest $request)
    {

        $customer = Customer::create(
            [
                'name'=>$request->name,
                'email'=>$request->email
            ]);
        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);

    }

    public function update(CreateCustomerRequest $request,$id)
    {
        if ($request->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $request->errors()
            ], 422);
        }

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Customer updated successfully',
            'data' => $customer
        ], 200);

    }

    public function destroy($id)
    {

        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json([
            'status' => true,
            'message' => 'Customer deleted successfully'
        ], 200);
    }
}
