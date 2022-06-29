<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generate extends Model
{
    use HasFactory;
    protected $table ="generates";
    protected $primaryKey = 'id';
    public $fillable = ['course','year','section','semester','subject','teacher','room','weekday','startTime','endTime','startSchool','endSchool','difference','created_by','changed_by'];
   
    public function getGenerateBadgeAttribute()
    {
        $badges=[
            'BSIS' => 'success',
            'BSIT'=> 'secondary',
        ];
        return $badges[$this->course];
    }
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('course','like', $term)
                  ->orwhere('year','like',$term)
                  ->orwhere('section','like',$term)
                  ->orwhere('semester','like',$term)
                  ->orwhere('subject','like',$term)
                  ->orwhere('teacher','like',$term)
                  ->orwhere('room','like',$term)
                  ->orwhere('weekday','like',$term)
                  ->orwhere('startSchool','like',$term);
        });
    }
}
