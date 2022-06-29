<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockAttendance extends Model
{
    protected $table ="stock_attendances";
    protected $primaryKey = 'id';
    protected $fillable = ['section','idNumber','lastName','firstName','startSchool','teacher','subject','semester','attendance'];
    public function getStockAttendanceBadgeAttribute()
    {
        $badges=[
            'PRESENT' => 'success',
            'LATE'=> 'warning',
            'ABSENT'=> 'danger',
        ];
        return $badges[$this->attendance];
    }

   
    use HasFactory;
}
