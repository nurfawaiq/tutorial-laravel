<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EdulevelController extends Controller
{
    
    public function data()
    {
        $edulevels = DB::table('edulevels')->simplePaginate(5);

        // dd($edulevels);
        // return $edulevels;
        // return view('edulevel.data', ['edulevels' => $edulevels]);
        // return view('edulevel.data', compact('edulevels'));
        return view('edulevel.data')->with('edulevels', $edulevels);
    }

    public function add()
    {
        return view('edulevel.add');
    }

    public function addProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'desc' => 'required',
        ], [
            'name.required' => 'Nama jenjang tidak boleh kosong'
        ]);

        DB::table('edulevels')->insert([
            'name' => $request->name,
            'desc' => $request->desc
        ]);
        return redirect('edulevels')->with('status', 'Jenjang berhasil ditambah!');
    }

    public function edit($id)
    {
        $edulevel = DB::table('edulevels')->where('id', $id)->first();
        return view('edulevel/edit', compact('edulevel'));
    }

    public function editProcess(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'desc' => 'required',
        ]);

        DB::table('edulevels')->where('id', $id)
            ->update([
                'name' => $request->name,
                'desc' => $request->desc
            ]);
        return redirect('edulevels')->with('status', 'Jenjang berhasil diupdate!');
    }

    public function delete($id)
    {
        DB::table('edulevels')->where('id', $id)->delete();
        return redirect('edulevels')->with('status', 'Jenjang berhasil dihapus!');
    }

}
