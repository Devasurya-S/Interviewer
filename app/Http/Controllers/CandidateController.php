<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Candidates;
use App\Models\Interviews;
use App\Models\InterviewStatus;
use App\Models\AnswerFeedback;
use Illuminate\Support\Facades\Auth;


class CandidateController extends Controller
{
    // Candidate SignUp (Accepts an array of employee data)
    public function signUp(Request $request)
    {
        //Validation not done due to frontend design error
        // Validate the form data using the validateCandidateData function
        // $validator = $this->validateCandidateData($request->all());

        // Check if validation fails
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Loop through the submitted data and create Candidate records
        foreach ($request->input('name') as $key => $name) {
            Candidates::create([
                'name' => $name,
                'email' => $request->input('email')[$key],
                'mobile_number' => $request->input('mobile')[$key],
                'password' => Hash::make($request->input('password')[$key]),
                'status' => $request->input('status')[$key],
                'group' => $request->input('group')
            ]);
        }

        return redirect()->route('candidate.groups')->with('success', 'Candidate data updated successfully');
    }

        
    // View All Groups      
    public function candidateGroups()
    {
        $candidates = Candidates::all();
        $groups = Candidates::pluck('group', 'group')->unique();

        return view('Employees/candidateGroups',['groups' => $groups]);
    }

    // View All Candidate's Details
    public function viewData(Request $request)
    {
        if ($request->isMethod('post')) {
            $group = $request->input('keyData');
            session(['keyData' => $group]);
        } elseif ($request->isMethod('get')) {
            $group = session('keyData');
        }
        $candidates = Candidates::where('group', $group)->get(); // You should use get() to retrieve the results.
    
        if (!$candidates->isEmpty()) {
            return view('Employees/candidates', ['candidates' => $candidates]);
        }
    
        return redirect()->back()->with('error', 'Candidates not found in this group');
    }

    // Show data of selected candidate to update
    public function candidateUpdatePage($id) {
        $candidate = Candidates::find($id);

        if (!$candidate) {
            return redirect()->back()->with('error', 'Candidate not found');
        }

        return view('Employees/candidateUpdate', compact('candidate'));
    }

    

    // Candidate Update Details
    public function updateData(Request $request)
    {
        $validator = $this->validateCandidateData($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $request->input('id'); // Corrected the input field name.
        $candidate = Candidates::find($id);

        if (!$candidate) {
            return redirect()->back()->with('error', 'Candidate not found');
        }

        $candidate->name = $request->input('name');
        $candidate->email = $request->input('email');
        $password = $request->input('password');
        $candidate->password = Hash::make($password);
        $candidate->mobile = $request->input('mobile');
        $candidate->status = $request->input('status');
        $candidate->group = $request->input('group');
        $candidate->save(); // Corrected the variable name to $candidate.

        return redirect()->route('candidate.view')->with('success', 'Candidate data updated successfully');
    }

    //Delete Candidate 
    public function deleteCandidate(Request $request)
    {   
        $id = $request->input('keyData'); // Corrected the input field name.
        $candidate = Candidates::find($id);
        $keyData = $candidate->group;

        if (!$candidate) {
            return redirect()->back()->with('error', 'Candidate not found');
        }

        // You can add additional checks here, such as ensuring the currently authenticated user has permission to delete this candidate.

        $candidate->delete();

        return redirect()->route('candidate.view')->with('success', 'Candidate data updated successfully')->with('keyData', $keyData);
    }

    //Delete candidates based on groups
    public function deleteCandidateInGroup(Request $request)
    {
        $groupToDelete = $request->input('keyData'); 

        // Delete candidates with the specified group.
        Candidates::where('group', $groupToDelete)->delete();

        return redirect()->route('candidate.groups')->with('success', 'Candidates with group ' . $groupToDelete . ' deleted successfully');
    }

    //Change Status of all Candidates in a group
    public function changeStatusInGroup(Request $request)
    {
        $groupToChange = $request->input('group'); 
        $newStatus = $request->input('new_status');

        // Update the 'status' field for all candidates in the specified group to newStatus.
        Candidates::where('group', $groupToChange)->update(['status' => $newStatus]);

        return redirect()->route('candidate.view')->with('success', 'Status of candidates in group ' . $groupToChange . ' changed successfully');
    }

    //Candidate Homepage data loading
    public function candidateHome(){
        $user = Auth::user();
        $datas = AnswerFeedback::where('user_id',$user->user_id)->get();
        return view('Users/home', ['datas' => $datas]);
    }

    //View Selected Interivew for Candidate
    public function viewInterview(Request $request){
        $answerId = $request->input('id');
        $interview = AnswerFeedback::find($answerId);
        return view('Users/interviewPage', ['interview' => $interview]);
    }

    //View Feedback for Candidate
    public function viewFeedback(Request $request){
        $answerId = $request->input('id');
        $data = AnswerFeedback::find($answerId);
        $data->fb_view_status = 1;
        $data->save();
        return view('Users/viewFeedback', ['data' => $data]);
    }

    // Validation function
    // protected function validateCandidateData(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:employees,email,'],
    //         'password' => ['nullable', 'string', 'min:8', 'confirmed'],
    //         'mobile' => ['required', 'string', 'max:20'],
    //     ])->setAttributeNames([
    //         'name' => 'Employee Name',
    //         'email' => 'Email Address',
    //         'password' => 'Password',
    //         'mobile' => 'Mobile Number',
    //     ]);
    // }
    protected function validateCandidateData(array $data)
    {
        return Validator::make($data, [
            'name.*' => ['required', 'string', 'max:255'],
            'email.*' => ['required', 'string', 'email', 'max:255', 'unique:employees,email'],
            'password.*' => ['nullable', 'string', 'min:8', 'confirmed'],
            'mobile.*' => ['required', 'string', 'max:20'],
        ])->setAttributeNames([
            'name.*' => 'Employee Name',
            'email.*' => 'Email Address',
            'password.*' => 'Password',
            'mobile.*' => 'Mobile Number',
        ]);
    }
}
