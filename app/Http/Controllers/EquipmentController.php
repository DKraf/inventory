<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class EquipmentController extends Controller
{
    /**
     * Список оборудования на складе
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if ($this->managerCheck()) {
             $equipment = Equipment::select('equipment')
                 ->join('stores', 'equipment.store_id', '=', 'stores.id')
                 ->select('equipment.*', 'stores.name as store_name')
                 ->where('equipment.store_id', '=',Auth::user()->store_id)
                 ->get();
             return view('equipment.index', compact('equipment'))->with('i', (request()->input('page', 1) - 1) * 5);
         } else {
             return view('/home');
         }
    }


    /**
     * Форма для создания нового ресурса.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->managerCheck()) {
            return view('equipment.create');
        } else {
            return view('/home');
        }
    }


    /**
     * Добавление нового оборудования
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->managerCheck()) {
            $request['store_id'] = Auth::user()->store_id;
            $request->validate([
                'store_id' => 'required',
                'name' => 'required',
                'serial_number' => 'required',
                'inventory_number' => 'required'
            ]);

        Equipment::select('equipment')->insert([
            'store_id' => $request['store_id'],
            'name' => $request['name'],
            'serial_number' => $request['serial_number'],
            'inventory_number' => $request['inventory_number']
        ]);

        return redirect()->route('equipment.index')
            ->with('success', 'Оборудование успешно добавленно ');
        } else {
            return view('/home');
        }
    }


    /**
     * Форма редактирования оборудования
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        if ($this->managerCheck()) {
            return view('equipment.edit', compact('equipment'));
        } else {
           return view('/home');
        }
    }


    /**
     * Редактирование оборудования
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        if ($this->managerCheck()) {
            $request['store_id'] = Auth::user()->store_id;
            $request->validate([
                'store_id' => 'required',
                'name' => 'required',
                'serial_number' => 'required',
                'inventory_number' => 'required'
            ]);

            Equipment::select('equipment')
                ->where('id', $equipment->id,)
                ->update([
                    'store_id' => $request->store_id,
                    'name' => $request->name,
                    'serial_number' => $request->serial_number,
                    'inventory_number' => $request->inventory_number,
                ]);

            return redirect()->route('equipment.index')
                ->with('success', 'Оборудование успешно отредактирванно');
        } else {
            return view('/home');
        }
    }


    /**
     * Форма Отправки оборудования
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function sendshow(Equipment $equipment)
    {
        if ($this->managerCheck()) {
            $equipment = Equipment::select('equipment')
                ->join('stores', 'equipment.store_id', '=', 'stores.id')
                ->select('equipment.*', 'stores.name as store_name')
                ->where('equipment.store_id', '=',Auth::user()->store_id)
                ->get();
            return view('equipment.sendshow',  compact('equipment'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return view('/home');
        }
    }


    /**
     * Отправкa оборудования
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        if ($this->managerCheck()) {
            $user = Auth::user();
            $data = [
                'from' => $user->id,
                'send_to' => ($user->id == 1) ? 2 : 1,
                'send_date' => date("Y-m-d H:i:s"),
            ];

            foreach ($request->id as $item=>$key){
                Equipment::select('equipment')
                    ->where('id', $key)
                    ->update([
                        'store_id' => 0
                    ]);

                History::select('history')->insert([
                    'from_id' => $data['from'],
                    'to_id'   => $data['send_to'],
                    'send_date' => $data['send_date'],
                    'equipment_id' => $key
                ]);
            }
            return redirect()->route('equipment.index')
                ->with('success', 'Оборудование успешно отправленно');
        } else {
            return view('/home');
        }
    }


    /**
     * Форма Отправки оборудования
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function takeshow(Equipment $equipment)
    {
        if ($this->managerCheck()) {
            $user = Auth::user();
            $user = $user->id;
            $equipment = History::select('histories')
                ->join('equipment' , 'equipment.id' , '=' , 'histories.equipment_id')
                ->select('equipment.*' , 'histories.send_date as send_date')
                ->where('histories.received_date' , '=' , null)
                ->where('histories.to_id' , '=' , $user)
                ->get();
            return view('equipment.takeshow' ,  compact('equipment'))->with('i' , (request()->input('page' , 1) - 1) * 5);
        } else {
            return view('/home');
        }
    }


    /**
     * Отправкa оборудования
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function take(Request $request)
    {
        if ($this->managerCheck()) {
            $user = Auth::user();
            $store = $user->store_id;

            foreach ($request->id as $item=>$key){
                Equipment::select('equipment')
                    ->where('id', $key)
                    ->update([
                        'store_id' => $store
                    ]);

                History::select('history')
                    ->where('equipment_id', $key)
                    ->update([
                        'received_date' => date("Y-m-d H:i:s")
                    ]);
            }
            return redirect()->route('equipment.index')
                ->with('success', 'Оборудование успешно отправленно');
        } else {
            return view('/home');
        }
    }


    /**
     * Проверка роли пользователя
     *
     * @param  Illuminate\Support\Facades\Auth;
     * @return boolean
     */
    protected function managerCheck(){
        $user = Auth::user();
        if ($user->rules_id === 2) {
            return true;
        } else {
            return false;
        }
    }

    public function show() {
        //
    }
}
