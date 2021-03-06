<?php

namespace App\Http\Controllers\Admin;

use App\Gedung;
use App\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGedungRequest;
use App\Http\Requests\Admin\UpdateGedungRequest;
use Validator;
use DB;
class GedungController extends Controller
{
    
    public function addMore()
    {
        return view("addMore");
    }


    public function addMorePost(Request $request)
    {
        $rules = [];
        foreach($request->input('alamat') as $key => $value) {
            $rules["alamat.{$key}"] = 'required';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            foreach($request->input('alamat') as $key => $value) {
                Gedung::create(['name'=>$value]);
            }
            return response()->json(['success'=>'done']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }


    public function index()
    {
        $gedung = Gedung::all();
        return view('admin.gedung.index',compact('gedung'));
    }

    public function countGedungInKota($kota){
        $totalGedung = Gedung::where('kota',$kota)->get()->count();
        return $totalGedung+1;
    }
    
    public function create(){   
        $gedung = Gedung::all();
        $Gedung = \App\Gedung::get()->pluck('kode_gedung', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $max = Gedung::max('id');
        $kotas = \App\Kota::get()->pluck('nama_kota','nama_kota')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('admin.gedung.create',compact('gedung','max','kotas'));
    }

    public function store(StoreGedungRequest $request_)
    {
        try{
            DB::beginTransaction();
            $datas = $request_->except(['_token']);;
            $gedungs = $datas['nama_gedung'];
            $alamats = $datas['alamat'];
            $kotaq = $datas['kota'];
            $kodeGedungs= $datas['kode_gedung'];
            $banyakRuangan = $datas['banyak_ruangan'];
            
            
            $rows = [];
            $countGedung = $this->countGedungInKota($kotaq);
            foreach($gedungs as $key => $input) {
                
                    array_push($rows, [
                    'nama_gedung' => isset($gedungs[$key]) ? $gedungs[$key] : '', //add a default value here
                    'banyak_ruangan' => isset($banyakRuangan[$key]) ? $banyakRuangan[$key] : '',
                    'alamat' => isset($alamats[$key]) ? $alamats[$key] : '', //add a default value here
                    'kota' => isset($kotaq[$key]) ? $kotaq[$key] : '',
                    'kode_gedung' => isset($kodeGedungs[$key]) ? $kodeGedungs[$key] : '',
                    'index'=>$countGedung,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s"),
                    ]);
                    $countGedung++;
                }
            Gedung::insert($rows);

            DB::commit();
            return redirect()->route('admin.gedung.index');
        }catch(Exception $e){
            DB::rollback();
            return back()->withErrors(['Gagal. Mohon ulangi kembali proses input']);
        }

    }

    
    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kotas = \App\Kota::get()->pluck('nama_kota','nama_kota')->prepend(trans('quickadmin.qa_please_select'), '');
        $gedung = Gedung::findOrFail($id);

        return view('admin.gedung.edit', compact('gedung','kotas'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdatePanduanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGedungRequest $request, $id)
    {
        $gedung = Gedung::findOrFail($id);
        try{
            DB::beginTransaction();
            $gedung->update($request->all());
            DB::commit();
            return redirect()->route('admin.gedung.index');
        }catch(Exception $e){
            DB::rollback();
            return back()->withErrors(['Gagal. Mohon ulangi kembali proses input']);
        }
    }
    
    /**
     * Display Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $gedungs = \App\Gedung::where('id', $id)->get();

        $gedung = Gedung::findOrFail($id);

        return view('admin.gedung.show', compact('id', 'gedung','gedungs'));
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $Gedung = Gedung::findOrFail($id);
        $Gedung->delete();

        return redirect()->route('admin.gedung.index');
    }




}
