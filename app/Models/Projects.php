<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'account_id',
        'project_name',
        'page_url',
        'response_page',
        'error_page',
        'emails'
    ];
}
