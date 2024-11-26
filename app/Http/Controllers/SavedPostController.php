<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedPost;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SavedPostController extends Controller
{
    public function toggleSave(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        try {
            $uploadId = $request->input('id_post');
            $userId = Auth::id();

            $savedPost = SavedPost::where('id_user', $userId)
                                ->where('id_post', $uploadId)
                                ->first();

            if ($savedPost) {
                $savedPost->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Postingan batal disimpan',
                    'is_saved' => false
                ]);
            }

            SavedPost::create([
                'id_user' => $userId,
                'id_post' => $uploadId
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Postingan berhasil disimpan',
                'is_saved' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkSaved($uploadId)
    {
        if (!Auth::check()) {
            return response()->json(['is_saved' => false]);
        }

        $isSaved = SavedPost::where('id_user', Auth::id())
                           ->where('id_post', $uploadId)
                           ->exists();

        return response()->json(['is_saved' => $isSaved]);
    }
}
