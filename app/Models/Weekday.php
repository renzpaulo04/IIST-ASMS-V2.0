<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekday extends Model
{
    use HasFactory;
    protected $table ="weeks";
    protected $primaryKey = 'id';
    protected $fillable = 'day';

    const WEEK_DAYS = [
        '1' => 'MONDAY',
        '2' => 'TUESDAY',
        '3' => 'WEDNESDAY',
        '4' => 'THURSDAY',
        '5' => 'FRIDAY',
        '6' => 'SATURDAY',

    ];

}
