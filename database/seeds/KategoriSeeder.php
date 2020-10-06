<?php

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$kategori = [
				[
					'FNO_KATEGORI' => 'B01',
					'FK_GROUP' => 'B',
					'FN_KATEGORI' => 'Expresso Based',
				],
				[
					'FNO_KATEGORI' => 'B02',
					'FK_GROUP' => 'B',
					'FN_KATEGORI' => 'Juice',
				],
				[
					'FNO_KATEGORI' => 'F01',
					'FK_GROUP' => 'F',
					'FN_KATEGORI' => 'Nasi',
				],
				[
					'FNO_KATEGORI' => 'F02',
					'FK_GROUP' => 'F',
					'FN_KATEGORI' => 'Pasta',
				],
			];

			
			foreach ($kategori as $key => $value) {
				try {
					$insert = Kategori::firstOrCreate($value);
				} catch (\Exception $e) {
					//
				}
			}
    }
}
