<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * @var string table
     */
    protected $table = 'contact';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_person',
        'id_contact_type',
        'content',
    ];

    /**
     * Get the person that owns the contact.
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'id_person');
    }

    /**
     * Get the contact type.
     */
    public function contact_type()
    {
        return $this->belongsTo(ContactType::class, 'id_contact_type');
    }
}
