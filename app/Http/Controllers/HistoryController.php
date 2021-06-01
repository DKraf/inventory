<?php

namespace App\Http\Controllers;


use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipment;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->managerCheck()) {
            $equipment = Equipment::select('equipment')
                ->join('stores', 'equipment.store_id', '=', 'stores.id')
                ->select('equipment.*', 'stores.name as store_name', 'stores.address as store_address')
                ->get();
            return view('history.eqreport', compact('equipment'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return view('/home');
        }
    }

    /**
     * Ввод периода для отчета перемещений
     *
     * @return \Illuminate\Http\Response
     */
    public function dateinput()
    {
        if ($this->managerCheck()) {
            return view('history.dateinput');
        } else {
            return view('/home');
        }
    }

    /**
     * Получение отчета по перемещению оборудования
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $history
     * @return \Illuminate\Http\Response
     */
    public function movereport(Request $request, History $history)
    {
        if ($this->managerCheck()) {
            $request->validate([
                'date_from' => 'date',
                'date_to' => 'date'
            ]);

            $prepair_from =  History::select('histories')
                ->join('users','histories.from_id', '=' , 'users.id' )
                ->select('histories.id' , 'users.firstname as firstname_from', 'users.lastname as lastname_from',
                    'users.patronymic as patronymic_from')
                ->whereBetween('histories.send_date', [$request->date_from, $request->date_to])
                ->get();

             $history = History::select('histories')
                ->join('equipment','equipment.id', '=' , 'histories.equipment_id' )
                ->join('users','histories.to_id', '=' , 'users.id')
                ->select('equipment.*', 'histories.*','users.firstname as firstname_to', 'users.lastname as lastname_to',
                    'users.patronymic as patronymic_to')
                ->whereBetween('histories.send_date', [$request->date_from, $request->date_to])
                ->get();

             foreach ($prepair_from as $from){
                 foreach ($history as $item){
                     if ($from->id === $item->id) {
                         $item['fio_from'] = $from->firstname_from .' '. $from->lastname_from .' '. $from->patronymic_from;
                     };
                 }
             }

            return view('history.movereport' ,  compact('history', $request))
                ->with('i' , (request()->input('page' , 1) - 1) * 5);
        } else {
            return view('/home');
        }
    }

    protected function managerCheck(){
        $user = Auth::user();
        if ($user->rules_id === 1) {
            return true;
        } else {
            return false;
        }
    }
}
