<?php

namespace App;

use App\Armaments;
use App\CraftType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpaceCraft extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'image', 'crew', 'value', 'crafttypes_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden   = [
        'crafttypes_id',
    ];

    /**
     * Relationship between spacecraft and many armaments
     * TODO: needs changing to MANY TO MANY
     * @return Hasmany 
     */
    public function armaments() : HasMany
    {
        return $this->hasMany(Armaments::class);
    }

    /**
     * Crafttype relationship for spaceship
     * @return BelongsTo
     */
    public function craftTypes() : BelongsTo
    {
        return $this->belongsTo(CraftTypes::class, 'crafttypes_id');
    }
}
