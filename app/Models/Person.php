<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    /**
     * @var string table
     */
    protected $table = 'person';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get all of the contacts for the user.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'id_person');
    }
}
