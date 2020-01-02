<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Link;
use App\Models\Avatar;
use App\Models\Text;
use App\Models\Git_user;
use Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $link = Link::where('user_id', Auth::user()->id)->where('status', 1)->first();
        $avatar = Avatar::where('user_id', Auth::user()->id)->first();
        $text = Text::where('user_id', Auth::user()->id)->first();
        $git_user = Git_user::where('user_id', Auth::user()->id)->first();
        return view('frontend.home', compact('link', 'avatar', 'text', 'git_user'));
    }
    public function getImage()
    {
    	$images = Image::where('user_id', Auth::user()->id)->get()->random(8);
    	$temp = [];
    	foreach ($images as $k => $image) {
    		array_push($temp, $image->image);
    	}

    	return json_encode($temp);
    }
}
