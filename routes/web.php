<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\EmployeeContoller;
use App\Http\Controllers\EmployeeFunctionController;
use App\Http\Controllers\AnswerFeedbackController;
use App\Http\Controllers\EmployeeLoginController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\VideoController;

// Frontend
// Landing Page should be candidate login page for now homepage of employee
Route::get('/', [FrontendController::class, 'loginPage'])->name('login.page');
// Employee Signup Page
Route::get('/signup', [FrontendController::class, 'signUpPage'])->name('signup');
// Employee Login Page
Route::get('/login', [FrontendController::class, 'employeeLogin'])->name('employee.login');
// Answer (groups) View Page For Employee
Route::get('/groups', [FrontendController::class, 'answerGroups'])->name('employee.answer.group')->middleware('auth:employee');
// Go To Interview Adding Page
Route::get('/add-interview', [FrontendController::class, 'interviewAddPage'])->name('employee.interview.add.page')->middleware('auth:employee');
// Go To Candidata Create Page
Route::get('/add-candidate', [FrontendController::class, 'candidateAddPage'])->name('employee.candidate.add.page')->middleware('auth:employee');
// Go To Candidate Update Page
Route::post('/update-candidate/{id}', [CandidateController::class, 'candidateUpdatePage'])->name('candidate.update.page')->middleware('auth:employee');
// Go To Update Interview Page
Route::post('/update-interview', [InterviewController::class, 'updateInterviewPage'])->name('interview.update.page');
// Handle View Interview for Candidate
Route::post('/interview', [CandidateController::class, 'viewInterview'])->name('candidate.interview.view')->middleware('auth:web');
// Candidate Home Page Data
Route::get('/candidate/home', [CandidateController::class, 'candidateHome'])->name('candidate.home');
// View Feedback Page For Candidate
Route::post('/candidate/view-feedback', [CandidateController::class, 'viewFeedback'])->name('candidate.feedback.view');


// Backend
// Login Process For Employee
Route::post('/dologin/employee', [EmployeeLoginController::class, 'doLoginEmployee'])->name('employee.do.login');
// Logout
Route::post('/dologout/employee', [EmployeeLoginController::class, 'doLogoutEmployee'])->name('employee.do.logout');
// Login Process For Users
Route::post('/dologin/user', [EmployeeLoginController::class, 'doLoginUser'])->name('user.do.login');
// Logout
Route::post('/dologout/user', [EmployeeLoginController::class, 'doLogoutUser'])->name('user.do.logout');

// Candidate SignUp
Route::post('/candidate/sign-up', [CandidateController::class, 'signUp'])->name('candidate.sign-up');
// View All Candidate Groups
Route::get('/candidate/groups', [CandidateController::class, 'candidateGroups'])->name('candidate.groups');
// View All Candidate's Details
Route::match(['get', 'post'], '/candidate/view', [CandidateController::class, 'viewData'])->name('candidate.view');
// Candidate Update Details
Route::post('/candidate/update', [CandidateController::class, 'updateData'])->name('candidate.update');
// Delete Candidate
Route::post('/candidate/delete', [CandidateController::class, 'deleteCandidate'])->name('candidate.delete');
// Delete candidates based on groups
Route::post('/candidate/delete-in-group', [CandidateController::class, 'deleteCandidateInGroup'])->name('candidate.delete.in.group');
// Change Status of all Candidates in a group
Route::post('/candidate/change-status', [CandidateController::class, 'changeStatusInGroup'])->name('candidate.change.status');

// Employee SignUp
// Route::post('/employee/sign-up', 'EmployeeController@signUp')->name('employee.signup');
Route::post('/employee/sign-up', [EmployeeContoller::class, 'signUp'])->name('employee.signup');
// View Employee Details
Route::get('/employee/view', [EmployeeController::class, 'viewData'])->name('employee.details');
// Employee Update Details
Route::post('/employee/update', [EmployeeController::class, 'updateData'])->name('employee.update');
// Delete Employee Account
Route::get('/employee/delete/{id}', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete');

// Create Interview
Route::post('/interview/create', [InterviewController::class, 'doCreateInterview'])->name('interview.create')->middleware('auth:employee');
// View All Interviews
Route::get('/interview/view', [InterviewController::class, 'viewInterview'])->name('interview.view');
// Update Interview Details
Route::post('/interview/update', [InterviewController::class, 'doUpdateInterview'])->name('interview.update');
// Delete Interview
Route::post('/interview/delete', [InterviewController::class, 'deleteInterview'])->name('interview.delete');
// Add Group to Active for Interview
Route::post('/interview/make-active', [InterviewController::class, 'makeActive'])->name('interview.make.active');
// Delete Group from Active for Interview
Route::post('/interview/make-deactive', [InterviewController::class, 'makeDeactive'])->name('interview.make.deactive');

// View all groups to select
Route::get('/answer/groups', [AnswerFeedbackController::class, 'allGroup'])->name('answer.group');
// Group-wise answer filter and view
Route::post('/answer/view', [AnswerFeedbackController::class, 'viewAnswers'])->name('answer.view');
// View selected answer
Route::post('/answer/view-selected', [AnswerFeedbackController::class, 'viewSelectedAnswer'])->name('answer.view.selected');
// Store feedback and set feedbacked status to done
Route::post('/answer/store-feedback', [AnswerFeedbackController::class, 'storeFeedback'])->name('answer.store.feedback');
// Delete selected answer
Route::post('/answer/delete-selected', [AnswerFeedbackController::class, 'deleteSelcetedAnswer'])->name('answer.delete.selected');
// Delete all answers in a group
Route::post('/answer/delete-group', [AnswerFeedbackController::class, 'deleteGroupAnswer'])->name('answer.delete.group');

// Store the video 
Route::post('/answer/record-video', [VideoController::class, 'recordVideo'])->name('record.video');
