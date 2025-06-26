<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'referenceId' ,
        'file_path' ,
        'attachment_type' ,
        'IsFeatured_image' 
    ];

     public function holiday()
    {
        return $this->belongsTo(Holiday::class);
    }

}
