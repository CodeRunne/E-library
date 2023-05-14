<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{Department, Level, Student};
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredStudentController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'departments' => Department::all(),
            'levels' => Level::all(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'matric_no' => ['required', 'string', 'regex:/\d{2}\/\w{2}\/\w{2}\/\d{4}/', 'max:255', 'unique:'.Student::class],
            'department' => ['required', 'integer'],
            'level' => ['required', 'integer'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()->min(6)],
        ]);

        $student = Student::create([
            'fullname' => $request->fullname,
            'matric_no' => $request->matric_no,
            'department_id' => $request->department,
            'level_id' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($student));

        Auth::guard('student')->login($student);

        return redirect(RouteServiceProvider::HOME);
    }
}