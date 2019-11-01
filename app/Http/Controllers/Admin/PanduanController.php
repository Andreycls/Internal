<?php

namespace App\Http\Controllers\Admin;
use App\Panduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePanduanRequest;
use App\Http\Requests\Admin\UpdatePanduanRequest;

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
        if (! Gate::allows('role_create')) {
            return abort(401);
        }
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
        // 
        $this->path = storage_path('app/public/upload');
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['245', '300', '500'];
        $Panduan = Panduan::create($request_->all());



        return redirect()->route('admin.panduan.index');
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
        $panduan->update($request->all());



        return redirect()->route('admin.panduan.index');
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

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('Panduan_delete')) {
            return abort(401);
        }
        if ($request->input('id')) {
            $entries = Panduan::whereIn('id', $request->input('id'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
