<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = bcrypt('Rgop082$');

        DB::table('users')->insertOrIgnore([
            [
                'id' => 1,
                'name' => 'Usuário Master',
                'email' => 'master@gmail.com',
                'password' => $password,
                'document' => '43397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => 'Usuário Master2',
                'email' => 'master2@gmail.com',
                'password' => $password,
                'document' => '23397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'name' => 'Usuário Master3',
                'email' => 'master3@gmail.com',
                'password' => $password,
                'document' => '33397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'name' => 'Usuário Master4',
                'email' => 'master4@gmail.com',
                'password' => $password,
                'document' => '44397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'name' => 'Usuário Master5',
                'email' => 'master5@gmail.com',
                'password' => $password,
                'document' => '53397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'name' => 'Usuário Master6',
                'email' => 'master6@gmail.com',
                'password' => $password,
                'document' => '63397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'name' => 'Usuário Master7',
                'email' => 'master7@gmail.com',
                'password' => $password,
                'document' => '73397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'name' => 'Usuário Master8',
                'email' => 'master8@gmail.com',
                'password' => $password,
                'document' => '83397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'name' => 'Usuário Master9',
                'email' => 'master@gmail.com',
                'password' => $password,
                'document' => '93397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'name' => 'Usuário Master10',
                'email' => 'master@gmail.com',
                'password' => $password,
                'document' => '10397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'name' => 'Usuário Master11',
                'email' => 'master11@gmail.com',
                'password' => $password,
                'document' => '11397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'name' => 'Usuário Master12',
                'email' => 'master12@gmail.com',
                'password' => $password,
                'document' => '12397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'name' => 'Usuário Master13',
                'email' => 'master@gmail.com',
                'password' => $password,
                'document' => '13337614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'name' => 'Usuário Master14',
                'email' => 'master14@gmail.com',
                'password' => $password,
                'document' => '14397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'name' => 'Usuário Master15',
                'email' => 'master15@gmail.com',
                'password' => $password,
                'document' => '15397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 16,
                'name' => 'Usuário Master16',
                'email' => 'master16@gmail.com',
                'password' => $password,
                'document' => '16397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 17,
                'name' => 'Usuário Master17',
                'email' => 'master17@gmail.com',
                'password' => $password,
                'document' => '17397614007',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
