<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table ="subjects";
    protected $primaryKey = 'id';
    protected $fillable = ['course_code','coriculum_year','subject_code','subject_title','year','units','semester','role','lecHours','labHours','created_by','changed_by'];

    public function getSubjectsBadgeAttribute()
    {
        $badges=[
            'ACTIVE' => 'success',
            'INACTIVE'=> 'secondary',
        ];
        return $badges[$this->role];
    }
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('course_code','like', $term)
                  ->orwhere('subject_code','like',$term)
                  ->orwhere('year','like',$term)
                  ->orwhere('semester','like',$term);
        });
    }
}
