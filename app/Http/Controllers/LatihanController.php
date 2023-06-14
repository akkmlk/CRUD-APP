<?php

namespace App\Http\Controllers;


use App\Models\Latihan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $latihans = Latihan::latest()->paginate(10);
        return view('latihan.index', compact('latihans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('latihan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $image = $request->file('image');
        $image->storeAs('public/latihans', $image->hashName());

        $latihan = Latihan::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image->hashName()
        ]);

        if ($latihan) {
            return redirect()->route('latihan.index')->with(['succes' => "Data Berhasil Disimpan!"]);
        } else {
            return redirect()->route('latihan.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Latihan $latihan)
    {
        //
        return view('latihan.edit',  compact('latihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Latihan $latihan)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required|max:255'
        ]);

        $latihan = Latihan::findOrFail($latihan->id);

        if ($request->file('image') == "") {
            $latihan->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
        } else {
            storage::disk('local')->delete('public/latihans/'.$latihan->image);

            $image = $request->file('image');
            $image->storeAs('public/latihans', $image->hashName());

            $latihan->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'content' => $request->content
            ]);
        }

        if ($latihan) {
            return redirect()->route('latihan.index')->with(['Succes' => 'Data Berhasil Di Update!']);
        } else {
            return redirect()->route('latihan.index')->with(['Error' => 'Data Gagal Di Update!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $latihan = Latihan::findOrFail($id);
        Storage::disk('local')->delete('public/latihans/'.$latihan->image);
        $latihan->delete();

        if($latihan) {
            return redirect()->route('latihan.index')->with(['Succes' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('latihan.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
