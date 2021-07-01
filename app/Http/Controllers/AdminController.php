<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Panel;
use App\Models\PanelCourse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest'])->only('showLogin');
        $this->middleware(['auth:admin'])->except(['loginAction','showLogin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function showLogin()
    {
        return view("admin.auth.login");
    }
    public function loginAction(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt($attributes))
        {
            return redirect()->route('admin.dashboard');
        }
        return back()->with('message', 'Invalid Login');
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login.show');
    }

    public function dashboard()
    {
        return view('admin.adminDashboard');
    }

    public function panelIndex()
    {
        return view('admin.panel.index', ['panels' => Panel::all()]);
    }

    public function panelShow(Panel $panel){
        $data = [
            'panel' =>  $panel,
            'courses' => PanelCourse::all()->where('panel_id', '=', $panel->id)
        ];
        return view('admin.panel.show', $data);
    }
}
