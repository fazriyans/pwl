<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//tambahan
use DB;
use App\models\Anggota;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_anggota = DB::table('anggota')->get();
        return view('anggota.index',compact('ar_anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengarahkan ke halaman form input
        return view('anggota.form');
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
            'nama'=>'required',
            'email'=>'required',
            'hp'=>'required',
            'foto'=>'required'
        ]);
        //proses upload foto
        if (!empty($request->foto)) {
            $request->validate(
                ['foto'=>'image|mimes:png,jpg|max:2048']
            );
            $fileName = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('images'),$fileName);
        } else {
            $fileName = '';
        }
        //proses input data
        //1.tangkap request dari form input
        DB::table('anggota')->insert(
            [
                'nama'=>$request->nama,
                'email'=>$request->email,
                'hp'=>$request->hp,
                //'foto'=>$request->foto,
                'foto'=>$fileName,
            ]
        );
        //2.landing page
        return redirect('/anggota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail anggota
        $ar_anggota = DB::table('anggota')
                        ->where('id', '=', $id)->get();
        return view('anggota.show',compact('ar_anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mengarahkan ke halaman form edit
        $data = DB::table('anggota')
                        ->where('id', '=', $id)->get();
        return view('anggota.form_edit',compact('data'));
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
        $request->validate([
            'nama'=>'required',
            'email'=>'required',
            'hp'=>'required',
            'foto'=>'required'
        ]);
        //proses upload foto
        if (!empty($request->foto)) {
            $request->validate(
                ['foto'=>'image|mimes:png,jpg|max:2048']
            );
            $fileName = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('images'),$fileName);
        } else {
            $fileName = '';
        }
        DB::table('anggota')->where('id', '=', $id)->update(
            [
                'nama'=>$request->nama,
                'email'=>$request->email,
                'hp'=>$request->hp,
                'foto'=>$fileName,
            ]
        );
        //2.landing page
        return redirect('/anggota'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data
        DB::table('anggota')->where('id', $id)->delete();
        return redirect('/anggota');
    }
}
