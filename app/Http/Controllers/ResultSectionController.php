<?php

namespace App\Http\Controllers;

use App\Models\ResultSection;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Cache;
class ResultSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $home = Cache::rememberForever('result_section_data', function () {
                return ResultSection::all();
            });

            return response()->json([
                'message' => 'Data Fetched',
                'status' => 'Success',
                'data' => $home
            ]);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
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
            $home = ResultSection::create($request->all());
            Cache::forget('result_section_data');

            return response()->json([
                'message' => 'Data Stored Successfully',
                'status' => 'Success',
                'data' => $home
            ]);

           
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $home = ResultSection::findOrFail($id);
            
            return response()->json([
                'message' => 'Data Retrieved Successfully',
                'status' => 'Success',
                'data' => $home
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
            ]);
        }
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
            $home = ResultSection::findOrFail($id);
            $home->update($request->all());
            Cache::forget('result_section_data');

            return response()->json([
                'message' => 'Data Updated Successfully',
                'status' => 'Success',
                'data' => $home
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $home = ResultSection::findOrFail($id);
            $home->delete();
            Cache::forget('result_section_data');

            return response()->json([
                'message' => 'Data Deleted Successfully',
                'status' => 'Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
            ]);
        }
    }
}
