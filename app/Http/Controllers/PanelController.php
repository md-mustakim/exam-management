<?php

namespace App\Http\Controllers;

use App\Models\FileVerify;
use App\Models\Panel;
use App\Models\PanelCourse;
use App\Models\PanelMember;
use App\Models\Teacher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:teacher']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
       return view('teacher.panel.index', ['panels' => Panel::all()->where('teacher_id', '=', Auth::guard('teacher')->id())]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('teacher.panel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'=> 'required',
            'description' => 'nullable'
        ]);

        $attributes['code'] = random_int(100000, 999999);

        $attributes['teacher_id'] = Auth::guard('teacher')->id();

        Panel::create($attributes);
        return redirect()->route('panel.index');
    }

    public function courseDetails(): object
    {
        $courseWithVote = PanelCourse::with('verifyBy')->get();
        $result = array();
        foreach ($courseWithVote as $single)
        {
            $id = Auth::guard('teacher')->id();
            $single = (array)$single;
            $resultSearch = array_search($id, $single);
            if ($resultSearch === false)
            {
                $single['status'] = false;
            }
            else
            {
                $single['status'] = true;
            }
            array_push($result,$single);
        }
        return (object)$result;

    }

    /**
     * Display the specified resource.
     *
     * @param Panel $panel
     * @return Application|Factory|View
     */
    public function show(Panel $panel)
    {
        $courses = PanelCourse::all()->where('panel_id', '=', $panel->id);

        $members = PanelMember::all()->where('panel_id', '=', $panel->id);
        $verifiedFileMemberList = FileVerify::all()
            ->where('panel_id', '=', $panel->id)
        ->where('panel_course', '=', );

        $teacherList = array();
        foreach ($verifiedFileMemberList as $teacher)
        {
            array_push($teacherList, $teacher->teacher_id);
        }
        //return $verifiedFileMemberList;
        $searchResult = array_search(Auth::guard('teacher')->id(), $teacherList);
        $verifiedStatus =true;
        if ($searchResult === false)
        {
            $verifiedStatus = false;
        }else{
            $verifiedStatus = true;
        }

        return view('teacher.panel.show', [
            'panel' => $panel,
            'courses' => $courses,
            'c' => $this->courseDetails(),
            'members' => $members,
            'verifiedStatus' => $verifiedStatus
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Panel $panel
     * @return Response
     */
    public function edit(Panel $panel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Panel $panel
     * @return Response
     */
    public function update(Request $request, Panel $panel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Panel $panel
     * @return Response
     */
    public function destroy(Panel $panel)
    {
        //
    }
}
