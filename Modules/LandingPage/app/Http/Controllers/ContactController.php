<?php

namespace Modules\LandingPage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('landingpage::crud-page.contact.index');
    }
   public function getList(Request $request)
    {
        $total = Contact::count();
        $length = intval($request->input('length', 10));
        $start = intval($request->input('start', 0));
        $draw = intval($request->input('draw', 1));
        $search = $request->input('search.value');

        $query = Contact::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('city', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        $filteredCount = $query->count();

        $contacts = $query->latest()->skip($start)->take($length)->get();

        $data = [];
        $no = $start + 1;
        foreach ($contacts as $val) {
            $data[] = [
                $no++,
                $val->city,
                $val->address,
                $val->no_hp,
                $val->open_hours,
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
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($contact);
    }

    public function save(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $contact = new Contact();
        $contact->city = $request->city;
        $contact->address = $request->address;
        $contact->no_hp = $request->no_hp;
        $contact->open_hours = $request->open_hours;
        $contact->email = $request->email;

        // Menangani dan memodifikasi iframe gmaps untuk width dan height 100%
        $gmaps = $request->gmaps;

        if ($gmaps) {
            // Mengubah width dan height iframe menjadi 100%
            $gmaps = preg_replace('/(<iframe[^>]+)(width="[^"]+")/i', '$1 width="100%"', $gmaps);
            $gmaps = preg_replace('/(<iframe[^>]+)(height="[^"]+")/i', '$1 height="100%"', $gmaps);
        }

        $contact->gmaps = $gmaps;
        $contact->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:contact,id',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $contact = Contact::findOrFail($request->id);
        $contact->address = $request->address;
        $contact->no_hp = $request->no_hp;
        $contact->open_hours = $request->open_hours;
        $contact->email = $request->email;
        $contact->city = $request->city;

        // Menangani dan memodifikasi iframe gmaps untuk width dan height 100%
        $gmaps = $request->gmaps;

        if ($gmaps) {
            // Mengubah width dan height iframe menjadi 100%
            $gmaps = preg_replace('/(<iframe[^>]+)(width="[^"]+")/i', '$1 width="100%"', $gmaps);
            $gmaps = preg_replace('/(<iframe[^>]+)(height="[^"]+")/i', '$1 height="100%"', $gmaps);
        }

        $contact->gmaps = $gmaps;
        $contact->save();

        return response()->json(['success' => true]);
    }


    public function delete($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return response()->json(['success' => true]);
    }
}