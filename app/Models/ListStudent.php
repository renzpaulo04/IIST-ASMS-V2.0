<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListStudent extends Model
{
    use HasFactory;
    protected $table ="list_students";
    protected $primaryKey = 'id';
    protected $fillable = ['section','idNumber','lastName','firstName','startSchool','teacher','subject','semester'];
    public function getGenerateBadgeAttribute()
    {
        $badges=[
            'BSIS' => 'success',
            'BSIT'=> 'secondary',
        ];
        return $badges[$this->course];
    }
}
