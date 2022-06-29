<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjectAtendacnes extends Model
{
    protected $table ="subject_attendances";
    protected $primaryKey = 'id';
    protected $fillable = ['section','idNumber','lastName','firstName','startSchool','teacher','subject','semester'];

    use HasFactory;
}
