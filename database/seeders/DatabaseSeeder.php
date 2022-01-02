<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ContactType::insert([
            ['name' => 'Phone', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Email', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Whatsapp', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ]);

        \App\Models\Person::factory(5)->create();
        
        $faker = app(\Faker\Generator::class);

        foreach(\App\Models\Person::all() as $person) {
            \App\Models\Contact::create([
                'id_person' => $person->id,
                'id_contact_type' => 1,
                'content' => $faker->phoneNumber(),
            ]);

            \App\Models\Contact::create([
                'id_person' => $person->id,
                'id_contact_type' => 2,
                'content' => $faker->email(),
            ]);

            \App\Models\Contact::create([
                'id_person' => $person->id,
                'id_contact_type' => 3,
                'content' => $faker->phoneNumber(),
            ]);
        }
    }
}
