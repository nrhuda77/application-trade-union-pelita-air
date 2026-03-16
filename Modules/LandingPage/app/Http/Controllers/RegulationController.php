<?php

namespace Modules\LandingPage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Regulation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RegulationController extends Controller
{
    public function index()
    {
 
        return view('landingpage::crud-page.regulation.index');
    }

     public function getList(Request $request)
    {
        $total = Regulation::count();
        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));
        $draw = intval($request->input('draw', 1));
        $search = $request->input('search.value');

        $query = Regulation::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $filteredCount = $query->count();

        $regulations = $query->latest()->skip($start)->take($length)->get();

        $data = [];
        $no = $start + 1;
        foreach ($regulations as $val) {
            $data[] = [
                $no++,
                '<button class="btn btn-sm btn-success" onclick="viewPdf(' . $val->id . ')">Lihat PDF</button>',
                $val->title,
                $val->category,
                $val->description,
                '<div class="btn-group">
                    <button class="btn btn-sm btn-info" onclick="detail(' . $val->id . ')">Detail</button>
                    <button class="btn btn-sm btn-warning" onclick="edit(' . $val->id . ')">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="hapus(' . $val->id . ')">Hapus</button>
                </div>'
            ];
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ]);
    }

    public function getEdit($id)
    {
        $regulation = Regulation::find($id);
        if (!$regulation) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $regulation->file = asset('gallery/' . $regulation->file);
        return response()->json($regulation);
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:pdf'
        ]);

        // Buat slug dari title (menggunakan helper Str::slug)
        $title = $request->title;
        $regulation = new Regulation();
        $regulation->title = $title;
        $regulation->category = $request->category;
        $regulation->description = $request->description;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            // Mengganti spasi dengan tanda -
            $filename = str_replace(' ', '-', $filename);

            $file->move(public_path('gallery'), $filename);

            $regulation->file = $filename;
        }

        $regulation->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:regulations,id',
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:pdf'
        ]);

        // Buat slug dari title (menggunakan helper Str::slug)
        $title = $request->title;


        $regulation = Regulation::findOrFail($request->id);
        $regulation->title = $title;
        $regulation->category = $request->category;
        $regulation->description = $request->description;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            $oldPath = public_path('gallery/' . $regulation->file);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            // Mengganti spasi dengan tanda -
            $filename = str_replace(' ', '-', $filename);

            $file->move(public_path('gallery'), $filename);

            $regulation->file = $filename;
        }

        $regulation->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $regulation = Regulation::findOrFail($id);

        // Hapus file file jika ada
        if ($regulation->file && File::exists(public_path('gallery/' . $regulation->file))) {
            File::delete(public_path('gallery/' . $regulation->file));
        }

        $regulation->delete();

        return response()->json(['success' => true]);
    }

}