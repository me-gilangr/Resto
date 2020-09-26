<?php

namespace App\Http\Controllers\Backend;

use App\Http\Config\JsonDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MejaController extends Controller
{
		use JsonDatatable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('backend.meja.index');
		}
		
		public function datatable(Request $request)
		{
			return $this->jsonGetData('App\Models\Meja', $request->trashed);
		}
}
