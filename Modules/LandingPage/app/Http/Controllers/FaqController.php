<?php

namespace Modules\LandingPage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
 
        return view('landingpage::crud-page.faq.index' );
    }
public function getList(Request $request)
    {
        $total = Faq::count();
        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));
        $draw = intval($request->input('draw', 1));
        $search = $request->input('search.value');

        $query = Faq::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $filteredCount = $query->count();

        $faqs = $query->latest()->skip($start)->take($length)->get();

        $data = [];
        $no = $start + 1;
        foreach ($faqs as $val) {
            $data[] = [
                $no++,
                $val->title,
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
        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($faq);
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Buat slug dari title (menggunakan helper Str::slug)
        $title = $request->title;

        $faq = new Faq();
        $faq->title = $title;
        $faq->description = $request->description;

        $faq->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:faqs,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Buat slug dari title (menggunakan helper Str::slug)
        $title = $request->title;

        $faq = Faq::findOrFail($request->id);
        $faq->title = $title;
        $faq->description = $request->description;
        $faq->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $faq = Faq::findOrFail($id);

        $faq->delete();

        return response()->json(['success' => true]);
    }
}