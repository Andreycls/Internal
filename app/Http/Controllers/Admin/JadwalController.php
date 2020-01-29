<?php

namespace App\Http\Controllers\Admin;
use App\Jadwal;
use App\Gedung;
use App\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJadwalRequest;
use App\Http\Requests\Admin\UpdateJadwalRequest;
use DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        $gedung = Gedung::all();
        return view('admin.jadwal.index', compact('jadwal','gedung'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Jadwal = \App\Jadwal::get()->pluck('question', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $kota = Kota::all();
        return view('admin.jadwal.create',compact('kota'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreJadwalRequest  $request_
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJadwalRequest $request_)
    {
        try{
            $kota = $request_->input('kota');
            $encodeKota = json_encode($kota);
            $request_->merge(['kota' => $encodeKota]);
            DB::beginTransaction();
            $Jadwal = Jadwal::create($request_->all());
            DB::commit();
            return redirect()->route('admin.jadwal.index');
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
        $kota = Kota::all();
        $gedung = Gedung::all();
        $jadwal = Jadwal::find($id);
        return view('admin.jadwal.edit', compact('jadwal','gedung','kota'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdateJadwalRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJadwalRequest $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        try{
            $kota = $request->input('kota');
            $encodeKota = json_encode($kota);
            $request->merge(['kota' => $encodeKota]);
            DB::beginTransaction();
            $jadwal->update($request->all());
            DB::commit();
            return redirect()->route('admin.jadwal.index');
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
        $jadwals = \App\Jadwal::where('id', $id)->get();
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.jadwal.show', compact('id', 'jadwal','jadwals'));
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Jadwal = Jadwal::findOrFail($id);
        $Jadwal->delete();
        return redirect()->route('admin.jadwal.index');
    }
}
