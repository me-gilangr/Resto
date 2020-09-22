<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$data_kategori = Kategori::get();
			return view('Master.Kategori.index', compact('data_kategori'));
		}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Master.Kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			Kategori::create([
				'FK_KAT' => rand(100, 999),
				'FN_KAT' => $request->FN_NAMA
			]);

			return redirect(route('kategori.index'));

		}
		

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
			$data_kategori = Kategori::where('FK_KAT', '=', $id)->first();

      return view('Master.Kategori.edit', compact('data_kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
			$data_kategori = Kategori::where('FK_KAT', '=', $id)->first();

			$data_kategori->update([
				'FN_KAT' => $request->FN_NAMA
			]);

			return redirect(route('kategori.index'));
		}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
			$data_kategori = Kategori::where('FK_KAT', '=', $id)->first();
			$data_kategori->delete();

			return redirect(route('kategori.index'));
		}
}
