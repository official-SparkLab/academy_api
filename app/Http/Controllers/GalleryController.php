<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Exception;
use Illuminate\Support\Facades\Cache;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $galleries = Cache::rememberForever('gallery_data', function () {
                return Gallery::all();
            });

            return response()->json([
                'message' => 'Gallery List Retrieved Successfully',
                'status' => 'Success',
                'data' => $galleries
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => "Exception Occurred: " . $e->getMessage(),
                'status' => 'Failed',
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
            $uploadPath = 'uploads/gallery/';
            $imagePath = null;

            // Handle image upload if sub_section is 'Images'
            if ($request->sub_section === 'Images' && $request->hasFile('image')) {
                $image = $request->file('image');
                $uniqueName = time() . '_img_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($uploadPath), $uniqueName);
                $imagePath = $uploadPath . $uniqueName;
            }

            // Save data in the database
            $gallery = Gallery::create([
                'section' => $request->input('section'),
                'sub_section' => $request->input('sub_section'),
                'title' => $request->input('title'),
                'heading' => $request->input('heading'),
                'image' => $imagePath, // Store image path if uploaded
                'video_link' => $request->input('video_link'),
                'added_by' => $request->input('added_by'),
                'reg_id' => $request->input('reg_id'),
            ]);

            Cache::forget("gallery_data");

            return response()->json([
                'message' => 'Data Added Successfully',
                'status' => 'Success',
                'data' => $gallery
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Exception Occurred: " . $e->getMessage(),
                'status' => 'Failed',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $gallery = Gallery::find($id);

            if (!$gallery) {
                return response()->json([
                    'message' => 'Gallery Not Found',
                    'status' => 'Error',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'message' => 'Gallery Retrieved Successfully',
                'status' => 'Success',
                'data' => $gallery
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Exception Occurred: " . $e->getMessage(),
                'status' => 'Failed',
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
            $gallery = Gallery::find($id);

            if (!$gallery) {
                return response()->json([
                    'message' => 'Gallery Not Found',
                    'status' => 'Error',
                    'data' => null
                ], 404);
            }

            $uploadPath = 'uploads/gallery/';
            $imagePath = $gallery->image; // Keep old image if not replaced

            // Handle image upload if sub_section is 'Images'
            if ($request->sub_section === 'Images' && $request->hasFile('image')) {
                $image = $request->file('image');
                $uniqueName = time() . '_img_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($uploadPath), $uniqueName);
                $imagePath = $uploadPath . $uniqueName;
            }

            // Update data in the database
            $gallery->update([
                'section' => $request->input('section'),
                'sub_section' => $request->input('sub_section'),
                'title' => $request->input('title'),
                'heading' => $request->input('heading'),
                'image' => $imagePath, // Store updated image path if uploaded
                'video_link' => $request->input('video_link'),
                'added_by' => $request->input('added_by'),
                'reg_id' => $request->input('reg_id'),
            ]);

            Cache::forget("gallery_data");

            return response()->json([
                'message' => 'Data Updated Successfully',
                'status' => 'Success',
                'data' => $gallery
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Exception Occurred: " . $e->getMessage(),
                'status' => 'Failed',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $gallery = Gallery::find($id);

            if (!$gallery) {
                return response()->json([
                    'message' => 'Gallery Not Found',
                    'status' => 'Error',
                    'data' => null
                ], 404);
            }

            $gallery->delete();
            Cache::forget("gallery_data");

            return response()->json([
                'message' => 'Gallery Deleted Successfully',
                'status' => 'Success'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Exception Occurred: " . $e->getMessage(),
                'status' => 'Failed',
            ], 500);
        }
    }
}
