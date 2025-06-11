<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Cache;
class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Cache::rememberForever('recruitment_data', function () {
                return Recruitment::all();
            });

            return response()->json([
                'message' => 'Data fetched successfully',
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
            $recruitment = Recruitment::create([
                'job_title' => $request->job_title,
                'about_job' => $request->about_job,
                'qualification' => $request->qualification,
                'total_vacancies' => $request->total_vacancies,
                'total_experience' => $request->total_experience,
                'department' => $request->department,
                'age_limit' => $request->age_limit,
                'work_place' => $request->work_place,
                'apply_start_date' => $request->apply_start_date,
                'apply_last_date' => $request->apply_last_date,
                'mobile_no' => $request->mobile_no,
                'apply_link' => $request->apply_link,
                'added_by' => $request->added_by,
                'reg_id' => $request->reg_id,
            ]);

            Cache::forget('recruitment_data');
            return response()->json([
                'message' => 'Recruitment entry created successfully',
                'status' => 'Success',
                'data' => $recruitment
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create entry',
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
            $data = Recruitment::findOrFail($id);

            return response()->json([
                'message' => 'Entry fetched successfully',
                'status' => 'Success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Entry not found',
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
            $recruitment = Recruitment::findOrFail($id);

            $recruitment->update([
                'job_title' => $request->job_title,
                'about_job' => $request->about_job,
                'qualification' => $request->qualification,
                'total_vacancies' => $request->total_vacancies,
                'total_experience' => $request->total_experience,
                'department' => $request->department,
                'age_limit' => $request->age_limit,
                'work_place' => $request->work_place,
                'apply_start_date' => $request->apply_start_date,
                'apply_last_date' => $request->apply_last_date,
                'mobile_no' => $request->mobile_no,
                'apply_link' => $request->apply_link,
                'added_by' => $request->added_by,
                'reg_id' => $request->reg_id,
            ]);

            Cache::forget('recruitment_data');

            return response()->json([
                'message' => 'Recruitment entry updated successfully',
                'status' => 'Success',
                'data' => $recruitment
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update entry',
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
            $recruitment = Recruitment::findOrFail($id);
            $recruitment->delete();
            Cache::forget('recruitment_data');

            return response()->json([
                'message' => 'Recruitment entry deleted successfully',
                'status' => 'Success',
                'data' => null
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete entry',
                'status' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
