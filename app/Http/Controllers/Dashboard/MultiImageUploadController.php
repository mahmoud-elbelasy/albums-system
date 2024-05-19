<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultiImageUploadController extends Controller
{
    public function upload(Album $album)
    {
        // $album = Album::find($album_id);
        return view('dashboard.multiupload',['album' => $album]);
    }

    public function store(Request $request,Album $album)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:12000',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename, 'public');

            ImageUpload::create([
                'name' => $filename,
                'path' => '/storage/' . $filePath,
                'album_id' => $album->id,
            ]);

            return response()->json(['success' => 'Image uploaded successfully.']);
        }

        return response()->json(['error' => 'File not uploaded.'], 400);
    }

    public function destroy($id)
    {
        $image = ImageUpload::findOrFail($id);
        $path = str_replace('/storage', 'public', $image->path);
        Storage::delete($path);
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function showMoveForm($id)
    {
        $image = ImageUpload::findOrFail($id);
        $albums = Album::all(); 

        return view('dashboard.move', compact('image', 'albums'));
    }

    public function move(Request $request, $id)
    {
        $image = ImageUpload::findOrFail($id);
        $image->album_id = $request->album_id; 
        $image->save();

        return redirect()->route('albums.show', $image->album_id)->with('success', 'Image moved successfully');
    }
}
