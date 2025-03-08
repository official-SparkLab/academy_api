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
        try {
            
    
            // Define upload directory
            $uploadPath = 'uploads/About/';
    
            // Handle image_url upload
            $imageUrlPath = null;
            if ($request->hasFile('image_url')) {
                $imageFile = $request->file('image_url');
                $uniqueImageName = time() . '_img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path($uploadPath), $uniqueImageName);
                $imageUrlPath = $uploadPath . $uniqueImageName;
            }
    
            // Handle photo upload
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoFile = $request->file('photo');
                $uniquePhotoName = time() . '_photo_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
                $photoFile->move(public_path($uploadPath), $uniquePhotoName);
                $photoPath = $uploadPath . $uniquePhotoName;
            }
    
            // Save data in the database
            $home = About::create([
                'image_url'      => $imageUrlPath, // Store image URL
                'photo'          => $photoPath, // Store photo path
                'heading_small'  => $request->input('heading_small'),
                'sub_section'  => $request->input('sub_section'),
                'heading_medium' => $request->input('heading_medium'),
                'heading_large'  => $request->input('heading_large'),
                'button_label'   => $request->input('button_label'),
                'destination_url'=> $request->input('destination_url'),
                'description'    => $request->input('description'),
                'icon'           => $request->input('icon'),
                'section'        => $request->input('section'),
                'added_by'       => $request->input('added_by'),
                'reg_id'         => $request->input('reg_id'),
            ]);
    
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
   public function update(Request $request, $id)
{
    try {
        // Find the existing record
        $about = About::findOrFail($id);

        // Validate the request
       

        // Define upload directory
        $uploadPath = 'uploads/About/';

        // Handle image_url upload
        if ($request->hasFile('image_url')) {
            if ($about->image_url && file_exists(public_path($about->image_url))) {
                unlink(public_path($about->image_url));
            }
            $imageFile = $request->file('image_url');
            $uniqueImageName = time() . '_img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path($uploadPath), $uniqueImageName);
            $about->image_url = $uploadPath . $uniqueImageName;
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($about->photo && file_exists(public_path($about->photo))) {
                unlink(public_path($about->photo));
            }
            $photoFile = $request->file('photo');
            $uniquePhotoName = time() . '_photo_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
            $photoFile->move(public_path($uploadPath), $uniquePhotoName);
            $about->photo = $uploadPath . $uniquePhotoName;
        }

        // Update other fields
        $about->heading_small  = $request->input('heading_small');
        $about->sub_section  = $request->input('sub_section');
        $about->heading_medium = $request->input('heading_medium');
        $about->heading_large  = $request->input('heading_large');
        $about->button_label   = $request->input('button_label');
        $about->destination_url= $request->input('destination_url');
        $about->description    = $request->input('description');
        $about->icon           = $request->input('icon');
        $about->section        = $request->input('section');
        $about->added_by       = $request->input('added_by');
        $about->reg_id         = $request->input('reg_id');

        // Save the changes
        $about->save();

        return response()->json([
            'message' => 'Data Updated Successfully',
            'status'  => 'Success',
            'data'    => $about
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
            // Find the record by ID
            $about = About::findOrFail($id);
    
            // Delete image_url file if exists
            if ($about->image_url && file_exists(public_path($about->image_url))) {
                unlink(public_path($about->image_url));
            }
    
            // Delete photo file if exists
            if ($about->photo && file_exists(public_path($about->photo))) {
                unlink(public_path($about->photo));
            }
    
            // Delete the record from the database
            $about->delete();
    
            return response()->json([
                'message' => 'Record Deleted Successfully',
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
