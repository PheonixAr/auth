<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use function Laravel\Prompts\password;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function index()
    // {
    //     $customer = customer::latest()->paginate(5);
    //     return view('customer.index', compact('customer'));
    // }

    // public function ajax_paginate(Request $request)
    // {
    //     $customer = customer::latest()->paginate(5);
    //     return view('customer.index', compact('customer'))->render();
    // }




    public function index()
    {
        // $customer = customer::where(['role' => 'customer'])->get();
        $customer = customer::paginate(3);
        // $customer = customer::orderBy($role, 'desc')->get();

        // $customer = customer::findorFail();

        return view('customer.index', compact('customer'));
    }

    public function vadmin(Request $request)

    {

        if ($request->choose == 'admin') {

            $customer = customer::where(['role' => 'admin'])->get();
            // $customer = customer::orderBy($role, 'desc')->get();

            // $customer = customer::findorFail();

            return view('customer.index', compact('customer'));
            // return redirect()->route('customer.index')->compact('customer');
        } else {
            $customer = customer::where(['role' => 'customer'])->get();
            // $customer = customer::orderBy($role, 'desc')->get();

            // $customer = customer::findorFail();

            return view('customer.index', compact('customer'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        customer::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => $request->roles
            ]
        );

        return redirect()->route('customer.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $customer = customer::findorFail($id);


        // all `User`s that contain tuse Illuminate\Pagination\Paginator; he string "John" in their name

        // $customer = customer::filter($id = 'admin');

        return view('customer.show', compact('customer'));
    }

    /**use Illuminate\Pagination\Paginator;
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = customer::findOrFail($id);


        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = customer::findOrFail($id);

        $customer->update($request->all());

        return redirect()->route('customer.index')->with('success', 'customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = customer::findOrFail($id);

        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'customer deleted successfully');
    }


    public function boot()
    {
        Paginator::useBootstrap();
    }


    public function forgot()
    {
        return view('forgot');
    }




    // public function pagination()
    // {
    //     $customer = customer::paginate(3);
    //     return view('customer', ['customer' => $customer]);;
    // }
}
