<?php

namespace App\Http\Controllers;

use App\Models\FasilitasHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use File;

class FasilitasHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fasilitas = FasilitasHotel::all();
        return view('admin.fasilitas_hotel', [
            "title" => "Fasilitas Hotel | Hotel.LuuL"
        ], compact('fasilitas'));
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
            'fasilitas' => 'required',
            'keterangan' => 'required',
            'image' => 'required | mimes:jpg,png,jpeg,gif,svg | max:10000',
        ], [
            'fasilitas.required' => 'Fasilitas kamar tidak boleh kosong!',
            'keterangan.required' => 'Keterangan tidak boleh kosong!',
            'image.required' => 'Gambar tidak boleh kosong!',
            'image.mimes' => 'Gambar harus berformat jpg,png,jpeg,gif,svg!',
            'image.max' => 'Gambar tidak boleh melebihi 10mb!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            DB::transaction(function () use ($request) {

                FasilitasHotel::create([
                    'fasilitas' => $request->fasilitas,
                    'keterangan' => $request->keterangan,
                    'image' => $request->image->move(public_path('images/fasilitas-hotel'), $request->file('image')->getClientOriginalName()),
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
     * @param  \App\Models\FasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fasilitas' => 'required',
            'keterangan' => 'required',
        ], [
            'fasilitas.required' => 'Fasilitas kamar tidak boleh kosong!',
            'keterangan.required' => 'Keterangan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            if (!$request->image) {
                FasilitasHotel::findOrFail($id)->update([
                    'fasilitas' => $request->fasilitas,
                    'keterangan' => $request->keterangan,
                ]);
            } else {
                $path = FasilitasHotel::where('id', $id)->first();
                File::delete(public_path('images/fasilitas-hotel/' . $path->name_img));
                FasilitasHotel::findOrFail($id)->update([
                    'fasilitas' => $request->fasilitas,
                    'keterangan' => $request->keterangan,
                    'image' => $request->image->move(public_path('images/fasilitas-hotel'), $request->file('image')->getClientOriginalName()),
                    'name_img' => $request->file('image')->getClientOriginalName(),
                ]);
            }


            return back()->with(['success' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FasilitasHotel  $fasilitasHotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = FasilitasHotel::where('id', $id)->first();
        File::delete(public_path('images/fasilitas-hotel/' . $image->name_img));
        FasilitasHotel::findOrFail($id)->delete();
        return back()->with(['success' => 'Data berhasil dihapus!']);
    }
}
