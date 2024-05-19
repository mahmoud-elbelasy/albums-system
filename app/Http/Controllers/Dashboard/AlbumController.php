<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use App\Repositories\Classes\AlbumRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    protected AlbumRepository $albumRepository;
    public function __construct(AlbumRepository $albumRepository) {
        $this->albumRepository = $albumRepository;
    }
    public function index(Request $request)
    {
        $albums = $this->albumRepository->findBy($request);
       
        if ($request->ajax()) {
            return response()->json($albums);
        }
        return view('dashboard.albums.index',['albums' => $albums]);
    }

    public function show(Album $album)
    {
        $images = $album->images;
        return view('dashboard.albums.show',['images' => $images,'album' => $album]);
    }

    public function create()
    {
        
        return view('dashboard.albums.create');
    }

    public function store(AlbumRequest $request)
    {
       
        $this->albumRepository->store($request->validated());
        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    public function edit(string $id)
    {
       
        $album = $this->albumRepository->show($id);
        return view('dashboard.albums.edit',['album' => $album]);
    }

    public function update(AlbumRequest $request, String $id)
    {
       
        $this->albumRepository->update($request->validated(), $id);
        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    

    public function destroy(string $id)
    {
        $album = $this->albumRepository->find($id);
        $images = $album->images;
        $this->albumRepository->delete($id);
        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
    }

    public function deleteImagesInAlbum(Request $request, $albumId)
{
    $album = Album::findOrFail($albumId);
    $images = $album->images;

    foreach ($images as $image) {
        
        $path = str_replace('/storage', 'public', $image->path);
        Storage::delete($path);
        
        $image->delete();
    }

    return redirect()->back()->with('success', 'All images in the album have been deleted successfully');
}
}
