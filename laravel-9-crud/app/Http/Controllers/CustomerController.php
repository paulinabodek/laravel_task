<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $customers = Customer::orderBy('id','desc')->paginate(5);
        return view('customers.index', compact('customers'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('customers.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        
        Company::create($request->post());

        return redirect()->route('customers.index')->with('success','Customer has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\customer  $customer
    * @return \Illuminate\Http\Response
    */
    public function show(Customer $customer)
    {
        return view('customers.show',compact('customer'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Customer  $customer
    * @return \Illuminate\Http\Response
    */
    public function edit(Customer $customer)
    {
        return view('customers.edit',compact('customer'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\customer  $customer
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Customer $ccustomer)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        
        $customer->fill($request->post())->save();

        return redirect()->route('customers.index')->with('success','Customer Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Customer  $customer
    * @return \Illuminate\Http\Response
    */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success','Customer has been deleted successfully');
    }
}
