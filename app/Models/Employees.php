<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Employees extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $primaryKey = 'employee_id';
    protected $table = 'employees';
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile'
    ];

    // Implement the missing methods
    public function getAuthIdentifierName()
    {
        return 'employee_id'; // Change 'employee_id' to the name of the primary key column in your employees table
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    // Add any other methods and properties as needed
}
