<?php

use App\Models\DetailMenu;
use App\Models\HeaderMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$hmenu = [
				[
					'FNO_H_MENU' => 'B0101',
					'FN_MENU' => 'Caffee Cappucino',
					'FHARGAPOKOK' => 18000,
					'FPAJAK' => '0.10',
					'FHARGAJUAL' => 25000,
					'FSTATUS' => 1,
					'FGAMBAR' => '160263843734.jpg',
					'deleted_at' => null,
					'created_at' => now(),
					'updated_at' => now(),
					'detail' => [
						[
							'FNO_H_MENU' => 'B0101',
							'FNO_PRODUK' => 'B01001',
							'FJML' => 1,
							'deleted_at' => null,
							'created_at' => now(),
							'updated_at' => now(),
						],
					],
				],
				[
					'FNO_H_MENU' => 'B0102',
					'FN_MENU' => 'Caffee Latte',
					'FHARGAPOKOK' => 18000,
					'FPAJAK' => '0.10',
					'FHARGAJUAL' => 27500,
					'FSTATUS' => 1,
					'FGAMBAR' => '160263845346.jpg',
					'deleted_at' => null,
					'created_at' => now(),
					'updated_at' => now(),
					'detail' => [
						[
							'FNO_H_MENU' => 'B0102',
							'FNO_PRODUK' => 'B01002',
							'FJML' => 1,
							'deleted_at' => null,
							'created_at' => now(),
							'updated_at' => now(),
						],
					],
				],
				[
					'FNO_H_MENU' => 'F0101',
					'FN_MENU' => 'Nasi Goreng Ala Ale',
					'FHARGAPOKOK' => 15500,
					'FPAJAK' => '0.10',
					'FHARGAJUAL' => 20000,
					'FSTATUS' => 1,
					'FGAMBAR' => '160263846936.jpg',
					'deleted_at' => null,
					'created_at' => now(),
					'updated_at' => now(),
					'detail' => [
						[
							'FNO_H_MENU' => 'F0101',
							'FNO_PRODUK' => 'F01001',
							'FJML' => 1,
							'deleted_at' => null,
							'created_at' => now(),
							'updated_at' => now(),
						],
					],
				],
				[
					'FNO_H_MENU' => 'F0102',
					'FN_MENU' => 'Nasi Goreng Spesial Ala Ale',
					'FHARGAPOKOK' => 20000,
					'FPAJAK' => '0.10',
					'FHARGAJUAL' => 28000,
					'FSTATUS' => 1,
					'FGAMBAR' => '160263848012.jpg',
					'deleted_at' => null,
					'created_at' => now(),
					'updated_at' => now(),
					'detail' => [
						[
							'FNO_H_MENU' => 'F0102',
							'FNO_PRODUK' => 'F01002',
							'FJML' => 1,
							'deleted_at' => null,
							'created_at' => now(),
							'updated_at' => now(),
						],
					],
				],
				[
					'FNO_H_MENU' => 'F0103',
					'FN_MENU' => 'Paket Nasi Goreng',
					'FHARGAPOKOK' => 35000,
					'FPAJAK' => '0.10',
					'FHARGAJUAL' => 45000,
					'FSTATUS' => 1,
					'FGAMBAR' => '160267708162.jpg',
					'deleted_at' => null,
					'created_at' => now(),
					'updated_at' => now(),
					'detail' => [
						[
							'FNO_H_MENU' => 'F0103',
							'FNO_PRODUK' => 'F01001',
							'FJML' => 1,
							'deleted_at' => null,
							'created_at' => now(),
							'updated_at' => now(),
						],
						[
							'FNO_H_MENU' => 'F0103',
							'FNO_PRODUK' => 'F01002',
							'FJML' => 1,
							'deleted_at' => null,
							'created_at' => now(),
							'updated_at' => now(),
						],
					],
				],
				
			];

			
			foreach ($hmenu as $key => $value) {
				try {
					$insert = HeaderMenu::firstOrCreate(Arr::except($value, ['detail']));
					foreach ($value['detail'] as $key => $value2) {
						$insert2 = DetailMenu::firstOrCreate($value2);
					}
				} catch (\Exception $e) {
					dd($e);
					//
				}
			}
		}
}
