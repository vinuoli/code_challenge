<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Expert;
use App\Models\Registered;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function store(Request $request)
    {
        
        $request->merge([
            'neto' => str_replace(".","",$request->input('neto')),
            'cantidad' =>str_replace(".","",$request->input('cantidad')),
        ]);
        
        $rules = array (
            'full_name'      =>'required|max:255',
            'email'          =>'required|email',
            'tlf'            =>'required|integer|min_digits:9|max_digits:9',
            'neto'           =>'required|integer|between:20000,100000',
            'cantidad'       =>'required|integer|between:20000,1000000',
            'time_desde'     =>'required',
            'time_hasta'     =>'required'
        );
        $messages = array (
            'full_name.required'     =>'Por favor cubra el campo de nombre completo.',
            'email.required'         =>'Por favor cubra el campo de email.',
            'email.email'            =>'Por favor revise el formato del email introducido',
            'tlf.required'           =>'Por favor cubra el campo de teléfono.',
            'tlf.min_digits'         =>'Por favor revise el campo de teléfono.',
            'tlf.max_digits'         =>'Por favor revise el campo de teléfono.',
            'neto.required'          =>'Por favor cubra el campo de los ingresos netos.',
            'neto.between'           =>'Por favor los ingresos netos deben de ser superiores a 20.000 e inferiores a 100.000.',
            'cantidad.required'      =>'Por favor cubra el campo de la cantidad solicitada.',
            'cantidad.between'       =>'Por favor la cantidad solicitada debe de ser superior a 20.000 e inferior a 1.000.000.',
            'time_desde.required'    =>'Por favor cubra el campo \'Desde\' de la franja horaria de contacto.',
            'time_hasta.required'    =>'Por favor cubra el campo \'Hasta\' de la franja horaria de contacto.',
        );
        

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
        {
            $messages=$validator->messages();
            return response()->json(["messages"=>$messages], 500);
        }

        $hora_hasta = preg_match("/0[0-5]/i", explode(":",$request->time_hasta)[0]) ? "24": explode(":",$request->time_hasta)[0];
        $min_hasta = explode(":",$request->time_hasta)[1];
        $hora_desde = explode(":",$request->time_desde)[0];
        $min_desde = explode(":",$request->time_desde)[1];
       
        if($hora_hasta <= ($hora_desde +8) && $hora_hasta >= $hora_desde)
        {
            $time_hasta = $hora_hasta.":".$min_hasta.":00";
        }else
        {
            if($hora_hasta > ($hora_desde +8)){
                $time_hasta = ($hora_desde +8).":".$min_desde.":00";
            }
            if($hora_hasta < $hora_desde){
                $time_hasta = $request->time_desde.":00";
            }
        }

        $registry = new Registered;
        $registered_id = null;
        date_default_timezone_set("Europe/Madrid");
        try
        {
            $registry->full_name = $request->full_name;
            $registry->email = $request->email;
            $registry->phone = $request->tlf;
            $registry->net_income = $request->neto;
            $registry->requested_amount = $request->cantidad;
            $registry->initial_communication_time =  $request->time_desde.":00";
            $registry->end_communication_time = $time_hasta;
            $registry->registration = date("Y-m-d H:i:s");
            $expert_id = Expert::select('experts_id')->whereRaw('total_active_cases = (select min(total_active_cases) from experts)')->first()->experts_id;
            $registry->id_expert_assigned = $expert_id;
    
            $registry->save();

            $registered_id = Registered::latest('registered_id')->first();


            $total_active_cases = Expert::select('total_active_cases')->where('experts_id','=',$expert_id)->first()->total_active_cases;
            Expert::where('experts_id','=',$expert_id)->update(array('total_active_cases' => $total_active_cases+1));
    
           
        }catch(Exception $ex)
        {
            $errorCode = $ex->getCode();
            if($errorCode == 23000)
            {
                $request->session()->put('duplicado','El email introducido ya se ha registrado. Un experto se pondrá en contacto con usted en la franja horaria seleccionada, muchas gracias.');
                return back();
            }else{
                $request->session()->put('error',$ex->getMessage());
                return back();
            }
        } 
        
        return Redirect::route('gracias',['registered_id' =>$registered_id]);
    }


    public function grateful(Request $request, $registered_id){
        $request->session()->flush();

        $registro = Registered::where('registered_id','=',$registered_id)
        ->select('registereds.full_name as cliente','registereds.initial_communication_time','registereds.end_communication_time','experts.full_name as expert')
        ->join('experts', 'registereds.id_expert_assigned', '=', 'experts.experts_id')->first();

        return view('gracias',['full_name' => $registro->cliente,
                               'initial_communication_time' => $registro->initial_communication_time,
                               'end_communication_time' => $registro->end_communication_time,
                               'experts' =>$registro->expert]);
    }

    public function experts(Request $request){
        if($request->has('active'))
        {
            $experts = Expert::where('active',$request->active)->get();
        }else{
            $experts = Expert::all();
        }
        return response()->json($experts);
    }
}
