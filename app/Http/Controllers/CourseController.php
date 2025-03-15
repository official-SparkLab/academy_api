<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Exception;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $courses = Course::all();
            return response()->json($courses, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
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
            // Define upload directory
            $uploadPath = 'uploads/Course/';

            // Initialize file paths
            $imageUrlPath = null;
            $photoPath = null;

            // Handle image_url upload
            if ($request->hasFile('image_url')) {
                $imageFile = $request->file('image_url');
                $uniqueImageName = time() . '_img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path($uploadPath), $uniqueImageName);
                $imageUrlPath = $uploadPath . $uniqueImageName;
            }

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photoFile = $request->file('photo');
                $uniquePhotoName = time() . '_photo_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
                $photoFile->move(public_path($uploadPath), $uniquePhotoName);
                $photoPath = $uploadPath . $uniquePhotoName;
            }

            // Save data in the database
            $course = Course::create([
                'image_url'      => $imageUrlPath,
                'photo'          => $photoPath,
                'heading_small'  => $request->input('heading_small'),
                'heading_medium' => $request->input('heading_medium'),
                'heading_large'  => $request->input('heading_large'),
                'button_label'   => $request->input('button_label'),
                'destination_url'=> $request->input('destination_url'),
                'description'    => $request->input('description'),
                'icon'           => $request->input('icon'),
                'section'        => $request->input('section'),
                'sub_section'    => $request->input('sub_section'),
                'added_by'       => $request->input('added_by'),
                'reg_id'         => $request->input('reg_id'),
            ]);

            return response()->json(['message' => 'Data Added Successfully', 'status' => 'Success', 'data' => $course], 201);
        } catch (Exception $e) {
            return response()->json(['message' => "Exception Occurred: " . $e->getMessage(), 'status' => 'Failed'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json($course, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
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
            $course = Course::findOrFail($id);
            $uploadPath = 'uploads/Course/';

            // Handle image_url update
            if ($request->hasFile('image_url')) {
                $imageFile = $request->file('image_url');
                $uniqueImageName = time() . '_img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path($uploadPath), $uniqueImageName);
                $course->image_url = $uploadPath . $uniqueImageName;
            }

            // Handle photo update
            if ($request->hasFile('photo')) {
                $photoFile = $request->file('photo');
                $uniquePhotoName = time() . '_photo_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
                $photoFile->move(public_path($uploadPath), $uniquePhotoName);
                $course->photo = $uploadPath . $uniquePhotoName;
            }

            // Update other fields
            $course->update($request->except(['image_url', 'photo']));

            return response()->json(['message' => 'Data Updated Successfully', 'status' => 'Success', 'data' => $course], 200);
        } catch (Exception $e) {
            return response()->json(['message' => "Exception Occurred: " . $e->getMessage(), 'status' => 'Failed'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();
            return response()->json(['message' => 'Data Deleted Successfully', 'status' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
