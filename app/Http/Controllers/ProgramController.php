<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Edulevel;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $programs = Program::all();
        $programs = Program::with('edulevel')->paginate(10);
        // $programs = Program::withTrashed()->get();

        // return $programs;
        return view('program/index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edulevels = Edulevel::all();
        return view('program.create', compact('edulevels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'edulevel_id' => 'required',
        ], [
            'edulevel_id.required' => 'The jenjang / edulevel field is required.'
        ]);

        // return $request;
        // cara 1
        // $program = new Program;
        // $program->name = $request->name;
        // $program->edulevel_id = $request->edulevel_id;
        // $program->student_price = $request->student_price;
        // $program->student_max = $request->student_max;
        // $program->info = $request->info;
        // $program->save();

        // cara 2 : mass assignment
        // Program::create([
        //     'name' => $request->name,
        //     'edulevel_id' => $request->edulevel_id,
        //     'student_price' => $request->student_price,
        //     'student_max' => $request->student_max,
        //     'info' => $request->info,
        // ]);

        // cara 3 : quick mass assignment > syarat : field tabel dan name inputan harus sama
        Program::create($request->all());

        // cara 4 : gabungan
        // $program = new Program([
        //     'name' => $request->name,
        //     'edulevel_id' => $request->edulevel_id,
        //     'student_price' => $request->student_price,
        //     'student_max' => $request->student_max,
        //     'info' => $request->info,
        // ]);
        // $program->student_price = $request->student_price;
        // $program->save();

        return redirect('programs')->with('status', 'Program berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        // $program = Program::find($id);
        
        // $program = Program::where('id', $id)->get();
        // $program = $program[0];

        $program->makeHidden(['edulevel_id']);
        // return $program;
        return view('program/show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $edulevels = Edulevel::all();
        return view('program.edit', compact('program', 'edulevels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|min:3',
            'edulevel_id' => 'required',
        ], [
            'edulevel_id.required' => 'The jenjang / edulevel field is required.'
        ]);
        // return $request;

        // cara 1
        // $program->name = $request->name;
        // $program->edulevel_id = $request->edulevel_id;
        // $program->student_price = $request->student_price;
        // $program->student_max = $request->student_max;
        // $program->info = $request->info;
        // $program->save();

        // cara 2
        Program::where('id', $program->id)
          ->update([
                'name' => $request->name,
                'edulevel_id' => $request->edulevel_id,
                'student_price' => $request->student_price,
                'student_max' => $request->student_max,
                'info' => $request->info,
            ]);

        return redirect('programs')->with('status', 'Program berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        // cara 1
        $program->delete();

        // cara 2
        // Program::destroy($program->id);

        // cara 3
        // Program::where('id', $program->id)->delete();

        return redirect('programs')->with('status', 'Program berhasil masuk tong sampah!');
    }


    public function trash()
    {
        $programs = Program::onlyTrashed()->get();
        return view('program.trash', compact('programs'));
    }

    public function restore($id = null)
    {
        if($id != null) {
            $programs = Program::onlyTrashed()
                ->where('id', $id)
                ->restore();
        } else {
            $programs = Program::onlyTrashed()->restore();
        }

        return redirect('programs/trash')->with('status', 'Program berhasil di-restore!');
    }

    public function delete($id = null)
    {
        if($id != null) {
            $programs = Program::onlyTrashed()
                ->where('id', $id)
                ->forceDelete();
        } else {
            $programs = Program::onlyTrashed()->forceDelete();
        }

        return redirect('programs/trash')->with('status', 'Program berhasil dihapus permanen!');
    }
}
