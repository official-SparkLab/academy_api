<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use Exception;
use Illuminate\Support\Facades\Cache;
class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $faculties = Cache::rememberForever('faculty_data', function () {
                return Faculty::all();
            });

            return response()->json([
                'message' => 'Data Retrieved Successfully',
                'status' => 'Success',
                'data' => $faculties
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
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
            $uploadPath = 'uploads/Faculty/';
            $photoPath = null;

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photoFile = $request->file('photo');
                $uniquePhotoName = time() . '_faculty_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
                $photoFile->move(public_path($uploadPath), $uniquePhotoName);
                $photoPath = asset($uploadPath . $uniquePhotoName);
            }

            $faculty = Faculty::create([
                'department' => $request->input('department'),
                'photo' => $photoPath,
                'title' => $request->input('title'),
                'name' => $request->input('name'),
                'designation' => $request->input('designation'),
                'experience' => $request->input('experience'),
                'added_by' => $request->input('added_by'),
                'reg_id' => $request->input('reg_id'),
            ]);

            Cache::forget(key: 'faculty_data'); // Cache instantly cleared

            return response()->json([
                'message' => 'Faculty Added Successfully',
                'status' => 'Success',
                'data' => $faculty
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $faculty = Faculty::findOrFail($id);
            return response()->json([
                'message' => 'Faculty Retrieved Successfully',
                'status' => 'Success',
                'data' => $faculty
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
            ], 500);
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
            $faculty = Faculty::findOrFail($id);
            $uploadPath = 'uploads/Faculty/';
            $photoPath = $faculty->photo;

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photoFile = $request->file('photo');
                $uniquePhotoName = time() . '_faculty_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
                $photoFile->move(public_path($uploadPath), $uniquePhotoName);
                $photoPath = asset($uploadPath . $uniquePhotoName);
            }

            $faculty->update([
                'department' => $request->input('department'),
                'photo' => $photoPath,
                'title' => $request->input('title'),
                'name' => $request->input('name'),
                'designation' => $request->input('designation'),
                'experience' => $request->input('experience'),
                'added_by' => $request->input('added_by'),
                'reg_id' => $request->input('reg_id'),
            ]);

            Cache::forget(key: 'faculty_data'); // Cache instantly cleared
            return response()->json([
                'message' => 'Faculty Updated Successfully',
                'status' => 'Success',
                'data' => $faculty
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $faculty = Faculty::findOrFail($id);
            $faculty->delete();
            Cache::forget(key: 'faculty_data'); // Cache instantly cleared
            return response()->json([
                'message' => 'Faculty Deleted Successfully',
                'status' => 'Success'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception Occurred: ' . $e->getMessage(),
                'status' => 'Failed'
            ], 500);
        }
    }
}
