<?php

namespace Database\Seeders;

use App\Models\Basic;
use App\Models\BloodGroup;
use App\Models\ContactInformation;
use App\Models\SocialMedia;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // setup roles
        $roles = ['Super Admin', 'Admin', 'Data Entry'];
        foreach($roles as $role){
             Role::create(['name' => $role]);
        }

        // create Super Admin
        $super_admin = User::create([
            'name' => 'Super Admin Account',
            'email' => 'superadmin@example.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'slug' => 'U'.uniqid(),
        ]);

        $super_admin->assignRole('Super Admin');

        // Setup Basic Info, Social Media Info & Contact Info Fields
        Basic::create();
        SocialMedia::create();
        ContactInformation::create();

        // Add Blood Groups Info
        $blood_groups = [
            'A+' => 'a_possitive',
            'A-' => 'a_negative',
            'B+' => 'b_possitive',
            'B-' => 'b_negative',
            'O+' => 'o_possitive',
            'O-' => 'o_negative',
            'AB+' => 'ab_possitive',
            'AB-' => 'ab_negative',
            'No Blood Record' => 'no_blood_record'
        ];
        foreach($blood_groups as $group => $g_slug){
            \App\Models\BloodGroup::create([
                'blood_name' => $group,
                'blood_slug' => $g_slug,
                'blood_status' => 1,
            ]);
        }
    }
}
