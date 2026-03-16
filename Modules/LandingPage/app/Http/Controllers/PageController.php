<?php

namespace Modules\LandingPage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
      
        return view('landingpage::crud-page.page.index' );
    }

     public function getList(Request $request)
    {
        $total = Page::count();
        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));
        $draw = intval($request->input('draw', 1));
        $search = $request->input('search.value');

        $query = Page::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('meta_title', 'like', '%' . $search . '%')
                    ->orWhere('meta_desc', 'like', '%' . $search . '%');
            });
        }

        $filteredCount = $query->count();

        $pages = $query->latest()->skip($start)->take($length)->get();

        $data = [];
        $no = $start + 1;
        foreach ($pages as $val) {
            $data[] = [
                $no++,
                '<img src="' . asset('gallery/' . $val->banner) . '" height="80">',
                $val->title,
                $val->meta_title,
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
        $page = Page::find($id);
        if (!$page) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $page->banner = asset('gallery/' . $page->banner);
        return response()->json($page);
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Buat slug dari title (menggunakan helper Str::slug)
        $title = $request->title;
        $slug = Str::slug($title);

        // Periksa apakah slug sudah ada di database
        $originalSlug = $slug;
        $count = 1;
        while (Page::where('slug', $slug)->exists()) {
            // Jika slug sudah ada, tambahkan angka di akhir slug untuk membuatnya unik
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $page = new Page();
        $page->title = $title;
        $page->meta_title = $request->meta_title;
        $page->meta_desc = $request->meta_desc;
        $page->slug = $slug;


//dd($request->all());

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = $file->getClientOriginalName();
            
            

            // Mengganti spasi dengan tanda -
            $filename = str_replace(' ', '-', $filename);


            $file->move(public_path('gallery'), $filename);

            $page->banner = $filename;
        }

        $page->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pages,id',
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Buat slug dari title (menggunakan helper Str::slug)
        $title = $request->title;
        $slug = Str::slug($title);

        // Periksa apakah slug sudah ada di database
        $originalSlug = $slug;
        $count = 1;
        while (Page::where('slug', $slug)->exists()) {
            // Jika slug sudah ada, tambahkan angka di akhir slug untuk membuatnya unik
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $page = Page::findOrFail($request->id);
        $page->title = $title;
        $page->meta_title = $request->meta_title;
        $page->meta_desc = $request->meta_desc;
        $page->slug = $slug;

        if ($request->hasFile('banner')) {
            // Hapus file lama jika ada
            $oldPath = public_path('gallery/' . $page->banner);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '-', $filename);
            $file->move(public_path('gallery'), $filename);

            $page->banner = $filename;
        }

        $page->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $page = Page::findOrFail($id);

        // Hapus file banner jika ada
        if ($page->banner && File::exists(public_path('gallery/' . $page->banner))) {
            File::delete(public_path('gallery/' . $page->banner));
        }

        $page->delete();

        return response()->json(['success' => true]);
    }

}