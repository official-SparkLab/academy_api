<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'Contacts retrieved successfully',
            'status'  => 'Success',
            'data'    => Contact::all()
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
        $contact = Contact::create($request->all());

        return response()->json([
            'message' => 'Data Added Successfully',
            'status'  => 'Success',
            'data'    => $contact
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json([
                'message' => 'Contact not found',
                'status'  => 'Error',
                'data'    => null
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'message' => 'Contact retrieved successfully',
            'status'  => 'Success',
            'data'    => $contact
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
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json([
                'message' => 'Contact not found',
                'status'  => 'Error',
                'data'    => null
            ]);
        }

        $contact->update($request->all());

        return response()->json([
            'message' => 'Data Updated Successfully',
            'status'  => 'Success',
            'data'    => $contact
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json([
                'message' => 'Contact not found',
                'status'  => 'Error',
                'data'    => null
            ]);
        }

        $contact->delete();
        return response()->json([
            'message' => 'Data Deleted Successfully',
            'status'  => 'Success',
            'data'    => null
        ]);
    }

}
