<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$users = [
				[
					'name' => 'Admin',
					'email' => 'admin@mail.com',
					'email_verified_at' => now(),
					'password' => bcrypt('admin'),
					'role' => 'Admin'
				],
				[
					'name' => 'Karyawan',
					'email' => 'karyawan@mail.com',
					'email_verified_at' => now(),
					'password' => bcrypt('karyawan'),
					'role' => 'Karyawan'
				],
				[
					'name' => 'MeGilang R',
					'email' => 'megilangr@mail.com',
					'email_verified_at' => now(),
					'password' => bcrypt('megilangr'),
					'role' => 'Admin'
				],
			];

			foreach ($users as $key => $value) {
				try {
					$user = User::firstOrCreate(Arr::except($value, ['role']));
					$user->assignRole($value['role']);
				} catch (\Exception $e) {
					//throw $th;
				}
			}
		}
}
