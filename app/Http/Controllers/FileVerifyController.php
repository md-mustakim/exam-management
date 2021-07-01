<?php

namespace App\Http\Controllers;

use App\Models\FileVerify;
use App\Models\Panel;
use App\Models\PanelCourse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FileVerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Panel $panel, PanelCourse $panelCourse)
    {
        return view('teacher.panel.courseVerify', [
            'panel' => $panel,
            'course' => $panelCourse
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, Panel $panel)
    {
        $attributes = $request->validate([
           'panel_course' => 'required'
        ]);
        $attributes['teacher_id'] = Auth::guard('teacher')->id();
        $attributes['panel_id'] = $panel->id;
        FileVerify::create($attributes);
        return back()->with('message', 'File verified');
    }

    /**
     * Display the specified resource.
     *
     * @param FileVerify $fileVerify
     * @return Response
     */
    public function show(FileVerify $fileVerify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FileVerify $fileVerify
     * @return Response
     */
    public function edit(FileVerify $fileVerify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param FileVerify $fileVerify
     * @return Response
     */
    public function update(Request $request, FileVerify $fileVerify)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FileVerify $fileVerify
     * @return Response
     */
    public function destroy(FileVerify $fileVerify)
    {
        //
    }
}
