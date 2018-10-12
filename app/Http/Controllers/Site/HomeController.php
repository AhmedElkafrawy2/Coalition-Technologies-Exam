<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index(){
        $data['title'] = "Home";

        $json = Storage::disk('local')->get('data.json');
        $data['products'] = json_decode($json, true);

        return view("Site.Pages.index", $data);
    }

    public function store(Request $request){
        //validate The data
        $rules      = [
            "name"     => "required",
            "quantity" => "required|numeric",
            "price"    => "required|numeric",

        ];
        $messages   = [
            "required"             => 1,
            "quantity.numeric"     => 2,
            "price.numeric"        => 3
        ];
        $msg        = [
            1  => trans("messages.required"),
            2  => trans("messages.numeric", [ 'field' => 'quantity']),
            3  => trans("messages.numeric", [ 'field' => 'price']),
            4  => trans("success")
        ];
        $validator  = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'errNum' => (int)$error, 'msg' => $msg[$error]]);
        }

        // update json file
        $data = [
            "name" => $request->input('name'),
            "quantity" => (int)$request->input('quantity'),
            "price" => (int)$request->input('price'),
            "Date" => (string)Carbon::now()
        ];

        $content = json_decode(file_get_contents(base_path('storage/app/data.json')), true);

        $content['products'][] = $data;
        $newJsonString = json_encode($content, JSON_PRETTY_PRINT);


        file_put_contents(base_path('storage/app/data.json'), stripslashes($newJsonString));

        return response()->json(['status' => true, 'errNum' => 0, 'msg' => $msg[4], 'date' => (string)Carbon::now()]);
    }
}
