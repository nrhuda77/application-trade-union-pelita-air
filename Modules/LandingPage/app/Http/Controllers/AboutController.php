<?php

namespace Modules\LandingPage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class AboutController extends Controller
{
    public function index()
    {
        return view('landingpage::crud-page.about.index');
    }
    
 public function getList(Request $request)
    {
        $total = About::count();
        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));
        $draw = intval($request->input('draw', 1));
        $search = $request->input('search.value');

        $query = About::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $filteredCount = $query->count();

        $pages = $query->latest()->skip($start)->take($length)->get();

        $data = [];
        $no = $start + 1;
        foreach ($pages as $val) {
            $data[] = [
                $no++,
                '<img src="' . asset('gallery/' . $val->photo) . '" height="80">',
                $val->title,
                // $val->description,
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
        $about = About::find($id);
        if (!$about) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        if (!empty($about->photo)) {
            $about->photo = asset('gallery/' . $about->photo);
        }
        if (!empty($about->pdf)) {
            $about->pdf = asset('gallery/' . $about->pdf);
        }
        return response()->json($about);
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:2048'
        ]);

        // Buat slug dari title (menggunakan helper Str::slug)
        $title = $request->title;
        $slug = Str::slug($title);

        // Periksa apakah slug sudah ada di database
        $originalSlug = $slug;
        $count = 1;
        while (About::where('slug', $slug)->exists()) {
            // Jika slug sudah ada, tambahkan angka di akhir slug untuk membuatnya unik
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $about =  new About();
        $about->title = $title;
        $about->description = $request->description;
        $about->slug = $slug;


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();

            // Mengganti spasi dengan tanda -
            $filename = str_replace(' ', '-', $filename);

            $file->move(public_path('gallery'), $filename);

            $about->photo = $filename;
        }

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $filename = $file->getClientOriginalName();

            // Mengganti spasi dengan tanda -
            $filename = str_replace(' ', '-', $filename);

            $file->move(public_path('gallery'), $filename);

            $about->pdf = $filename;
        }

        $about->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            // 'id' => 'required|exists:pages,id',
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Buat slug dari title (menggunakan helper Str::slug)
        $title = $request->title;
        $slug = Str::slug($title);

        // Periksa apakah slug sudah ada di database
        $originalSlug = $slug;
        $count = 1;
        while (About::where('slug', $slug)->exists()) {
            // Jika slug sudah ada, tambahkan angka di akhir slug untuk membuatnya unik
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $about = About::findOrFail($request->id);
        $about->title = $title;
        $about->description = $request->description;
        $about->slug = $slug;


        if ($request->hasFile('photo')) {
            // Hapus file lama jika ada
            $oldPath = public_path('gallery/' . $about->photo);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '-', $filename);

            $file->move(public_path('gallery'), $filename);

            $about->photo = $filename;
        }

        if ($request->hasFile('pdf')) {
            // Hapus file lama jika ada
            $oldPath = public_path('gallery/' . $about->pdf);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('pdf');
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '-', $filename);
            $file->move(public_path('gallery'), $filename);

            $about->pdf = $filename;
        }

        $about->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $about = About::findOrFail($id);

        // Hapus file photo jika ada
        if ($about->photo && File::exists(public_path('gallery/' . $about->photo))) {
            File::delete(public_path('gallery/' . $about->photo));
        }
        // Hapus file pdf jika ada
        if ($about->pdf && File::exists(public_path('gallery/' . $about->pdf))) {
            File::delete(public_path('gallery/' . $about->pdf));
        }

        $about->delete();

        return response()->json(['success' => true]);
    }
}