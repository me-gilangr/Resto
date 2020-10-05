<?php

use App\Models\Meja;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$data = [
				[
					'FNO_MEJA' => 'P00',
					'FJENIS' => 'Meja Bar',
					'STATUS' => 1,
				],
				[
					'FNO_MEJA' => 'P01',
					'FJENIS' => 'Kursi Panjang',
					'STATUS' => 1,
				],
				[
					'FNO_MEJA' => 'P02',
					'FJENIS' => 'Meja 2 Kursi',
					'STATUS' => 1,
				],
				[
					'FNO_MEJA' => '003',
					'FJENIS' => 'Meja 2 Kursi Panjang',
					'STATUS' => 1,
				],
			];

			foreach ($data as $key => $value) {
				try {
					$insert = Meja::firstOrCreate($value);
				} catch (\Exception $e) {
					//
				}
			}
		}
}
