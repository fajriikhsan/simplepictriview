<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Upload;
use App\Models\User;
use App\Models\SavedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function showProfile() {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function show()
    {
        $user = Auth::user();
        
        // Ambil data postingan pengguna saat ini
        $uploads = Upload::where('id_user', Auth::id())
            ->select('id_post', 'judul_post', 'desk_post', 'file_post')
            ->get();

        // Ambil postingan yang disimpan oleh pengguna
        $savedPosts = SavedPost::where('id_user', Auth::id())
            ->with(['upload:id_post,judul_post,desk_post,file_post'])
            ->get();
 
        return view('profile', [
            'user' => $user,
            'uploads' => $uploads,
            'savedPosts' => $savedPosts,
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000'
        ]);

        $user = auth()->user();

        // Hapus foto profil lama jika ada
        if ($user->profile_photo && Storage::exists('public/profile_photos/' . $user->profile_photo)) {
            Storage::delete('public/profile_photos/' . $user->profile_photo);
        }

        // Simpan foto baru
        $photoPath = $request->file('profile_photo')->store('public/profile_photos');
        $photoName = basename($photoPath);

        // Update user dengan path foto baru
        $user->profile_photo = $photoName;
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui');
    }
}
