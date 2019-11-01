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
        if (! Gate::allows('role_create')) {
            return abort(401);
        }
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
        // 
        $Jadwal = Jadwal::create($request_->all());



        return redirect()->route('admin.jadwal.index');
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
        $jadwal->update($request->all());



        return redirect()->route('admin.jadwal.index');
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

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('Jadwal_delete')) {
            return abort(401);
        }
        if ($request->input('id')) {
            $entries = Jadwal::whereIn('id', $request->input('id'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
