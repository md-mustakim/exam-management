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
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('teacher.index', ['teachers' =>Teacher::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:teachers,email',
            'phone' => 'required|unique:teachers,phone',
            'designation' => 'nullable',
            'password' => 'required'
        ]);
        $attributes['password'] = Hash::make($request->input('password'));

        Teacher::create($attributes);
        return redirect()->route('panel.teacher.index')->with('message', 'Update Success');
    }

    /**
     * Display the specified resource.
     *
     * @param Teacher $teacher
     * @return Application|Factory|View
     */
    public function show(Teacher $teacher)
    {
        return view('teacher.view', ['teacher' => $teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Teacher $teacher
     * @return Application|Factory|View
     */
    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Teacher $teacher
     * @return RedirectResponse
     */
    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:teachers,email,'. $teacher->id,
            'phone' => 'required|unique:teachers,phone,'. $teacher->id,
            'designation' => 'nullable',
            'password' => 'required'
        ]);

        $teacher->update($attributes);

        return back()->with('message', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Teacher $teacher
     * @return RedirectResponse
     */
    public function destroy(Teacher $teacher): RedirectResponse
    {
        return back()->with('message', 'Delete Success');
    }

    public function showLoginForm(){
        return view("teacher.auth.login");
    }


    public function login(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('teacher')->attempt($attributes))
        {
            return redirect()->route("panel.dashboard");
        }
        return back()->with('message', 'invalid email or password');
    }

    public function dashboard()
    {
        $id = Auth::guard('teacher')->id();
        $panelList = Panel::all()->where('teacher_id', '=', $id);
        $panelMember = PanelMember::all()->where('teacher_id', '=', $id);

        return view('teacher.teacherDashboard', ['panels' => $panelList, 'memberOfPanel' => $panelMember]);
    }
}
