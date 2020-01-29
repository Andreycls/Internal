<?php

namespace App\Http\Controllers\Admin;
use App\Panduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePanduanRequest;
use App\Http\Requests\Admin\UpdatePanduanRequest;
use DB;

class PanduanController extends Controller
{
    public $path;
    public $dimensions;
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $panduan = Panduan::all();
        return view('admin.panduan.index', compact('panduan'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Panduan = \App\Panduan::get()->pluck('question', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('admin.panduan.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StorePanduanRequest  $request_
     * @return \Illuminate\Http\Response
     */
    public function store(StorePanduanRequest $request_)
    {
        try{
            DB::beginTransaction();
            $Panduan = Panduan::create($request_->all());
            DB::commit();
            return redirect()->route('admin.panduan.index');
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
        $panduan = Panduan::findOrFail($id);
        return view('admin.panduan.edit', compact('panduan'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdatePanduanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePanduanRequest $request, $id)
    {
        $panduan = Panduan::findOrFail($id);
        try{
            DB::beginTransaction();
            $panduan->update($request->all());
            DB::commit();
            return redirect()->route('admin.panduan.index');
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
        $panduans = \App\Panduan::where('id', $id)->get();
        $panduan = Panduan::findOrFail($id);
        return view('admin.panduan.show', compact('id', 'panduan','panduans'));
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Panduan = Panduan::findOrFail($id);
        $Panduan->delete();
        return redirect()->route('admin.panduan.index');
    }

    
}
