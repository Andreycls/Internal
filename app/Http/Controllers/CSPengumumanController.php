<?php

namespace App\Http\Controllers;
use App\Pengumuman;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePengumumanRequest;
use App\Http\Requests\Admin\UpdatePengumumanRequest;
use Illuminate\Support\Facades\Gate;

class CSPengumumanController extends Controller
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
        

                $pengumuman = Pengumuman::all();

        return view('client-side.pengumuman', compact('pengumuman'));
    }
    public function showAll()
    {
        $pengumuman = Pengumuman::all();
        return view('client-side.pengumuman-all', compact('pengumuman'));
    }
    
    public function show($id)
    {
    
        $pengumumans = \App\Pengumuman::where('id', $id)->get();

        $pengumuman = Pengumuman::findOrFail($id);
        
        return view('client-side.pengumuman-show', compact('downloadPath','id', 'pengumuman','pengumumans'));
    }
}
