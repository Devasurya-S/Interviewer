<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerFeedback extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'answer_feedbacks';
    protected $fillable = [
        'user_id',
        'employee_id',
        'interview_id',
        'question',
        'video_path',
        'feedback',
        'fb_view_status',
        'fb_status',
        'candidate_name',
    ];

    // Define relationships with other models (e.g., Candidate, Employee, Interview)
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function interview()
    {
        return $this->belongsTo(Interview::class, 'interview_id');
    }
}
