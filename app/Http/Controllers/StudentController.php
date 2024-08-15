<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest('id')->get();
        return view('students.index', [
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        // $request->validate([
        //     'name'   => 'required',
        //     'nim'    => 'required|numeric',
        //     'dob'    => 'required|date',
        //     'gender' => 'required',
        //     'avatar' => 'required|image'
        // ]);

        // $student         = new Student();
        // $student->name   = $request->name;
        // $student->nim    = $request->nim;
        // $student->dob    = $request->dob;
        // $student->gender = $request->gender;
        // $student->save();

        $path = $request->file('avatar')->store('public/avatars');
        $url  = asset(Storage::url($path));

        // cara kedua
        Student::create([
            'name'   => $request->name,
            'nim'    => $request->nim,
            'dob'    => $request->dob,
            'gender' => $request->gender,
            'avatar' => $url,
        ]);

        // cara ketiga
        // DB::table('students')->insert([
        //     'name'   => $request->name,
        //     'nim'    => $request->nim,
        //     'dob'    => $request->dob,
        //     'gender' => $request->gender,
        // ]);

        return redirect()->back()->with('successMessage', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.form', [
            'd' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        // $request->validate([
        //     'name'   => 'required',
        //     'nim'    => 'required|numeric',
        //     'dob'    => 'required|date',
        //     'gender' => 'required',
        //     'avatar' => 'nullable|image'
        // ]);

        $student = Student::findOrFail($id);

        // $student->name   = $request->name;
        // $student->nim    = $request->nim;
        // $student->dob    = $request->dob;
        // $student->gender = $request->gender;
        // $student->save();

        $url = $student->avatar;

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/avatars');
            $url  = asset(Storage::url($path));
        }

        $student->update([
            'name'   => $request->name,
            'nim'    => $request->nim,
            'dob'    => $request->dob,
            'gender' => $request->gender,
            'avatar' => $url,
        ]);

        return redirect()->back()->with('successMessage', 'Mahasiswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $student = Student::findOrFail($id);
        // $student->delete();

        // cara kedua
        // DB::table('students')->where('id', $id)->delete();

        // cara ketiga
        Student::where('id', $id)->delete();

        return redirect()->back()->with('successMessage', 'Mahasiswa berhasil dihapus');
    }
}
