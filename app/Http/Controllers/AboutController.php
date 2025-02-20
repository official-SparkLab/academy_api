<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\About;
class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $about=About::get();
            return response()->json([
                'message'=>'About Data Fetched',
                'status'=>'Success',
                'data'=>$about
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
            $about=About::create($request->all());
            return response()->json([
                'message'=>'About Data Added Successfully',
                'status'=>'Success',
                'data'=>About::get()
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
