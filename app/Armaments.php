<?php

namespace App;

use App\SpaceCraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Armaments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'qty', 'spacecraft_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden   = [
        'created_at', 'updated_at', 'id', 'space_craft_id'
    ];

    /**
     * Relationship between Armaments and spacecrafts 
     * @return BelongsTo 
     */
    public function spacecraft() : BelongsTo
    {
        return $this->belongsTo(SpaceCraft::class);
    }
}
