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
        try {
           
    
            // Define upload directory
            $uploadPath = 'uploads/Home/';
    
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
            $home = Home::create([
                'image_url'      => $imageUrlPath, // Store image URL
                'photo'          => $photoPath, // Store photo path
                'heading_small'  => $request->input('heading_small'),
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
            $home = Home::findOrFail($id);
    
           
    
            // Define upload directory
            $uploadPath = 'uploads/Home/';
    
            // Handle image_url update
            if ($request->hasFile('image_url')) {
                // Delete old image if exists
                if ($home->image_url && file_exists(public_path($home->image_url))) {
                    unlink(public_path($home->image_url));
                }
    
                $imageFile = $request->file('image_url');
                $uniqueImageName = time() . '_img_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path($uploadPath), $uniqueImageName);
                $home->image_url = $uploadPath . $uniqueImageName;
            }
    
            // Handle photo update
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($home->photo && file_exists(public_path($home->photo))) {
                    unlink(public_path($home->photo));
                }
    
                $photoFile = $request->file('photo');
                $uniquePhotoName = time() . '_photo_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
                $photoFile->move(public_path($uploadPath), $uniquePhotoName);
                $home->photo = $uploadPath . $uniquePhotoName;
            }
    
            // Update other fields
            $home->heading_small   = $request->input('heading_small');
            $home->heading_medium  = $request->input('heading_medium');
            $home->heading_large   = $request->input('heading_large');
            $home->button_label    = $request->input('button_label');
            $home->destination_url = $request->input('destination_url');
            $home->description     = $request->input('description');
            $home->icon            = $request->input('icon');
            $home->section         = $request->input('section');
            $home->added_by        = $request->input('added_by');
            $home->reg_id          = $request->input('reg_id');
    
            // Save the updated data
            $home->save();
    
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
    public function destroy($id)
{
    try {
        // Find the existing record
        $home = Home::findOrFail($id);

        // Delete image_url if exists
        if ($home->image_url && file_exists(public_path($home->image_url))) {
            unlink(public_path($home->image_url));
        }

        // Delete photo if exists
        if ($home->photo && file_exists(public_path($home->photo))) {
            unlink(public_path($home->photo));
        }

        // Delete the record from the database
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
