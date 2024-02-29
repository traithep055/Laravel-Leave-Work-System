<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave_applications extends Model
{
    use HasFactory;

    protected $primaryKey = 'leave_applications_id';
    protected $table = 'leave_applications';

    protected $fillable = [
        'from_date',
        'to_date',
        'reason',
        'status',
        'emp_id',
        'pdf_path'
    ];

    /**
     * Get the employee that the leave application belongs to.
     */
    public function employee()
    {
        return $this->belongsTo(Employees::class, 'emp_id', 'emp_id');
    }
  

}
