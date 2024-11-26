<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\upload;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap kata kunci dari input pencarian
        $keyword = $request->input('search');

        // Jika ada kata kunci, filter berdasarkan judul_post atau desk_post
        if ($keyword) {
            $uploads = Upload::where('judul_post', 'LIKE', "%$keyword%")
                ->orWhere('desk_post', 'LIKE', "%$keyword%")
                ->get();
        } else {
            // Jika tidak ada kata kunci, ambil semua data
            $uploads = Upload::all();
        }

        // Kirim data ke tampilan beranda
        return view('tampilan', compact('uploads', 'keyword'));
    }
}

