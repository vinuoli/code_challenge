<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expert;
use App\Models\Registered;

class ApiController extends Controller
{
    //
    public function registration(Request $request){

        
        $data = json_decode($request->getContent());

        //validacion de datos de entrada 

        
        if(!$data){
            $response = ["status" =>0, "msg"=>""];
        }


        $registration = Registered::where('email',$data->email)->first();

        if($registration){
            $response["status"] = 1;
            $response["msg"] = "Cliente encontrado";
        }
        
        return response()->json($response);
    }

    public function experts(Request $request){
        if($request->has('active')){
            $experts = Expert::where('active',$request->active)->get();
        }else{
            $experts = Expert::all();
        }

        return response()->json($experts);
    }

    /*
    public function registereds(Request $request){
        $registereds = Registered::all();
        return response()->json($registereds);
    }
    */

}
