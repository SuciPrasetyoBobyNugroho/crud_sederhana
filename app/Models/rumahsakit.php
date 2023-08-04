<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rumahsakit extends Model
{
    use HasFactory;
    protected $fillable = ['mother_name', 'mother_age', 'infant_gender', 'infant_birth_datetime', 'gestational_age_weeks', 'height_cm', 'weight_kg'];
    protected $table = 'rumahsakit';
}
