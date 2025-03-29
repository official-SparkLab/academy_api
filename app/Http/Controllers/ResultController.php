<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Exception;

class ResultController extends Controller
{
    private $uploadPath = 'uploads/result/';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Result::all();
        return response()->json([
            'message' => 'Results fetched successfully',
            'status'  => 'Success',
            'data'    => $results
        ]);
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
                'section'      => $request->input('section'),
                'sub_section'  => $request->input('sub_section'),
                'image'        => $imagePath,
                'name'         => $request->input('name'),
                'description'  => $request->input('description'),
                'added_by'     => $request->input('added_by'),
                'reg_id'       => $request->input('reg_id'),
            ]);

            return response()->json([
                'message' => 'Result added successfully',
                'status'  => 'Success',
                'data'    => $result
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status'  => 'Failed',
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
                'status'  => 'Failed',
            ]);
        }

        return response()->json([
            'message' => 'Result fetched successfully',
            'status'  => 'Success',
            'data'    => $result
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
            $result = Result::find($id);

            if (!$result) {
                return response()->json([
                    'message' => 'Result not found',
                    'status'  => 'Failed',
                ]);
            }

            // Handle file upload (if new image is provided)
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $uniqueImageName = time() . '_img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path($this->uploadPath), $uniqueImageName);
                $result->image = $this->uploadPath . $uniqueImageName;
            }

            // Update data
            $result->update([
                'section'      => $request->input('section', $result->section),
                'sub_section'  => $request->input('sub_section', $result->sub_section),
                'name'         => $request->input('name', $result->name),
                'description'  => $request->input('description', $result->description),
                'added_by'     => $request->input('added_by', $result->added_by),
                'reg_id'       => $request->input('reg_id', $result->reg_id),
            ]);

            return response()->json([
                'message' => 'Result updated successfully',
                'status'  => 'Success',
                'data'    => $result
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
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
            $result = Result::find($id);

            if (!$result) {
                return response()->json([
                    'message' => 'Result not found',
                    'status'  => 'Failed',
                ]);
            }

            $result->delete();

            return response()->json([
                'message' => 'Result deleted successfully',
                'status'  => 'Success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status'  => 'Failed',
            ]);
        }
    }
}
