<?php

namespace App\Http\Controllers\Admin;
use App\Gedung;
use App\Ruangan;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRuanganRequest;
use App\Http\Requests\Admin\UpdateRuanganRequest;

class RuanganController extends Controller
{
    //
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $ruangan = Ruangan::all();
        $ruangans = \App\Ruangan::get();
        $gedungs = \App\Ruangan::get();
        


                
                

        return view('admin.ruangan.index',compact('ruangan','gedungs'));
    }
    public function create()
    {   
        $str='{
            {
                "id":"11","nama":"ACEH"
            },
            {
                "id":"12","nama":"SUMATERA UTARA"},
            {
                "id":"13","nama":"SUMATERA BARAT"},
            {
                "id":"14","nama":"RIAU"},
            {
                "id":"15","nama":"JAMBI"},
            {
                "id":"16","nama":"SUMATERA SELATAN"},
            {
                "id":"17","nama":"BENGKULU"},
            {
                "id":"18","nama":"LAMPUNG"},
            {
                "id":"19","nama":"KEPULAUAN BANGKA BELITUNG"},
            {"id":"21","nama":"KEPULAUAN RIAU"},{"id":"31","nama":"DKI JAKARTA"},{"id":"32","nama":"JAWA BARAT"},{"id":"33","nama":"JAWA TENGAH"},{"id":"34","nama":"DI YOGYAKARTA"},{"id":"35","nama":"JAWA TIMUR"},{"id":"36","nama":"BANTEN"},{"id":"51","nama":"BALI"},{"id":"52","nama":"NUSA TENGGARA BARAT"},{"id":"53","nama":"NUSA TENGGARA TIMUR"},{"id":"61","nama":"KALIMANTAN BARAT"},{"id":"62","nama":"KALIMANTAN TENGAH"},{"id":"63","nama":"KALIMANTAN SELATAN"},{"id":"64","nama":"KALIMANTAN TIMUR"},{"id":"65","nama":"KALIMANTAN UTARA"},{"id":"71","nama":"SULAWESI UTARA"},{"id":"72","nama":"SULAWESI TENGAH"},{"id":"73","nama":"SULAWESI SELATAN"},{"id":"74","nama":"SULAWESI TENGGARA"},{"id":"75","nama":"GORONTALO"},{"id":"76","nama":"SULAWESI BARAT"},{"id":"81","nama":"MALUKU"},{"id":"82","nama":"MALUKU UTARA"},{"id":"91","nama":"PAPUA BARAT"},{"id":"94","nama":"PAPUA"}
        }';
        $ruangan = Ruangan::all();
        $gedungs = \App\Gedung::get()->pluck('nama_gedung','kode_gedung')->prepend(trans('quickadmin.qa_please_select'), '');
        //$json = json_decode($str);
        $max = Ruangan::max('id');  
      
        return view('admin.ruangan.create',compact('ruangan','max','gedungs'));
        //print_r($json);
    }
    public function store(StoreRuanganRequest $request_)
    {
        // 
        $Ruangan = Ruangan::create($request_->all());
      


        return redirect()->route('admin.ruangan.index');
    }

    
    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $ruangan = Ruangan::findOrFail($id);

        return view('admin.ruangan.edit', compact('ruangan'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdatePanduanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRuanganRequest $request, $id)
    {
        
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->all());



        return redirect()->route('admin.ruangan.index');
    }
    
    /**
     * Display Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $ruangans = \App\Ruangan::where('id', $id)->get();

        $ruangan = Ruangan::findOrFail($id);

        return view('admin.ruangan.show', compact('id', 'ruangan','ruangan'));
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $Ruangan = Ruangan::findOrFail($id);
        $Ruangan->delete();

        return redirect()->route('admin.ruangan.index');
    }




}
