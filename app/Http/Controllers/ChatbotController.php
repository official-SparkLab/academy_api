<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Chatbot;
use Exception;
class ChatbotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Chatbot::all();

            return response()->json([
                'message' => 'Chat fetched successfully',
                'status'  => 'Success',
                'data'    => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch data',
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
            $chatbot = new Chatbot();
            $chatbot->question = $request->question;
            $chatbot->answer = $request->answer;
            $chatbot->question_type = $request->question_type;
            $chatbot->save();

            return response()->json([
                'message' => 'Chatbot entry created successfully',
                'status'  => 'Success',
                'data'    => $chatbot
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create entry',
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
            $data = Chatbot::findOrFail($id);

            return response()->json([
                'message' => 'Chat fetched successfully',
                'status'  => 'Success',
                'data'    => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Entry not found',
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
            $chatbot = Chatbot::findOrFail($id);
            $chatbot->question = $request->question;
            $chatbot->answer = $request->answer;
            $chatbot->question_type = $request->question_type;
            $chatbot->save();

            return response()->json([
                'message' => 'Chatbot entry updated successfully',
                'status'  => 'Success',
                'data'    => $chatbot
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update entry',
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
            $chatbot = Chatbot::findOrFail($id);
            $chatbot->delete();

            return response()->json([
                'message' => 'Chatbot entry deleted successfully',
                'status'  => 'Success',
                'data'    => null
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete entry',
                'status'  => 'Error',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
