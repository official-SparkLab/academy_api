<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Cache;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Cache::rememberForever('feedback_data', function () {
                return Feedback::all();
            });

            return response()->json([
                'message' => 'Results fetched successfully',
                'status' => 'Success',
                'data' => $data
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
            $feedback = Feedback::create([
                'question' => $request->question,
                'answer' => $request->answer,
                'feedback' => $request->feedback,
                'reason' => $request->reason,
            ]);

            Cache::forget("feedback_data");

            return response()->json([
                'message' => 'Feedback submitted successfully',
                'status' => 'Success',
                'data' => $feedback
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to submit feedback',
                'status' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Feedback::findOrFail($id);

            return response()->json([
                'message' => 'Feedback fetched successfully',
                'status' => 'Success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Feedback not found',
                'status' => 'Error',
                'error' => $e->getMessage()
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
            $feedback = Feedback::findOrFail($id);

            $feedback->update([
                'question' => $request->question,
                'answer' => $request->answer,
                'feedback' => $request->feedback,
                'reason' => $request->reason,
            ]);
            Cache::forget('feedback_data');
            return response()->json([
                'message' => 'Feedback updated successfully',
                'status' => 'Success',
                'data' => $feedback
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update feedback',
                'status' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();
            Cache::forget('feedback_data');

            return response()->json([
                'message' => 'Feedback deleted successfully',
                'status' => 'Success',
                'data' => null
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete feedback',
                'status' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
