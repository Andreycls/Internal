<?php

namespace App\Http\Controllers;
use App\Pengumuman;
use App\Panduan;
use App\Kota;
use App\Gedung;
use App\Http\Requests;  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePengumumanRequest;
use App\Http\Requests\Admin\UpdatePengumumanRequest;
use Illuminate\Support\Facades\Gate;
use DB;
class ClientSideController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * 
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                $last = DB::table('pengumuman')->latest()->first();
                $kota = Kota::all();
                $pengumuman = Pengumuman::all();
                $panduan    = Panduan::all();
                $gedung = Gedung::all();
                
        return view('client-side.index', compact('pengumuman','panduan','kota','last'));
    }
    public function showAll()
    {
        // if (! Gate::allows('pengumuman_access')) {
        //     return abort(401);
        // }


                $pengumuman = Pengumuman::all();
               /// dd($pengumuman);
        return view('client-side.pengumuman-all', compact('pengumuman'));
    }
    
    public function show($id)
    {
        // if (! Gate::allows('pengumuman_view')) {
        //     return abort(401);
        // }
        $pengumumans = \App\Pengumuman::where('id', $id)->get();

        $pengumuman = Pengumuman::findOrFail($id);

        return view('client-side.pengumuman-show', compact('id', 'pengumuman','pengumumans'));
    }
}
