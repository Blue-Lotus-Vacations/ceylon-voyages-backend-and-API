<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'deal_name',
        'price',
        'no_of_nights',
        'itinerary_card',
        'description',
        'itinerary_description',
        'cost_includes_description',
        'cost_includes',
        'tour_map_description',
        'tour_map',
        'aditional_information',
        'isFavorite',
        'itineraries'
     ];

     public function assets()
    {
        return $this->hasMany(Asset::class, 'referenceId')->where('attachment_type', 'Holiday Image');
    }

}


