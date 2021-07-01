<?php

namespace App\Http\Controllers;

use App\Models\PanelCourse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PanelCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, $id): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'file' => 'required|mimes:pdf,doc,docx'
        ]);
        $attributes['panel_id'] = $id;
        $attributes['teacher_id'] = Auth::guard('teacher')->id();

        if ($request->hasFile('file')){
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('/',$fileName, 'public');

                $attributes['file'] = $filePath;
                PanelCourse::create($attributes);
                return back()->with('message', 'Submit Success');
        }
        return back()->with('message', 'File is required');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PanelCourse  $panelCourse
     * @return \Illuminate\Http\Response
     */
    public function show(PanelCourse $panelCourse)
    {
        //
    }

    public function downloadFile(PanelCourse $panelCourse)
    {
        if (Storage::disk('public')->exists($panelCourse->file)){
          $url = Storage::url($panelCourse->file);
            return response()->download(public_path($url));
        }
        return 'no file found';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PanelCourse  $panelCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(PanelCourse $panelCourse)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\PanelCourse  $panelCourse
     * @return RedirectResponse
     */
    public function update(Request $request, PanelCourse $panelCourse): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);
        $attributes['panel_id'] = $id;
        $attributes['teacher_id'] = Auth::guard('teacher')->id();

        if ($request->hasFile('file')){
            if (file_exists(public_path(Storage::url($panelCourse->file)))) {
                // Delete File if Exists
                File::delete(public_path(Storage::url($panelCourse->file)));
                //Upload new File
                $fileName = time().'_'.$request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('/',$fileName, 'public');

                $attributes['file'] = $filePath;
            }else{
                $fileName = time().'_'.$request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('/',$fileName, 'public');

                $attributes['file'] = $filePath;
            }
            $panelCourse->update($attributes);
            return back()->with('message', 'Update & Upload Success');
        }
        $panelCourse->update($attributes);
        return back()->with('message', 'update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PanelCourse  $panelCourse
     * @return RedirectResponse
     */
    public function destroy(PanelCourse $panelCourse): RedirectResponse
    {
        if (file_exists(public_path(Storage::url($panelCourse->file)))){
            $status = File::delete(public_path(Storage::url($panelCourse->file)));
            if ($status){
               $panelCourse->delete();
                return back()->with('message', 'Delete Success');
            }
            return back()->with('message', 'File delete Failed');
        }
        $panelCourse->delete();
        return back()->with('message', 'Delete Success');
    }
}
