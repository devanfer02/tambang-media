<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Mine;
use App\Models\User;
use App\Models\Role;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRoleId = Uuid::uuid7();
        $approverRoleId = Uuid::uuid7();

        Role::insert([
            [
                'role_id' => $adminRoleId,
                'role_name' => 'Admin'
            ],
            [
                'role_id' => $approverRoleId,
                'role_name' => 'Approver'
            ]
        ]
        );

        User::insert([
            [
                'user_id' => Uuid::uuid7(),
                'role_id' => $adminRoleId,
                'fullname' => 'Evan Lingga',
                'email' => 'evanlingga@gmail.com',
                'position' => 'Admin Sistem',
                'password' => Hash::make('password')
            ],
            [
                'user_id' => Uuid::uuid7(),
                'role_id' => $approverRoleId,
                'fullname' => 'Tade Gina',
                'email' => 'tadegina@gmail.com',
                'position' => 'Manager',
                'password' => Hash::make('password')
            ],
            [
                'user_id' => Uuid::uuid7(),
                'role_id' => $approverRoleId,
                'fullname' => 'Farrel Deva',
                'email' => 'farreldeva@gmail.com',
                'position' => 'Manager',
                'password' => Hash::make('password')
            ],
            [
                'user_id' => Uuid::uuid7(),
                'role_id' => $approverRoleId,
                'fullname' => 'Hikmam Ali',
                'email' => 'hikmamali@gmail.com',
                'position' => 'Manager',
                'password' => Hash::make('password')
            ]

        ]);

        Mine::insert([
            [
                'mine_name' => 'Batu Bara Jaya',
                'mine_location' => 'Kalimantan Selatan',
            ],
            [
                'mine_name' => 'Tambang Nikel Sejahtera',
                'mine_location' => 'Sulawesi Tenggara',
            ],
            [
                'mine_name' => 'Emas Makmur Sentosa',
                'mine_location' => 'Papua Barat',
            ],
            [
                'mine_name' => 'Granite Abadi',
                'mine_location' => 'Riau',
            ],
            [
                'mine_name' => 'Zinc Mineral Nusantara',
                'mine_location' => 'Jawa Timur',
            ],
            [
                'mine_name' => 'Kapur Lestari',
                'mine_location' => 'Sumatera Barat',
            ],
        ]);

        Driver::factory(30)->create();

        User::factory(25)->role('Approver')->create();

        Vehicle::factory(50)->create();
    }
}
