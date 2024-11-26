<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Upload;
use App\Models\User;
use App\Models\SavedPost;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
            'judul_post' => 'nullable|string|max:255',
            'desk_post' => 'nullable|string',
        ]);

        // Pastikan user sudah login
        if (!Auth::check()) {
            return response()->json([
                'success' => false, 
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            // Generate nama file unik
            $originalName = $request->file('image')->getClientOriginalName();
            $filename = time() . '_' . $originalName;

            // Simpan file ke storage/app/public/uploads
            $filePath = $request->file('image')->storeAs('uploads', $filename, 'public');

            // Simpan data ke database
            $upload = new Upload();
            $upload->id_user = Auth::id();
            $upload->file_post = $filePath;
            $upload->judul_post = $request->input('judul_post');
            $upload->desk_post = $request->input('desk_post');
            $upload->save();

            // URL gambar untuk ditampilkan
            $imageUrl = Storage::url($filePath);

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diupload!',
                'image_url' => $imageUrl,
                'post_id' => $upload->id
            ]);
        }

        return response()->json([
            'success' => false, 
            'message' => 'Gagal mengupload gambar'
        ], 400);

        return redirect()->route('home');
    }

    // Pastikan user sudah login sebelum menghapus
    // Tambahkan pengecekan di controller
    public function destroy($uploadId)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return response()->json([
                'success' => false, 
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        // Cek apakah post milik user yang sedang login
        $post = Upload::findOrFail($uploadId);
        if ($post->id_user !== Auth::id()) {
            return response()->json([
                'success' => false, 
                'message' => 'Anda tidak memiliki izin menghapus postingan ini'
            ], 403);
        }
        SavedPost::where('id_post', $uploadId)->delete();
        $post->delete();
        
        return response()->json([
            'success' => true, 
            'message' => 'Postingan berhasil dihapus'
        ]);
    }

    public function preview(Request $request) {
        // Ambil parameter dari URL
        $title = $request->query('title');
        $description = $request->query('description');
        $image = $request->query('image');


        // Ambil data upload berdasarkan judul
        $upload = Upload::where('judul_post', $title)->first(); // Mengambil upload berdasarkan judul

        if ($upload) {

            // Kirim data ke view
            return view('preview', [
                'title' => $title,
                'description' => $description,
                'image' => $image,
                'id_post' => $upload->id,
                'post_user_id' => $upload->id_user,  // Tambahkan ID user pemilik post
                'current_user_id' => Auth::id()  // Tambahkan ID user yang sedang login
            ]);

        }

        // Redirect jika data tidak ditemukan
        return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
    }

    public function getPostOwner($id_post)
    {
        $post = Upload::find($id_post);
        $user = User::find($post->id_user);
        
        return response()->json([
            'username' => $user->username,
            'profile_photo' => $user->profile_photo
        ]);
    }    
}