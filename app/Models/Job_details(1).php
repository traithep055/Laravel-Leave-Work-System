<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_details extends Model
{
    use HasFactory;

    protected $primaryKey = 'job_id';
    protected $table = 'job_details';


    protected $fillable = ['emp_id', 'department', 'joining_date', 'salary'];


    /**
     * Get the employee associated with the job detail.
     */
    public function employee()
    {
        return $this->belongsTo(Employees::class, 'emp_id', 'emp_id');
    }
}
