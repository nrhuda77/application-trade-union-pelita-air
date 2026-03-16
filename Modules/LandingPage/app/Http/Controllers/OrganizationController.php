<?php

namespace Modules\LandingPage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class OrganizationController extends Controller
{
    public function index()
    {
  
        return view('landingpage::crud-page.organization.index' );
    }
 public function getList(Request $request)
    {
        $total = Organization::count();
        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));
        $draw = intval($request->input('draw', 1));
        $search = $request->input('search.value');

        $query = Organization::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('unit_name', 'like', '%' . $search . '%')
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
                '<img src="' . asset('gallery/' . $val->banner) . '" height="80">',
                '<img src="' . asset('gallery/' . $val->structure_image) . '" height="80">',
                $val->unit_name,
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
        $organization = Organization::find($id);
        if (!$organization) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $organization->banner = asset('gallery/' . $organization->banner);
        $organization->Structure_image = asset('gallery/' . $organization->Structure_image);
        return response()->json($organization);
    }

    public function save(Request $request)
    {
        $request->validate([
            'unit_name' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'structure_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Buat slug dari unit_name (menggunakan helper Str::slug)
        $unit_name = $request->unit_name;
        $slug = Str::slug($unit_name);

        // Periksa apakah slug sudah ada di database
        $originalSlug = $slug;
        $count = 1;
        while (Organization::where('slug', $slug)->exists()) {
            // Jika slug sudah ada, tambahkan angka di akhir slug untuk membuatnya unik
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $organization = new Organization();
        $organization->unit_name = $unit_name;
        $organization->description = $request->description;
        $organization->slug = $slug;


        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = $file->getClientOriginalName();

            // Mengganti spasi dengan tanda -
            $filename = str_replace(' ', '-', $filename);

            $file->move(public_path('gallery'), $filename);

            $organization->banner = $filename;
        }

        if ($request->hasFile('structure_image')) {
            $file = $request->file('structure_image');
            $filename = $file->getClientOriginalName();

            // Mengganti spasi dengan tanda -
            $filename = str_replace(' ', '-', $filename);

            $file->move(public_path('gallery'), $filename);

            $organization->structure_image = $filename;
        }

        $organization->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            // 'id' => 'required|exists:pages,id',
            'unit_name' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'structure_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Buat slug dari unit_name (menggunakan helper Str::slug)
        $unit_name = $request->unit_name;
        $slug = Str::slug($unit_name);

        // Periksa apakah slug sudah ada di database
        $originalSlug = $slug;
        $count = 1;
        while (Organization::where('slug', $slug)->exists()) {
            // Jika slug sudah ada, tambahkan angka di akhir slug untuk membuatnya unik
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $organization = Organization::findOrFail($request->id);
        $organization->unit_name = $unit_name;
        $organization->description = $request->description;
        $organization->slug = $slug;

        if ($request->hasFile('banner')) {
            // Hapus file lama jika ada
            $oldPath = public_path('gallery/' . $organization->banner);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('banner');
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '-', $filename);

            $file->move(public_path('gallery'), $filename);

            $organization->banner = $filename;
        }

        if ($request->hasFile('structure_image')) {
            // Hapus file lama jika ada
            $oldPath = public_path('gallery/' . $organization->structure_image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('structure_image');
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '-', $filename);
            $file->move(public_path('gallery'), $filename);

            $organization->structure_image = $filename;
        }

        $organization->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $organization = Organization::findOrFail($id);

        // Hapus file banner jika ada
        if ($organization->banner && File::exists(public_path('gallery/' . $organization->banner))) {
            File::delete(public_path('gallery/' . $organization->banner));
        }
        // Hapus file structure_image jika ada
        if ($organization->structure_image && File::exists(public_path('gallery/' . $organization->structure_image))) {
            File::delete(public_path('gallery/' . $organization->structure_image));
        }

        $organization->delete();

        return response()->json(['success' => true]);
    }
}