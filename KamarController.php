<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use File;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamar = Kamar::all();
        return view('admin.kamar', [
            "title" => "Kamar | Hotel.LuuL"
        ], compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe_kamar' => 'required|unique:kamars',
            'jumlah' => 'required',
            'image' => 'required | mimes:jpg,png,jpeg,gif,svg | max:10000',
        ], [
            'tipe_kamar.required' => 'Tipe kamar tidak boleh kosong!',
            'jumlah.required' => 'Jumlah kamar tidak boleh kosong!',
            'image.required' => 'Gambar tidak boleh kosong!',
            'image.mimes' => 'Gambar harus berformat jpg,png,jpeg,gif,svg!',
            'image.max' => 'Gambar tidak boleh melebihi 10mb!',
            'tipe.unique' => 'Tipe kamar sudah ada!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            DB::transaction(function () use ($request) {

                Kamar::create([
                    'tipe_kamar' => $request->tipe_kamar,
                    'jumlah' => $request->jumlah,
                    'image' => $request->image->move(public_path('images'), $request->file('image')->getClientOriginalName()),
                    'name_img' => $request->file('image')->getClientOriginalName(),
                ]);
            });


            return back()->with(['success' => 'Data berhasil ditambah!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tipe_kamar' => 'required',
            'jumlah' => 'required',
        ], [
            'nama_siswa.required' => 'Nama siswa tidak boleh kosong!',
            'alamat.required' => 'Alamat siswa tidak boleh kosong!',
            'no_telepon.required' => 'Nomor telepon siswa tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            if (!$request->image) {
                Kamar::findOrFail($id)->update([
                    'tipe_kamar' => $request->tipe_kamar,
                    'jumlah' => $request->jumlah,
                ]);
            } else {
                $path = Kamar::where('id', $id)->first();
                File::delete(public_path('images/' . $path->name_img));
                Kamar::findOrFail($id)->update([
                    'tipe_kamar' => $request->tipe_kamar,
                    'jumlah' => $request->jumlah,
                    'image' => $request->image->move(public_path('images'), $request->file('image')->getClientOriginalName()),
                    'name_img' => $request->file('image')->getClientOriginalName(),
                ]);
            }

            return back()->with(['success' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Kamar::where('id', $id)->first();
        File::delete(public_path('images/' . $image->name_img));
        Kamar::findOrFail($id)->delete();
        return back()->with(['success' => 'Data berhasil dihapus!']);
    }
}
