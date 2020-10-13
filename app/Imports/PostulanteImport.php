<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Http\Request;

class PostulanteImport implements ToCollection
{ 
    public function collection(Collection $collection) {
        // dd($collection);
        foreach ($collection as $key => $value) {
            if($key != 0){
                //Se crea variable de request
                // $myRequest = new Request();
                // $myRequest->setMethod('POST');
                // $myRequest->request->add([
                //     'nombre' => $value[0],
                //     'apellido_paterno' => $value[1],
                //     'apellido_Materno' => $value[2],
                // ]);
                // dd($request);

                $requestTEM = new Request();
                $requestTEM->setMethod('POST');
                $requestTEM->request->add(array('nombre' => $value[0]));
                $requestTEM->request->add(array('apellido_paterno' => $value[1]));
                $requestTEM->request->add(array('apellido_materno' => $value[2]));
                dd($requestTEM->request);
                
                if($value[0] != null && $value[1] != null && $value[1] != null){

                }
            }
        }
    }
}
