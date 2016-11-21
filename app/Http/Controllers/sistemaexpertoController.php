<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;


use App\Http\Requests;

use App\objeto;
use App\atributo;
use App\objeto_atributo;
use App\sistemaexperto;

use Validator;
use Auth;


class sistemaexpertoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sistemas = sistemaexperto::get()->all();
        return view('home.sistemaexperto.create_sistema_experto', ['sistemas' => $sistemas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|alpha|unique:sistemasexpertos',
            'comments' => 'required|string'

        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $usuario = 1;
        if (Auth::check() && Auth::user()->confirmed() == 1) {
            $usuario = Auth::user()->id;
        }

        $sistema = sistemaexperto::firstOrCreate(['user_id' => $usuario, 'name' => $request->name, 'comments' => $request->comments]);

        if (Input::file('sistema') && Input::file('sistema')->isValid())
        {
            

            $file = Input::file('sistema')->openFile();
            $text = $file->fread($file->getSize());
            $data=[];
            $data['text']=$text;

            $v2 = Validator::make($data, [
                'text' => 'required|regex:/^([A-Za-z\sáéíóú]+):\((\n[A-Za-z\sáéíóúñ,.]+)+\n\);(\n\n([A-Za-z\sáéíóú]+):\((\n[A-Za-z\sáéíóúñ,.]+)+\n\);)*$/i'           
            ]);
            //\((([A-Za-z\sáéíóú,.]+)(\n([A-Za-z\sáéíóú,.]+)+)?)

            if ($v2->fails())
            {
                return redirect()->back()->withInput(Input::get('sistema'))->withErrors($v2->errors());
            }

            
            //$this->dd("text",$text);
            $objetos_atributos = explode(';', $text);
            //$this->dd("objetos_atributos", $objetos_atributos);
            
            foreach ($objetos_atributos as $key => $objeto_atributos) {
                $objeto_atributo=explode(":", $objeto_atributos);
                if (count($objeto_atributo)>1) {
                    $objeto=$objeto_atributo[0];

                    $o = objeto::firstOrCreate(['name' => trim($objeto)]);
                    //$this->dd("objeto_atributo",$objeto_atributo);
                    $atributos=trim($objeto_atributo[1], "()");
                    $atributo=explode("\n", $atributos);
                    //$this->dd("atributo",$atributo);
                    foreach ($atributo as $key => $value) {
                        if (strlen($value)>0) {
                            $a = atributo::firstOrCreate(['name' => trim($value)]);     
                            $o_a = objeto_atributo::firstOrCreate(['sistema_id' => $sistema->id, 'objeto_id' => $o->id, 'atributo_id' => $a->id]);
                        }
                        
                    }
                }
                
            }
            

        }


        return redirect("sistema-experto/create"); 
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$atributo = atributo::where('sistemaexperto_id', $id)->get()->first();
        return view('home.sistemaexperto.sistema_experto');
    }


    private function preguntado($id_pregunta, $preguntas){
        foreach ($preguntas as $key => $value) {
            if ($value == $id_pregunta) {
                return false;
            }
        }
        return true;
    }


    private function probabilidades($respuestas, $trastornos){
        $probabilidades=[];

        //$this->dd("respuestas", $respuestas);
        //$this->dd("trastornos", $trastornos);
        foreach ($trastornos as $trastorno => $atributos) {
            $probabilidades[$trastorno]=0;
        }

        foreach ($respuestas as $respuesta => $array_respuestas) {

            foreach ($array_respuestas as $key_respuesta => $id_respuesta) {

                foreach ($trastornos as $trastorno => $array_atrubutos) {

                    

                    foreach ($array_atrubutos as $key_atributos => $atributo) {

                        if($respuesta == 'si' &&  $id_respuesta == $atributo){
                            $probabilidades[$trastorno]=$probabilidades[$trastorno]+(1*100/count($trastornos[$trastorno]));
                        }elseif($respuesta == 'no' &&  $id_respuesta == $atributo){
                            $probabilidades[$trastorno]=$probabilidades[$trastorno]-(1*100/count($trastornos[$trastorno]));
                        }
                        
                    }
                }
                
            }   
        }

        return $probabilidades;
    }

    private function mayor_probabilidad($probabilidades, $objeto_preguntado){
        $maximo= -200;
        $maximos = [];
        //$this->dd('probabilidades', $probabilidades);
        //$this->dd('objeto_preguntado', $objeto_preguntado);
        foreach ($probabilidades as $key => $probabilidad) {
            if(!$objeto_preguntado[$key] && $probabilidad > $maximo){
                $maximos=[];
                array_push($maximos, $key);
                $maximo = $probabilidad;
            }elseif (!$objeto_preguntado[$key] && $probabilidad == $maximo) {
                array_push($maximos, $key);
            }
        }

        return $maximos;
    }

    private function key_pregunta($maximo, $trastornos, $preguntas){
        $key = -1;
        //$this->dd("maximo: ", $maximo);
        //$this->dd("trastornos: ", $trastornos);
        //$this->dd("preguntas: ", $preguntas);
        if (count($preguntas[$maximo])>0) {
            $id = array_rand($preguntas[$maximo]);
            $key = $preguntas[$maximo][$id];
        }

        return $key;
    }


    private function objeto_preguntado($preguntas, $objeto){
        if (count($preguntas[$objeto])>0) {
            return false;
        }
        return true;
    }


    private function destroy_asks($preguntas, $pregunta_id){
        //$this->dd("objetos antes de eliminar", $objetos);
        //$this->dd("pregunta_id", $pregunta_id);
        foreach ($preguntas as $objeto => $atributos) {

            foreach ($atributos as $key => $atributo) {
                
                if ($atributo == $pregunta_id) {
                    //echo "pregunta == atributo";
                    unset($preguntas[$objeto][$key]);
                }
            }
            
        }

        //$this->dd("objetos despues de eliminar", $objetos);
        return $preguntas;

    }


    private function respuesta($probabilidades){
        $maximo_value = max($probabilidades);
        $maximo_id = -1;
        foreach ($probabilidades as $key => $value) {
            if ($value == $maximo_value) {
                $maximo_id = $key;
            }
        }

        if ($maximo_value<=0) {
            return "No se ha encontrado un posible trastorno";
        }elseif ($maximo_value>0 && $maximo_value<30) {
            return "Usted probablemente posea inicios de ".objeto::find($maximo_id)->name;
        }elseif ($maximo_value>=30 && $maximo_value<70) {
            return "Usted esta propenso a poseer ".objeto::find($maximo_id)->name;
        }else{
            return "Usted posee ".objeto::find($maximo_id)->name;
        }
    }

    private function dd($name, $var){
        echo "name: ".$name;
        var_dump($var);
    }


    public function ask(Request $request, $id, $r=''){
        

        $trastornos = $request->session()->get('trastornos');
        $preguntas = $request->session()->get('preguntas');
        $respuestas = $request->session()->get('respuestas');
        $pregunta = $request->session()->get('pregunta');
        $respuesta = $request->session()->get('respuesta');
        $objeto_preguntado = $request->session()->get('objeto_preguntado');
        
        
        if ($r == '') {
            $objetos = objeto_atributo::distinct()->select('objeto_id')->where('sistema_id', $id)->get();
            $preguntas=[];
            $respuestas['si']=[];
            $respuestas['no']=[];
            $objeto_preguntado=[];
            $trastornos = [];
            $respuesta = '';

            foreach ($objetos as  $objeto) {

                $atributos=objeto_atributo::distinct()->select('atributo_id')->where('sistema_id', $id)->where('objeto_id', $objeto->objeto_id)->get();
                $trastornos[$objeto->objeto_id]=[];
                $objeto_preguntado[$objeto->objeto_id]=false;
                $preguntas[$objeto->objeto_id]=[];

                foreach ($atributos as $atributo) {

                    array_push($trastornos[$objeto->objeto_id], $atributo->atributo_id);
                    array_push($preguntas[$objeto->objeto_id], $atributo->atributo_id);
                }   
            }
            //$this->dd('trastornos', $trastornos);
            

            
            $objeto_rand = array_rand($preguntas, 1);

            //$this->dd('preguntas', $preguntas);
            //$this->dd('objeto_rand', $objeto_rand);

            $pregunta_rand = array_rand($preguntas[$objeto_rand]);
            //$this->dd('pregunta_rand', $pregunta_rand);

            $pregunta_result=$preguntas[$objeto_rand][$pregunta_rand];
            //$this->dd('pregunta_result', $pregunta_result);
            
            $pregunta=[];
            $pregunta[$objeto_rand]=$pregunta_result;

            $request->session()->put('preguntas', $preguntas);
            $request->session()->put('objeto_preguntado', $objeto_preguntado);
            $request->session()->put('trastornos', $trastornos);
            $request->session()->put('respuestas', $respuestas);
            $request->session()->put('respuesta', $respuesta);
            $request->session()->put('pregunta', $pregunta);
        
        }else {

            foreach ($pregunta as $key => $pregunta) {
                if ($r == 'si') {
                    $request->session()->push('respuestas.si', $pregunta);
                }else{
                    $request->session()->push('respuestas.no', $pregunta);
                }
                
                $preguntas = $this->destroy_asks($preguntas, $pregunta);
                $objeto_preguntado[$key] = $this->objeto_preguntado($preguntas, $key);
                
            }
                
            $respuestas = $request->session()->get('respuestas');
            
            $probabilidades = $this->probabilidades($respuestas, $trastornos);
            //$this->dd('probabilidades', $probabilidades);
            $this->destroy_asks($preguntas, $pregunta);
            
            if (max($probabilidades)>70) {
                $request->session()->put('respuesta', $this->respuesta($probabilidades));

            }elseif (max($probabilidades)<0) {
                $request->session()->put('respuesta', $this->respuesta($probabilidades));
            }else{
                $maximos=$this->mayor_probabilidad($probabilidades, $objeto_preguntado);
                //$this->dd('preguntas', $preguntas);
                //$this->dd('maximos', $maximos);
                //$this->dd('objeto_preguntado', $objeto_preguntado);
                if (count($maximos)>0) {
                    
                    $maximo = array_rand($maximos, 1);
                    //$this->dd('maximo', $maximo);
                    $key_pregunta=$this->key_pregunta($maximos[$maximo], $trastornos, $preguntas);
                    $pregunta=[];
                    $pregunta[$maximos[$maximo]] = $key_pregunta;
                    $request->session()->put('pregunta', $pregunta);
                    //$this->dd('pregunta', $pregunta);
                }else{
                    $request->session()->put('respuesta', $this->respuesta($probabilidades));
                }
            }

            $request->session()->put('preguntas', $preguntas);
            $request->session()->put('objeto_preguntado', $objeto_preguntado);
            $request->session()->put('trastornos', $trastornos);

        }

        return view('home.sistemaexperto.sistema_experto_ask', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check() && Auth::user()->confirmed() == 1 &&  sistemaexperto::find($id)->user_id == Auth::user()->id){
            $sistema = sistemaexperto::find($id);
            return view('home.sistemaexperto.sistema_experto', ['sistema' => $sistema]);
        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::check() && Auth::user()->confirmed() == 1 && sistemaexperto::find($id)->user_id == Auth::user()->id){
            if (Input::file('sistema') && Input::file('sistema')->isValid())
            {
                

                $file = Input::file('sistema')->openFile();
                $text = $file->fread($file->getSize());
                $data=[];
                $data['text']=$text;

                $v2 = Validator::make($data, [
                    'text' => 'required|regex:/^([A-Za-z\sáéíóú]+):\((\n[A-Za-z\sáéíóúñ,.]+)+\n\);(\n\n([A-Za-z\sáéíóú]+):\((\n[A-Za-z\sáéíóúñ,.]+)+\n\);)*$/i'           
                ]);
                //\((([A-Za-z\sáéíóú,.]+)(\n([A-Za-z\sáéíóú,.]+)+)?)

                if ($v2->fails())
                {
                    return redirect()->back()->withInput(Input::get('sistema'))->withErrors($v2->errors());
                }

                
                
                $objetos_atributos = explode(';', $text);
                
                
                foreach ($objetos_atributos as $key => $objeto_atributos) {
                    $objeto_atributo=explode(":", $objeto_atributos);
                    if (count($objeto_atributo)>1) {
                        $objeto=$objeto_atributo[0];

                        $o = objeto::firstOrCreate(['name' => trim($objeto)]);
                        //$this->dd("objeto_atributo",$objeto_atributo);
                        $atributos=trim($objeto_atributo[1], "()");
                        $atributo=explode("\n", $atributos);
                        //$this->dd("atributo",$atributo);
                        foreach ($atributo as $key => $value) {
                            if (strlen($value)>0) {
                                $a = atributo::firstOrCreate(['name' => trim($value)]);     
                                $o_a = objeto_atributo::firstOrCreate(['sistema_id' => $id, 'objeto_id' => $o->id, 'atributo_id' => $a->id]);
                            }
                            
                        }
                    }
                    
                }
                

            }else{
                $v = Validator::make($request->all(), [
                    'objeto' => 'required|regex:/^([A-Za-z\sáéíóúñ])+$/i',
                    'atributos' => 'required|regex:/^([A-Za-z\sáéíóúñ,.]+)(\n([A-Za-z\sáéíóúñ,.]+))*$/i'

                ]);
         
                if ($v->fails())
                {
                    return redirect()->back()->withInput()->withErrors($v->errors());
                }

                //echo "objeto: ".$request->objeto."  atributos: ".$request->atributos."\n";

                
                $objeto = objeto::firstOrCreate(['name' => $request->objeto]);
                
                
                

                $atributos = explode('\n', $request->atributos);
                foreach ($atributos as $key => $value) {
                    if (strlen($value)>0) {
                        $atributo = atributo::firstOrCreate(['name' => trim($value)]);
                        $atributo_objeto = objeto_atributo::firstOrCreate(['sistema_id' => $id, 'objeto_id' => $objeto->id, 'atributo_id' => $atributo->id]);
                    }
                    
                }                
            }
            return redirect("sistema-experto/create");
            
        }else{
            return redirect('/');
        }
        
        
        
    }


    public function download($id){
        $sistema=sistemaexperto::find($id);
        $file_name=$sistema->name.".txt";
        $file_comment=$sistema->comments;

        $file_content="";
        $saltar_objeto="";

        $objetos=objeto_atributo::distinct()->select('objeto_id')->where('sistema_id', $sistema->id)->get();

        foreach ($objetos as $objeto) {

            $file_content=$file_content.$saltar_objeto.trim(objeto::find($objeto->objeto_id)->name.":(")."\n";

            $atributos=objeto_atributo::distinct()->select('atributo_id')->where('sistema_id', $sistema->id)->where('objeto_id', $objeto->objeto_id)->get();

            foreach ($atributos as $atributo) {

               $file_content=$file_content.atributo::find($atributo->atributo_id)->name."\n";

            }

            $file_content=$file_content.");";
            $saltar_objeto="\n\n";
        }

        
        $headers = ['Content-type'=>'text/plain'];
        //$this->dd('text: ', $file_content);
        return Response::make($file_content, 200, $headers);
    }


    public function upload(){
        return view('home.sistemaexperto.upload_sistema_experto');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check() && Auth::user()->confirmed() == 1 && sistemaexperto::find($id)->user_id == Auth::user()->id){
            $destroy=sistemaexperto::destroy($id);
            return redirect()->back();
        }else{
            return redirect('sistema-experto/create');
        }
    }
}
