<?php

namespace App\Http\Controllers\Admin;
use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePengumumanRequest;
use App\Http\Requests\Admin\UpdatePengumumanRequest;

class PengumumanController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('pengumuman_access')) {
            return abort(401);
        }


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
        if (! Gate::allows('role_create')) {
            return abort(401);
        }
        $pengumuman = \App\Pengumuman::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.pengumuman.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StorePengumumanRequest  $request_
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengumumanRequest $request_)
    {
        if (! Gate::allows('pengumuman_create')) {
            return abort(401);
        }
        $pengumuman = Pengumuman::create($request_->all());
        // $image = $request_->file('file');
        // $imageName = $image->getClientOriginalName();
        // $image->move(public_path('images'),$imageName);
        
        // $imageUpload = new ImageUpload();
        // $imageUpload->filename = $imageName;
        // $imageUpload->save();

        //var_dump($request_->file('file'));
        return redirect()->route('admin.pengumuman.index');
    }



    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('pengumuman_edit')) {
            return abort(401);
        }
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
        if (! Gate::allows('pengumuman_edit')) {
            return abort(401);
        }
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->update($request->all());



        return redirect()->route('admin.pengumuman.index');
    }


    /**
     * Display Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('pengumuman_view')) {
            return abort(401);
        }
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
        if (! Gate::allows('pengumuman_delete')) {
            return abort(401);
        }
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index');
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('pengumuman_delete')) {
            return abort(401);
        }
        if ($request->input('id')) {
            $entries = Pengumuman::whereIn('id', $request->input('id'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}