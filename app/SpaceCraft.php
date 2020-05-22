<?php

namespace App;

use App\Armaments;
use App\CraftType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpaceCraft extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'image', 'crew', 'value', 'craft_types_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden   = [
        'craft_types_id', 'pivot', 'created_at', 'updated_at'
    ];

    /**
     * Relationship between spacecraft and many armaments
     * @return Hasmany 
     */
    public function armaments() : BelongsToMany
    {
        return $this->belongsToMany(
            Armaments::class,
            'armament_to_craft_pivot',
            'space_craft_id',
            'armament_id'
        )
        ->withPivot('qty')
        ;
    }

    /**
     * Crafttype relationship for spaceship
     * @return BelongsTo
     */
    public function craftTypes() : BelongsTo
    {
        return $this->belongsTo(CraftTypes::class, 'craft_types_id');
    }
}
