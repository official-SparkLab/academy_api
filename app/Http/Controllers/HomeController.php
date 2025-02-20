<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $home=Home::get();
            return response()->json([
                'message'=>'Home Data Fethced',
                'status'=>'Success',
                'data'=>$home
            ]);

        }catch(Exception $e)
        {
            return response()->json([
                'message'=>'Exception Occured'.$e.getMessage(),
                'status'=>'Failed'
            ]);

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
        $home=Home::create($request->all());
        return response()->json([
            'message'=>'Data Added Successfully',
            'status'=>'Success',
            'data'=>Home::get()

        ]);
    }catch(Exception $e)
    {
        return response()->json([
            'message'=>"Exception Occured".$e->getMessage(),
            'Status'=>'Failed',
            ''
        ]);

    }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
