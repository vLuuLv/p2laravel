<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKamar;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use File;

class FasilitasKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fasilitas = FasilitasKamar::all();
        $kamar = Kamar::all();
        return view('admin.fasilitas_kamar', [
            "title" => "Fasilitas Kamar | Hotel.LuuL"
        ], compact('fasilitas', 'kamar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'kamar_id' => 'required',
            'fasilitas' => 'required',
            'image' => 'required | mimes:jpg,png,jpeg,gif,svg | max:10000',
        ], [
            'kamar_id.required' => 'Tipe kamar tidak boleh kosong!',
            'fasilitas.required' => 'Fasilitas kamar tidak boleh kosong!',
            'image.required' => 'Gambar tidak boleh kosong!',
            'image.mimes' => 'Gambar harus berformat jpg,png,jpeg,gif,svg!',
            'image.max' => 'Gambar tidak boleh melebihi 10mb!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            DB::transaction(function () use ($request) {

                FasilitasKamar::create([
                    'kamar_id' => $request->kamar_id,
                    'fasilitas' => $request->fasilitas,
                    'image' => $request->image->move(public_path('images/fasilitas'), $request->file('image')->getClientOriginalName()),
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
     * @param  \App\Models\FasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kamar_id' => 'required',
            'fasilitas' => 'required',
        ], [
            'kamar_id.required' => 'Tipe kamar tidak boleh kosong!',
            'fasilitas.required' => 'Fasilitas kamar tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            if (!$request->image) {
                FasilitasKamar::findOrFail($id)->update([
                    'kamar_id' => $request->kamar_id,
                    'fasilitas' => $request->fasilitas,
                ]);
            } else {
                $path = FasilitasKamar::where('id', $id)->first();
                File::delete(public_path('images/fasilitas/' . $path->name_img));
                FasilitasKamar::findOrFail($id)->update([
                    'kamar_id' => $request->kamar_id,
                    'fasilitas' => $request->fasilitas,
                    'image' => $request->image->move(public_path('images/fasilitas'), $request->file('image')->getClientOriginalName()),
                    'name_img' => $request->file('image')->getClientOriginalName(),
                ]);
            }


            return back()->with(['success' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FasilitasKamar  $fasilitasKamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = FasilitasKamar::where('id', $id)->first();
        File::delete(public_path('images/fasilitas/' . $image->name_img));
        FasilitasKamar::findOrFail($id)->delete();
        return back()->with(['success' => 'Data berhasil dihapus!']);
    }
}
