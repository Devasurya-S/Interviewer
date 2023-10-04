<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interviews;
use App\Models\InterviewStatus;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{

    // Create Interview
    public function doCreateInterview(Request $request)
    {
        $interview_names = $request->input('interviewName');
        $questions = $request->input('question');
        $employeeId = session('employee_id');

        // Loop through the questions array and create separate interviews for each question
        foreach ($questions as $key => $question) {
            $interview_name = $interview_names[$key];
            Interviews::create([
                'employee_id' => $employeeId,
                'interview_name' => $interview_name,
                'question' => $question,
            ]);
        }

        return redirect()->route('interview.view')->with('success', 'Interviews created successfully');
    }

    //View All Interview
    public function viewInterview(Request $request)
    {
        // $interviews = Interviews::find($this->id);
        $employeeId = session('employee_id');
        $interviews = Interviews::where('employee_id', $employeeId)->get();
        $interviewStatus = InterviewStatus::all();
    
        return view('Employees/interview', ['interviews' => $interviews, 'interviewStatus' => $interviewStatus]);
    }

    //Update Page data loading
    public function updateInterviewPage(Request $request)
    {
        $interview_id = $request->input('interviewId');
        $interview = Interviews::find($interview_id);

        if (!$interview) {
            return redirect()->back()->with('error', 'Interview not found');
        } else {
            return view('Employees/interviewUpdate', ['interview' => $interview]);
        }
    }

    //Update interview details
    public function doUpdateInterview(Request $request)
    {
        $interview_id = $request->input('interviewId');
        $interview = Interviews::find($interview_id);

        if (!$interview) {
            return redirect()->back()->with('error', 'Interview not found');
        }

        $employee_id = session('employee_id');
        $quesiton = $request->input('question');
        $interview_name = $request->input('interviewName');

        $interview->employee_id = $employee_id;
        $interview->interview_name = $interview_name;
        $interview->question = $quesiton;   
        $interview->save(); // Save the updated record

        return redirect()->route('interview.view');
    }

    //Delete Interview
    public function deleteInterview(Request $request)
    {
        $interview_id = $request->input('interviewId');
        $interview = Interviews::find($interview_id);

        if (!$interview) {
            return redirect()->back()->with('error', 'Interview not found');
        }

        // Can add additional checks here, such as ensuring the currently authenticated user has permission to delete this employee.

        $interview->delete();

        return redirect()->route('interview.view')->with('success', 'Interivew deleted successfully');
    }

    //Add group to active for interview
    public function makeActive(Request $request)
    {
        $interview_id = $request->input('interviewId');
        $group = $request->input('group');

        InterviewStatus::create([
            'interview_id' => $interview_id,
            'group' => $group,
        ]);

        return redirect()->route('interview.view')->with('success', 'Interivew is active for group');        
    }

    //Delete group from active for interview
    public function makeDeactive(Request $request)
    {
        $interview_id = $request->input('interviewId');
        $group = $request->input('group');
        
        // Find the InterviewStatus record to delete based on interview_id and group
        $interviewStatus = InterviewStatus::where('interview_id', $interview_id)
        ->where('group', $group)
        ->first();

        if ($interviewStatus) {
            $interviewStatus->delete(); // Delete the InterviewStatus record
            return redirect()->route('interview.view')->with('success', 'Interview is deleted for group');
        } else {
            // Handle the case where the InterviewStatus record was not found
            return redirect()->route('interview.view')->with('error', 'Interview status not found for deletion');
        }
    } 

}
