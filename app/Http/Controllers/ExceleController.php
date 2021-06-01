<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipment;

class ExceleController extends Controller
{

    /**
     * Сохранение и скачивание отчета об Оборудовании
     * (/puplic/excelsaves)
     *
     * @return \Illuminate\Http\Response
     */
    Public function downloadequip()
    {
        if ($this->managerCheck()) {
            $equipment = Equipment::select('equipment')
                ->join('stores', 'equipment.store_id', '=', 'stores.id')
                ->select('equipment.*', 'stores.name as store_name', 'stores.address as store_address')
                ->get();
            $end = $this->excelSaveEquip($equipment);
            if (!empty($end)) {
                $file = $end;
                return response()->download($file, 'equipments.xlsx');
            }
        } else {
            return view('/home');
        }
    }


    protected function excelSaveEquip($data)
    {
        $i = 2;
        $host =$_SERVER['DOCUMENT_ROOT'];
        $directory = '/excelsaves/';
        $filename= $host.$directory.'equipments.xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'Наименование');
        $sheet->setCellValue('C1', 'Склад');
        $sheet->setCellValue('D1', 'Адрес');
        $sheet->setCellValue('E1', 'Серийный номер	');
        $sheet->setCellValue('F1', 'Инвентарынй номер');

        foreach ($data as $item){
            $sheet->setCellValue('A'. $i, $item->id);
            $sheet->setCellValue('B'. $i, $item->name);
            $sheet->setCellValue('C'. $i, $item->store_name);
            $sheet->setCellValue('D'. $i, $item->store_address);
            $sheet->setCellValue('E'. $i, $item->serial_number);
            $sheet->setCellValue('F'. $i, $item->inventory_number);
            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);
        return $filename;
    }


    /**
     * Сохранение и скачивание отчета об историй перемещений
     * (/puplic/excelsaves)
     *
     * @return \Illuminate\Http\Response
     */
    Public function downloadhistory(Request $request)
    {
        if ($this->managerCheck()) {
            $history = json_decode($request->data,true);
            $end = $this->excelSaveHistory($history);
            if (!empty($end)) {
                $file = $end;
                return response()->download($file, 'history.xlsx');
            }
        } else {
            return view('/home');
        }
    }


    protected function excelSaveHistory($data)
    {
        $i = 2;
        $host =$_SERVER['DOCUMENT_ROOT'];
        $directory = '/excelsaves/';
        $filename= $host.$directory.'history.xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'Наименование');
        $sheet->setCellValue('C1', 'Серийный номер');
        $sheet->setCellValue('D1', 'Инвентарынй номер');
        $sheet->setCellValue('E1', 'ФИО отправилетя');
        $sheet->setCellValue('F1', 'ФИО получателя');
        $sheet->setCellValue('G1', 'Дата отправки');
        $sheet->setCellValue('H1', 'Дата принятия');
        $sheet->setCellValue('I1', 'Статус');

        foreach ($data as $item){
            $sheet->setCellValue('A'. $i, $item['id']);
            $sheet->setCellValue('B'. $i, $item['name']);
            $sheet->setCellValue('C'. $i, $item['serial_number']);
            $sheet->setCellValue('D'. $i, $item['inventory_number']);
            $sheet->setCellValue('E'. $i, $item['fio_from']);
            $sheet->setCellValue('F'. $i, $item['firstname_to'] . ' '. $item['lastname_to'] . ' '. $item['patronymic_to']);
            $sheet->setCellValue('G'. $i, $item['send_date']);
            $sheet->setCellValue('H'. $i, $item['received_date']);
            $sheet->setCellValue('I'. $i, (!empty($item['received_date'])) ? 'Получено' : "Отправлено");
            $i++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);
        return $filename;
    }


    protected function managerCheck()
    {
        $user = Auth::user();
        if ($user->rules_id === 1) {
            return true;
        } else {
            return false;
        }
    }
}
