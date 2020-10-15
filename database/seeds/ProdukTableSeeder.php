<?php

use App\Models\GroupPembuatan;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$produk = [
				[
					'FNO_PRODUK' => 'B01001',
					'FNO_KATEGORI' => 'B01',
					'FN_NAMA' => 'Kopi Cappucino',
					'deleted_at' => null,
					'created_at' => now(),
					'updated_at' => now(),
					'group' => [
						[
							'FNO_PRODUK' => 'B01001',
							'FTEMPAT' => 'B',
						]
					],
				],
				[
					'FNO_PRODUK' => 'B01002',
					'FNO_KATEGORI' => 'B01',
					'FN_NAMA' => 'Kopi Latte',
					'deleted_at' => null,
					'created_at' => now(),
					'updated_at' => now(),
					'group' => [
						[
							'FNO_PRODUK' => 'B01002',
							'FTEMPAT' => 'B',
						]
					],
				],
				[
					'FNO_PRODUK' => 'F01001',
					'FNO_KATEGORI' => 'F01',
					'FN_NAMA' => 'Nasi Goreng Biasa',
					'deleted_at' => null,
					'created_at' => now(),
					'updated_at' => now(),
					'group' => [
						[
							'FNO_PRODUK' => 'F01001',
							'FTEMPAT' => 'D',
						]
					],
				],
				[
					'FNO_PRODUK' => 'F01002',
					'FNO_KATEGORI' => 'F01',
					'FN_NAMA' => 'Nasi Goreng Spesial',
					'deleted_at' => null,
					'created_at' => now(),
					'updated_at' => now(),
					'group' => [
						[
							'FNO_PRODUK' => 'F01002',
							'FTEMPAT' => 'D',
						]
					],
				],
			];

			
			foreach ($produk as $key => $value) {
				try {
					$insert = Produk::firstOrCreate(Arr::except($value, ['group']));
					foreach ($value['group'] as $key => $value2) {
						$insert2 = GroupPembuatan::firstOrCreate($value2);
					}
				} catch (\Exception $e) {
					//
				}
			}
		}
}
