<?php

namespace App\Http\Controllers\Admin;
use App\Gedung;
use App\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKotaRequest;
use App\Http\Requests\Admin\UpdateKotaRequest;

class KotaController extends Controller
{
    //
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        


                $kota = Kota::all();
                

        return view('admin.kota.index',compact('kota'));
    }
    public function create()
    {   
        
        $kota = Kota::all();
        
        return view('admin.kota.create',compact('kota'));
        }
    public function store(StoreKotaRequest $request_)
    {
        // 
        $Kota = Kota::create($request_->all());



        return redirect()->route('admin.kota.index');
    }

    
    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $kota = Kota::findOrFail($id);

        return view('admin.kota.edit', compact('kota'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdatePanduanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKotaRequest $request, $id)
    {
        
        $kota = Kota::findOrFail($id);
        $kota->update($request->all());



        return redirect()->route('admin.kota.index');
    }
    
    /**
     * Display Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $kotas = \App\Gedung::where('id', $id)->get();

        $kota = Kota::findOrFail($id);

        return view('admin.kota.show', compact('id', 'kota','kotas'));
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $Kota = Kota::findOrFail($id);
        $Kota->delete();

        return redirect()->route('admin.kota.index');
    }




}
