<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getCompanyDataByInn(Request $request, $inn) {
        $collecttion = [
            ['id'=>1, 'kpp'=>'123456789', 'name'=>'ООО Тестовая Организация', 'inn' => '123451234512'],
            ['id'=>2, 'kpp'=>'987654321', 'name'=>'ООО еще одна Тестовая Организация', 'inn' => '111111111111'],
            ['id'=>3, 'kpp'=>'111111111', 'name'=>'ООО третья Тестовая Организация', 'inn' => '222222222222'],
        ];
        $res = null;
        foreach($collecttion as $item => $value) {
            if($value['inn'] == $inn) {
                $res = $value;
            }
        }
        if($res != null) {
            return response()->json($res);
        } else {
            return response()->json([]);
        }
    }
}
