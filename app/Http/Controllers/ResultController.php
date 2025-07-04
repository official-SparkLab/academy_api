<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Cache;
class ResultController extends Controller
{
    private $uploadPath = 'uploads/result/';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $results = Cache::rememberForever('result_data', function () {
                return Result::all();
            });

            return response()->json([
                'message' => 'Results fetched successfully',
                'status' => 'Success',
                'data' => $results
            ]);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch data',
                'status' => 'Error',
                'error' => $e->getMessage()
            ], 500);
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
            // Handle file upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $uniqueImageName = time() . '_img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path($this->uploadPath), $uniqueImageName);
                $imagePath = $this->uploadPath . $uniqueImageName;
            }

            // Save data in the database
            $result = Result::create([
                'section' => $request->input('section'),
                'result_year' => $request->input('result_year'),
                'sub_section' => $request->input('sub_section'),
                'image' => $imagePath,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'added_by' => $request->input('added_by'),
                'reg_id' => $request->input('reg_id'),
            ]);

            Cache::forget('result_data');
            return response()->json([
                'message' => 'Result added successfully',
                'status' => 'Success',
                'data' => $result
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Result::find($id);

        if (!$result) {
            return response()->json([
                'message' => 'Result not found',
                'status' => 'Failed',
            ]);
        }

        return response()->json([
            'message' => 'Result fetched successfully',
            'status' => 'Success',
            'data' => $result
        ]);
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
            // Find the existing record
            $result = Result::findOrFail($id);

            // Handle image update
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($result->image && file_exists(public_path($this->uploadPath . basename($result->image)))) {
                    unlink(public_path($result->image));
                }

                $imageFile = $request->file('image');
                $uniqueImageName = time() . '_img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path($this->uploadPath), $uniqueImageName);
                $result->image = $this->uploadPath . $uniqueImageName;
            }

            // Update other fields
            $result->section = $request->input('section');
            $result->result_year = $request->input('result_year');
            $result->sub_section = $request->input('sub_section');
            $result->name = $request->input('name');
            $result->description = $request->input('description');
            $result->added_by = $request->input('added_by');
            $result->reg_id = $request->input('reg_id');

            // Save the updated record
            $result->save();
            Cache::forget('result_data');

            return response()->json([
                'message' => 'Result updated successfully',
                'status' => 'Success',
                'data' => $result
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $result = Result::find($id);

            if (!$result) {
                return response()->json([
                    'message' => 'Result not found',
                    'status' => 'Failed',
                ]);
            }

            $result->delete();
            Cache::forget('result_data');

            return response()->json([
                'message' => 'Result deleted successfully',
                'status' => 'Success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed',
            ]);
        }
    }
}
