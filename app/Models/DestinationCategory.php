<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_category_name'
     ];

     public function assets()
    {
        return $this->hasMany(Asset::class, 'referenceId')->where('attachment_type', 'Destination Category Image');
    }

}
