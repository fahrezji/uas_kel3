<?php

namespace App\Http\Controllers;

use App\Models\komen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class komencontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = komen::orderby('id', 'desc')->paginate(7);
        return view('komen.index')->with ('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/komen/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('email', $request->email);
        Session::flash('komentar', $request->komentar);

        $request->validate([
            'nama' => 'required',
            'email'=> 'required',
            'komentar' => 'required',
            // 'gambar' => 'image | file | max:2048'
        ]);

        $data=[
            'nama'=> $request->input('nama'),
            'email'=> $request->input('email'),
            'komentar'=> $request->input('komentar')

        ];

        // if ($request->file('gambar')){
        //     $data['gambar'] = $request->file('gambar')->store('gambar');

        // }

        komen::create($data);
        return redirect('/')->with('success', 'Berhasil Menginput Data Komentar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = komen::where('id', $id)->first();
        return view('komen/index')->with('data', $data);
        //  return view('komen/show' , $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= komen::where('id', $id)->delete();

        // $data_gambar = tamu::where('id', $id)->first();
        // File::delete(public_path('gambar'). '/'. $data_gambar->gambar);

       komen::where('id', $id)->delete();
        return redirect('/komen')->with('success', 'Berhasil Hapus Data');
    }
}
