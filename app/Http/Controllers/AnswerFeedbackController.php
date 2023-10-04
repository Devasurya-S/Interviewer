<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Candidates;
use App\Models\InterviewStatus;
use App\Models\AnswerFeedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnswerFeedbackController extends Controller
{

    private $id;

    // View all groups to select
    public function allGroup()
    {
        $id = session('employee_id');
        $interviewIds = AnswerFeedback::where('employee_id', $id)->pluck('interview_id')->toArray(); // Get interview IDs where the employee is the same as logged in
        $groups = InterviewStatus::whereIn('interview_id', $interviewIds)->pluck('group')->unique(); // Get unique groups associated with those interview IDs
        return view('Employees/answerGroups', ['groups' => $groups]);
    }


    //Group wise answer filter and view them
    public function viewAnswers(Request $request){
        $group = $request->input('group');
        $userIds = Candidates::where('group', $group)->pluck('user_id')->toArray();
        $answers = AnswerFeedback::whereIn('user_id', $userIds)->get();
        
        return view('Employees/candidateAnswers', ['answers' => $answers]);
    }

    //Selected answer view
    public function viewSelectedAnswer(Request $request){
        $answerId = $request->input('answerId');
        $answer = AnswerFeedback::find($answerId);

        return view('Employees/answerView',['answer' => $answer]);
    }

    //Store feedback and set feedbacked status to done
    public function storeFeedback(Request $request) {
        $answerId = $request->input('answerId');
        $feedback = $request->input('feedback');
        $feedbackStatus = 1;
        // Find the AnswerFeedback record by answer_id
        $answerFeedback = AnswerFeedback::where('id', $answerId)->first();

        if ($answerFeedback) {
            // Update the feedback and feedbackStatus columns
            $answerFeedback->update([
                'feedback' => $feedback,
                'fb_status' => $feedbackStatus,
            ]);

            // Optionally, you can return a response or perform additional actions
            return redirect()->route('answer.group')->with('success', 'Feedback updated successfully');
        } else {
            // Handle the case where no matching record is found
            return redirect()->back()->with('error','AnswerFeedback record not found');
        }
    }

    //Delete selected answer
    public function deleteSelcetedAnswer(Request $request){
        $answerId = $request->input('answerId');
        // Find the AnswerFeedback record by id
        $answerFeedback = AnswerFeedback::find($answerId);

        if ($answerFeedback) {
            // Delete the video file from storage if it exists
            if (!empty($answerFeedback->video_path)) {
                Storage::delete('public/' . $answerFeedback->video_path);
            }

            // Update the values
            $answerFeedback->update([
                'feedback' => null,
                'fb_status' => 0,
                'video_path' => null,
            ]);
            // Redirect back with a success message
            return redirect()->route('answer.group')->with('success', 'Answer deleted successfully');
        }

        // If no matching record is found, redirect back with an error message
        return redirect()->back()->with('error', 'Answer not found');
    }

    //Delete all answers in a gorup
    public function deleteGroupAnswer(Request $request)
    {
        $group = $request->input('group');
        $userIds = Candidates::where('group', $group)->pluck('user_id');

        foreach ($userIds as $userId) {
            // Get all answer feedback records for this user
            $answerFeedbackRecords = AnswerFeedback::where('user_id', $userId)->get();

            foreach ($answerFeedbackRecords as $answerFeedback) {
                // Delete the video file from storage if it exists
                if (!empty($answerFeedback->video_path)) {
                    Storage::delete('public/' . $answerFeedback->video_path);
                }

                // Find the InterviewStatus record to delete based on interview_id and group then remove it from interview status
                $interviewStatus = InterviewStatus::where('interview_id', $answerFeedback->interview_id)
                ->where('group', $group)
                ->first();
                if(!$interviewStatus){
                    $interviewStatus->delete();
                }
                
                // Delete the answer feedback record
                $answerFeedback->delete();
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Group answers deleted successfully');
    }
}
