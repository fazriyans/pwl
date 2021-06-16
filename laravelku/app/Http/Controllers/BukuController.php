<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//tambahan
use DB;
use App\Models\Buku;
use PDF;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_buku = DB::table('buku')
            ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
            ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
            ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
            ->select('buku.*', 'pengarang.nama', 'penerbit.nama AS pen',
                    'kategori.nama AS kat')
            ->get();
        return view('buku.index',compact('ar_buku'));
    }

    public function bukuPDF()
    {
        $ar_buku = DB::table('buku')
            ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
            ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
            ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
            ->select('buku.*', 'pengarang.nama', 'penerbit.nama AS pen',
                    'kategori.nama AS kat')
            ->get();

        $pdf = PDF::loadView('buku.daftarBuku', ['ar_buku'=>$ar_buku]);

        return $pdf->download('daftarBuku.pdf');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengarahkan ke halaman form input
        return view('buku.form');
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
            'isbn'=>'required | max:70',
            'judul'=>'required | max:70',
            'tahun_cetak'=>'required | max:70',
            'stok'=>'required | max:70',
            'idpengarang'=>'required | max:70',
            'idpenerbit'=>'required | max:70',
            'idkategori'=>'required | max:70',
        ]);
        //proses upload cover
        if (!empty($request->cover)) {
            $request->validate(
                ['cover'=>'image|mimes:png,jpg|max:2048']
            );
            $fileName = time().'.'.$request->cover->extension();
            $request->cover->move(public_path('images'),$fileName);
        } else {
            $fileName = '';
        }
        //proses input data
        //1.tangkap request dari form input
        DB::table('buku')->insert(
            [
                'isbn'=>$request->isbn,
                'judul'=>$request->judul,
                'tahun_cetak'=>$request->tahun_cetak,
                'stok'=>$request->stok,
                'idpengarang'=>$request->idpengarang,
                'idpenerbit'=>$request->idpenerbit,
                'idkategori'=>$request->idkategori,
                'cover'=>$fileName,
            ]
        );
        //2.landing page
        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail buku
        $ar_buku = DB::table('buku')
            ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
            ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
            ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
            ->select('buku.*', 'pengarang.nama', 'penerbit.nama AS pen',
                'kategori.nama AS kat')
            ->where('buku.id', '=', $id)->get();
        return view('buku.show',compact('ar_buku'));
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
        $data = DB::table('buku')
                        ->where('id', '=', $id)->get();
        return view('buku.form_edit',compact('data'));
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
            'isbn'=>'required | max:70',
            'judul'=>'required | max:70',
            'tahun_cetak'=>'required | max:70',
            'stok'=>'required | max:70',
            'idpengarang'=>'required | max:70',
            'idpenerbit'=>'required | max:70',
            'idkategori'=>'required | max:70',
        ]);
        //proses upload cover
        if (!empty($request->cover)) {
            $request->validate(
                ['cover'=>'image|mimes:png,jpg|max:2048']
            );
            $fileName = time().'.'.$request->cover->extension();
            $request->cover->move(public_path('images'),$fileName);
        } else {
            $fileName = '';
        }
        //proses edit data lama
        DB::table('buku')->where('id', '=', $id)->update(
            [
                'isbn'=>$request->isbn,
                'judul'=>$request->judul,
                'tahun_cetak'=>$request->tahun_cetak,
                'stok'=>$request->stok,
                'idpengarang'=>$request->idpengarang,
                'idpenerbit'=>$request->idpenerbit,
                'idkategori'=>$request->idkategori,
                'cover'=>$fileName,
            ]
        );
        //2.landing page
        return redirect('/buku'.'/'.$id);
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
        DB::table('buku')->where('id', $id)->delete();
        return redirect('/buku');
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to Ext Generate PDF',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('buku.myPDF', $data);

        return $pdf->download('tesPDF.pdf');
    }
}
