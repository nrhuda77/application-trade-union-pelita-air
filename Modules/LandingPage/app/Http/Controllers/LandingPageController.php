<?php

namespace Modules\LandingPage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $data['faq'] = DB::table('faqs')->get();
        $data['contacts'] = DB::table('contact')->get();
        $regulations = DB::table('regulations')->get()->groupBy('category'); // Mengelompokkan berdasarkan kategori
        // Pastikan setiap kategori ada dalam array
        $data['regulations'] = [
            'undang-undang' => $regulations['undang-undang'] ?? [],
            'pemerintah' => $regulations['pemerintah'] ?? [],
            'menteri' => $regulations['menteri'] ?? [],
        ];

        $data['organizations'] = DB::table('organizations')->get();
        $data['company'] = DB::table('company_profiles')->first();

        // Modifikasi gmaps di controller sebelum ditampilkan
        if ($data['company']->gmaps) {
            $data['company']->gmaps = preg_replace('/(<iframe[^>]+)(width="[^"]+")/i', '$1 width="100%"', $data['company']->gmaps);
            $data['company']->gmaps = preg_replace('/(<iframe[^>]+)(height="[^"]+")/i', '$1 height="100%"', $data['company']->gmaps); // Perbaiki kesalahan $$ menjadi $
        }

        $data['events'] = DB::table('pengumuman')->get();

        return view("landingpage::index", $data);
    }

       public function event()
    {
        return view("landingpage::event");
    }
    public function about()
    {
        $data['about'] = DB::table('about')->get();
        return view("landingpage::about", $data);
    }
    public function unit()
    {
        $data['units'] = DB::table('organizations')->get();
        return view("landingpage::organization", $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('landingpage::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('landingpage::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('landingpage::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}