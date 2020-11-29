<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function store(Request $request)
    {
        $params = $request->validate([
            'image' => 'required|file|image|max:4000',
        ]);

        $file = $params['image'];
        $fileContents = file_get_contents($file->getRealPath());

        $disk = Storage::disk('s3');
        $disk->put($file->hashName(),$fileContents);

        return redirect()->action('ImagesController@index');
    }

    public function show($filename)
    {
        $disk = Storage::disk('s3');
        try {
            $contents = $disk->get($filename);
            $mimeType = $disk->mimeType($filename);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()],404);
        }
        return response($contents)->header('Content-Type',$mimeType);
    }

    public function index()
    {
        $disk = Storage::disk('s3');
        $files = $disk->files('/');
        return view('images.index2',['files' => $files]);
    }
    
    public function destroy($filename)
    {
    $disk = Storage::disk('s3');
    $disk->delete($filename);
    return redirect()->action('ImagesController@index');
    }
}
