<?php

namespace App\Http\Controllers;

use App\Models\Signup;
use Illuminate\Http\Request;
use Exception;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $results = Signup::all();

            return response()->json([
                'message' => 'Results fetched successfully',
                'status'  => 'Success',
                'data'    => $results
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong while fetching data',
                'status'  => 'Error',
                'error'   => $e->getMessage()
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
            $signup = new Signup();
            $signup->full_name = $request->full_name;
            $signup->department = $request->department;
            $signup->designation = $request->designation;
            $signup->contact = $request->contact;
            $signup->email = $request->email;
            $signup->username = $request->username;
            $signup->password = $request->password;
            $signup->save();

            return response()->json([
                'message' => 'Signup created successfully',
                'status'  => 'Success',
                'data'    => $signup
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create signup',
                'status'  => 'Error',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $result = Signup::findOrFail($id);

            return response()->json([
                'message' => 'Result fetched successfully',
                'status'  => 'Success',
                'data'    => $result
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Signup not found',
                'status'  => 'Error',
                'error'   => $e->getMessage()
            ], 404);
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
            $signup = Signup::findOrFail($id);
            $signup->full_name = $request->full_name;
            $signup->department = $request->department;
            $signup->designation = $request->designation;
            $signup->contact = $request->contact;
            $signup->email = $request->email;
            $signup->username = $request->username;
            $signup->password = $request->password;
            $signup->save();

            return response()->json([
                'message' => 'Signup updated successfully',
                'status'  => 'Success',
                'data'    => $signup
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update signup',
                'status'  => 'Error',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $signup = Signup::findOrFail($id);
            $signup->delete();

            return response()->json([
                'message' => 'Signup deleted successfully',
                'status'  => 'Success',
                'data'    => null
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete signup',
                'status'  => 'Error',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
{
    try {
        $username = $request->username;
        $password = $request->password;

        // Static admin login
        if ($username === 'Admin' && $password === 'admin@gmail.com') {
            return response()->json([
                'message' => 'Login successful',
                'status'  => 'Success',
                'data'    => [
                   'reg_id' => '0',
                    'added_by' => 'Admin'
                ]
            ]);
        }

        // DB check for other users
        $user = Signup::where('username', $username)
                      ->where('password', $password)
                      ->first();

        if ($user) {
            return response()->json([
                'message' => 'Login successful',
                'status'  => 'Success',
                'data'    => [
                    'reg_id' => $user->id,
                    'added_by' => $user->full_name
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
                'status'  => 'Error',
                'data'    => null
            ]);
        }
    } catch (Exception $e) {
        return response()->json([
            'message' => 'Login failed',
            'status'  => 'Error',
            'error'   => $e->getMessage()
        ], 500);
    }
}
}
