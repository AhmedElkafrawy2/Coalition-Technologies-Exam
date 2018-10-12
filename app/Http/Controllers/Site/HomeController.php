<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    public function index(){
        $data['title'] = "Home";

        $json = Storage::disk('local')->get('data.json');
        $data['products'] = json_decode($json, true);

        return view("Site.Pages.index", $data);
    }
}
