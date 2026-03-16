<?php

namespace Modules\LandingPage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CompanyProfileController extends Controller
{
   public function index()
    {
        $company = DB::table('company_profiles')->first();
        return view("landingpage::crud-page.company-profile.index", [
            'company' => $company
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',

        ]);

       $profile = DB::table('company_profiles')->first();

if (!$profile) {
    return response()->json([
        'status' => false,
        'errors' => ['message' => 'Contact data not found']
    ], 404);
}

DB::table('company_profiles')
    ->where('id', $profile->id)
    ->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'open_hours' => $request->input('open_hours'),
        'address' => $request->input('address'),
        'facebook' => $request->input('facebook'),
        'instagram' => $request->input('instagram'),
        'linkedin' => $request->input('linkedin'),
        'phone' => $request->input('phone'),
        'email' => $request->input('email'),
        'gmaps' => $request->input('gmaps'),
        'updated_at' => now(),
    ]);


        return response()->json(['status' => true]);
    }


    public function getEdit()
    {
        // dd('masuk');
        // Mengambil data bisnis berdasarkan ID
        $profild = DB::table('company_profiles')->first();

        // Memeriksa apakah bisnis ada
        if ($profild) {
            // Mengembalikan respons JSON dengan detail bisnis
            return response()->json($profild);
        } else {
            // Mengembalikan respons JSON dengan pesan kesalahan
            return response()->json(['error' => 'about not found.'], 404);
        }
    }


    public function upload(Request $request)
    {
        // dd($request);
        try {
            $profile = DB::table('company_profiles')->first();

            if (!$profile) {
                return response()->json(['status' => false, 'errors' => ['message' => 'Contact data not found']], 404);
            }

            $fileName = $profile->default_photo;
            if ($default_photo = $request->file('default_photo')) {
                $request->validate([
                    'default_photo' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if ($profile->default_photo && file_exists(
                    public_path('gallery/' . $profile->default_photo)
                )) {
                    unlink(
                        public_path('gallery/' . $profile->default_photo)
                    );
                }

                $fileName = 'default.' . $default_photo->getClientOriginalExtension();
                $default_photo->move(public_path('gallery'), $fileName);
                $profile->default_photo = $fileName;
            }
            // Update data gallery
            $profile->update([
                'default_photo' => $fileName,
            ]);
            return response()->json(['status' => true, 'data' => $profile]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}