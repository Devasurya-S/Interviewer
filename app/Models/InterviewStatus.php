<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interviews;
use App\Models\AnswerFeedback;
use App\Models\Candidates;

class InterviewStatus extends Model
{
    use HasFactory;
    protected $table = 'interview_statuses'; // Specify the table name if it's different from the default naming convention
    protected $primaryKey = 'status_id'; // Specify the primary key field if it's different from 'id'
    protected $fillable = ['interview_id', 'group'];

    public function interview()
    {
        return $this->belongsTo(Interviews::class, 'interview_id');
    }

    protected static function booted()
    {
        // Handle the "created" event for InterviewStatus
        static::created(function ($interviewStatus) {
            // Fetch the interview details from the related interview
            $interview = Interviews::find($interviewStatus->interview_id);
            $employeeId = session('employee_id');
    
            // Get all the candidates in the specified group
            $candidates = Candidates::where('group', $interviewStatus->group)->get();
    
            // Iterate through candidates and create AnswerFeedback records if they don't exist
            foreach ($candidates as $candidate) {
                // Check if an AnswerFeedback record already exists for this candidate and interview
                $existingFeedback = AnswerFeedback::where([
                    'interview_id' => $interviewStatus->interview_id,
                    'user_id' => $candidate->user_id,
                ])->first();
    
                // Create a new AnswerFeedback record if it doesn't exist
                if (!$existingFeedback) {
                    AnswerFeedback::create([
                        'interview_id' => $interviewStatus->interview_id,
                        'interview_name' => $interview->interview_name,
                        'question' => $interview->question,
                        'user_id' => $candidate->user_id,
                        'employee_id' => $employeeId,
                        'candidate_name' => $candidate->name,
                    ]);
                }
            }
        });
    }    
    
}
