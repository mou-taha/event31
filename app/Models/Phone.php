<?php

namespace App\Models;

use App\Models\Organism;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'organism_id'];

    public function organism()
    {
        return $this->belongsTo(Organism::class);
    }
}