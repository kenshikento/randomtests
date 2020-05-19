<?php

namespace App;

use App\SpaceCraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CraftTypes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */    
    protected $table = 'crafttypes';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden   = [
        'created_at', 'updated_at', 'id'
    ];

    /**
     * Relationship between Armaments and spacecrafts 
     * @return BelongsTo 
     */
    public function spacecrafts() : HasMany
    {
        return $this->hasMany(SpaceCraft::class);
    }
}
