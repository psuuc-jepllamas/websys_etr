<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UndergraduateController extends Controller
{
    public function show()
    {
        return view('user.undergraduate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'yearlevel' => 'required|in:1ST Year,2ND Year,3RD Year,4TH Year',
            'course' => 'required|in:BSCE,BSME,BSEE,BSCOE,BSMath,BSArch,BSIT,ABEL,BSSE-FIL,BSSE-SCI,BECED',
            'entrance' => 'required|string|max:255',
            'orno' => 'required|string|max:50',
            'ordate' => 'required|date',
            'type' => 'required|in:undergraduate',
        ]);

        try {
            // Check for duplicate OR No. in both tables
            $existingUndergraduate = DB::table('undergraduates')->where('orno', $validated['orno'])->first();
            $existingGraduate = DB::table('graduates')->where('orno', $validated['orno'])->first();

            if ($existingUndergraduate || $existingGraduate) {
                // Log duplicate attempt
                DB::table('duplicate_attempts')->insert([
                    'student_name' => $validated['fullname'],
                    'or_no' => $validated['orno'],
                    'type' => 'Undergraduate',
                    'attempted_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect()->route('user.undergraduate')->with('error', 'This OR No. has already been used. Please use a unique OR No.');
            }

            // Insert new record
            DB::table('undergraduates')->insert([
                'fullname' => $validated['fullname'],
                'address' => $validated['address'],
                'yearlevel' => $validated['yearlevel'],
                'course' => $validated['course'],
                'entrance' => $validated['entrance'],
                'orno' => $validated['orno'],
                'ordate' => $validated['ordate'],
                'type' => $validated['type'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('user.undergraduate')->with('success', 'Form filled! Claim your printed copy at the Registrars Office');
        } catch (\Exception $e) {
            Log::error('Error saving undergraduate data: ' . $e->getMessage());
            return redirect()->route('user.undergraduate')->with('error', 'Failed to submit data. Please try again.');
        }
    }
}