<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_name',
        'destination_category',
        'destination_card_summary',
        'isFavorite',
        'highlights',
        'visit_time',
        'worth_a_visit',
        'culture',
        'food'
    ];

    public function destination_categories()
    {
        return $this->belongsTo(DestinationCategory::class, 'destination_category');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'referenceId')
            ->whereIn('attachment_type', ['Destination Image', 'Destination Map Image', 'Destination Culture Image', 'Destination Visit Time Image', 'Destination Highlight Image']);
    }
    
}
