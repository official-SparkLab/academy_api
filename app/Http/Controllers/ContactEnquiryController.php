<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\ContactEnquiry;
class ContactEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = ContactEnquiry::all();
            return response()->json([
                'message' => 'Data Retrieved Successfully',
                'status'  => 'Success',
                'data'    => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Exception Occurred: " . $e->getMessage(),
                'status'  => 'Failed',
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
        try {
            $home = ContactEnquiry::create($request->all());
            return response()->json([
                'message' => 'Data Added Successfully',
                'status'  => 'Success',
                'data'    => $home
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Exception Occurred: " . $e->getMessage(),
                'status'  => 'Failed',
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
        try {
            $home = ContactEnquiry::findOrFail($id);
            $home->update($request->all());
            return response()->json([
                'message' => 'Data Updated Successfully',
                'status'  => 'Success',
                'data'    => $home
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Exception Occurred: " . $e->getMessage(),
                'status'  => 'Failed',
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $home = ContactEnquiry::findOrFail($id);
            $home->delete();
            return response()->json([
                'message' => 'Data Deleted Successfully',
                'status'  => 'Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Exception Occurred: " . $e->getMessage(),
                'status'  => 'Failed',
            ]);
        }
    }
}
