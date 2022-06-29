<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;
    protected $table ="programs";
    protected $primaryKey = 'id';
    protected $fillable = ['course_code','course_title','coriculum_year','role','created_by','changed_by'];

    public function getProgramsBadgeAttribute()
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
                  ->orwhere('course_title','like',$term)
                  ->orwhere('coriculum_year','like',$term);
        });
    }
}
