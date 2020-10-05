<?php

use App\Models\KodeGroup;
use Illuminate\Database\Seeder;

class KodeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$kode = [
				[
					'FK_GROUP' => 'F',
					'FN_GROUP' => 'Makanan'
				],
				[
					'FK_GROUP' => 'B',
					'FN_GROUP' => 'Minuman'
				],
				[
					'FK_GROUP' => 'D',
					'FN_GROUP' => 'Desert'
				],
			];

			
			foreach ($kode as $key => $value) {
				try {
					$insert = KodeGroup::firstOrCreate($value);
				} catch (\Exception $e) {
					//throw $th;
				}
			}
    }
}
