<?php

namespace App\Http\Controllers;

use App\Models\OrgUnit;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoController extends Controller
{
  protected $folder;

  public function index()
  {
    $videos = Video::paginate(8);

    return view('videos.index', compact('videos'));
  }

  public function show($slug)
  {
    $video = Video::where('slug', $slug)->first();
    $videoUrl = $video->trailer;

    return view('videos.show', compact('video', 'videoUrl'));
  }

  public function getVideo($slug, $filename)
  {
    $this->folder = $slug;

    return FFMpeg::dynamicHLSPlaylist('uploads')
      ->fromDisk('uploads')
      ->open("{$this->folder}/videos/{$filename}")
      ->setKeyUrlResolver(function ($key) {
        return route('video.key', ['folder' => $this->folder, 'key' => $key]);
      })
      ->setMediaUrlResolver(function ($filename) {
        return route('video.file', ['folder' => $this->folder, 'file' => $filename]);
      })
      ->setPlaylistUrlResolver(function ($filename) {
        return route('video.playlist', ['folder' => $this->folder, 'file' => $filename]);
      });
  }

  public function getKey($folder, $key)
  {
    return Storage::disk('uploads')->download("{$folder}/secrets/{$key}");
  }

  public function getFile($folder, $file)
  {
    return Storage::disk('uploads')->download("{$folder}/videos/{$file}");
  }

  public function crypt()
  {
    $payload = json_encode('secret');
    $crypt = Crypt::encryptString($payload);
    $cryptDecode = Crypt::decryptString($crypt);
    dd($crypt, $cryptDecode);
  }

  public function tree()
  {
    $tree = OrgUnit::whereNull('parent_id')
      ->with('children.children.children')
      ->get();

    return view('tree', compact('tree'));
  }
  public function tree2()
  {

    return view('tree2');
  }
}
