<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interviews extends Model
{
    use HasFactory;
    protected $table = 'interviews'; // Specify the table name if it's different from the default naming convention
    protected $primaryKey = 'interview_id'; // Specify the primary key field if it's different from 'id'
    
    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'employee_id',
        'interview_name',
        'question',
    ];
}
