<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegelementBeheer extends Model
{
    use HasFactory;
    
    protected $table = 'regelemten_beheer';
    public $timestamps = false;

    protected $fillable = [
		'regelement',
	];
}