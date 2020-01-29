<?php

namespace App\Http\Controllers\Admin;
use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePengumumanRequest;
use App\Http\Requests\Admin\UpdatePengumumanRequest;
use Illuminate\Support\Facades\Input;
use DB;
use Mpdf\Mpdf;
class PengumumanController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $pengumuman = Pengumuman::all();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function fileCreate()
    {
        return view('imageupload');
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        $pengumuman = \App\Pengumuman::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('admin.pengumuman.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StorePengumumanRequest  $request_
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengumumanRequest $request)
    {
        $timestamp = gmdate("Ymd-TH:i:s.000-Z");
        try{
            DB::beginTransaction();
            if(Input::hasFile('file')){
                $file = Input::file('file');
                $file->move('uploads/pengumuman', $timestamp.$file->getClientOriginalName());
                $request->merge(['nama_file' =>  $timestamp.$file->getClientOriginalName()]);
            }
            $pengumuman = Pengumuman::create($request->all());
            //$request->merge(['nama_file' =>  $timestamp.$file->getClientOriginalName()]);
            DB::commit();
            return redirect()->route('admin.pengumuman.index');
        }catch(Exception $e){
            DB::rollback();
            return back()->withErrors(['Koneksi lambat. Mohon ulangi kembali pendaftaran']);
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
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdatePengumumanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengumumanRequest $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $timestamp = gmdate("Ymd-TH:i:s.000-Z");
        try{
            DB::beginTransaction();
            if(Input::hasFile('file')){
                $file = Input::file('file');
                $file->move('uploads/pengumuman', $timestamp.$file->getClientOriginalName());
                $request->merge(['nama_file' =>  $timestamp.$file->getClientOriginalName()]);
            }
            $pengumuman->update($request->all());
            DB::commit();
            return redirect()->route('admin.pengumuman.index');
        }catch(Exception $e){
            DB::rollback();
            return back()->withErrors(['Koneksi lambat. Mohon ulangi kembali pendaftaran']);
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
        $pengumumans = \App\Pengumuman::where('id', $id)->get();
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.show', compact('id', 'pengumuman','pengumumans'));
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index');
    }

    

}
