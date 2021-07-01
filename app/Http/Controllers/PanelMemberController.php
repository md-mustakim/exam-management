<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Models\PanelMember;
use App\Models\Teacher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PanelMemberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, Panel $panel): RedirectResponse
    {
        try {
            $teacher = Teacher::findOrFail($request->input('teacher_id'));
        }catch (ModelNotFoundException $modelNotFoundException){
            return back()->with('message', $modelNotFoundException->getMessage());
        }

        if (Auth::guard('teacher')->id() === $panel->teacher_id){
            $attributes = [
                'panel_id' => $panel->id,
                'teacher_id' => $teacher->id
            ];
            PanelMember::create($attributes);
            return back()->with('message', 'Member Added Success');
        }
        return back()->with('message', 'You are not authorized');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 09611349411
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Panel $panel)
    {
        $panelMembers = PanelMember::all()->where('panel_id', '=', $panel->id);
        $allMemberWithoutPanel = Teacher::all()->where('id', '!=', $panel->teacher_id);
        $idList = array();
        foreach ($panelMembers as $m)
        {
            array_push($idList, $m->teacher_id);
        }
        $newMemberArray = array();
        foreach ($allMemberWithoutPanel as $member)
        {

                $result = array_search($member->id, $idList);

                   if ($result === false){
                       array_push($newMemberArray, $member);
                   }

        }

        return view('teacher.panel.addMember', [
            'panel' => $panel,
            'teachers' => $newMemberArray
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param PanelMember $panelMember
     * @return Response
     */
    public function show(PanelMember $panelMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PanelMember $panelMember
     * @return Response
     */
    public function edit(PanelMember $panelMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PanelMember $panelMember
     * @return Response
     */
    public function update(Request $request, PanelMember $panelMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PanelMember $panelMember
     * @return Response
     */
    public function destroy(PanelMember $panelMember)
    {
        //
    }
}
