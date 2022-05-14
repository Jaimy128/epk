<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Band;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BandController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except("index", "show");
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if (isset($keyword) && strlen($keyword) > 0) {
            $bands = Band::searchBand($keyword);
        } else {
            $bands = Band::all();
        }

        return view("bands.index", compact('bands'));
    }

    public function create()
    {
        return view("bands.create");
    }

    public function store(Request $request)
    {
        $band = new Band();
        $band->name = $request->name;
        $band->description = $request->description;
        $band->biography = $request->biography;
        $band->background_color = $request->background_color;
        $band->text_color = $request->text_color;
        $band->youtube_1 = $request->youtube_1;
        $band->youtube_2 = $request->youtube_2;
        $band->youtube_3 = $request->youtube_3;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('images/', $filename);
            $band->image = $filename;
        } else {
            $band->image = 'band-no-img.jpg';
        }

        $request->validate([
            'name' => 'required',
            'background_color' => ['regex:/^#[0-9A-z]{6}$/', 'nullable'],
            'text_color' => ['regex:/^#[0-9A-z]{6}$/', 'nullable'],
            'youtube_1' => ['url', 'nullable'],
            'youtube_2' => ['url', 'nullable'],
            'youtube_3' => ['url', 'nullable'],
        ]);

        $band->save();

        $band->users()->attach(auth()->user()->id, ['is_owner' => true]);

        return redirect()->route('home')->with('success', 'Band was successfully saved.');
    }

    public function show(Band $band)
    {
        $youtubeEmbedLinks = [];

        for ($i = 1; $i <= 3; $i++) {
            $key = "youtube_" . $i;
            if (isset($band->$key) && strlen($band->$key) > 0) {
                $link = $this->getYoutubeEmbedUrl($band->$key);
                if ($link !== false) {
                    array_push($youtubeEmbedLinks, $link);
                }
            }
        }

        $band->youtubeEmbedLinks = $youtubeEmbedLinks;

        return view('bands.show', compact('band'));
    }

    public function edit(Band $band)
    {
        return view('bands.edit', compact('band'));
    }

    public function update(Request $request, Band $band)
    {
        $band->name = $request->name;
        $band->description = $request->description;
        $band->biography = $request->biography;
        $band->background_color = $request->background_color;
        $band->text_color = $request->text_color;
        $band->youtube_1 = $request->youtube_1;
        $band->youtube_2 = $request->youtube_2;
        $band->youtube_3 = $request->youtube_3;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('images/', $filename);
            $band->image = $filename;
        }

        $request->validate([
            'name' => 'required',
            'background_color' => ['regex:/^#[0-9A-z]{6}$/', 'nullable'],
            'text_color' => ['regex:/^#[0-9A-z]{6}$/', 'nullable'],
            'youtube_1' => ['url', 'nullable'],
            'youtube_2' => ['url', 'nullable'],
            'youtube_3' => ['url', 'nullable'],
        ]);

        $band->save();

        return redirect()->route('home')->with('success', 'Band was successfully updated.');
    }

    public function destroy(Band $band)
    {
        $band->delete();
        return redirect()->route('home')->with('success', 'Band was successfully deleted.');
    }

    public function toggleModerator(Request $request, Band $band){

        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if($user !== NULL){
            $band->users()->toggle($user->id);

            return back()->with('success', 'Moderator was successfully toggled.');
        }

        return back()->with('error', 'Something went wrong.');
    }

    private function getYoutubeEmbedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id;
    }
}
