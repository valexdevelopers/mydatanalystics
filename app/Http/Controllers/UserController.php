<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Exports\UserExport;
use Maatwebsite\Excel\Excel as ExcelExcel;

class UserController extends Controller
{
    //
    public function index(){
        
        $allusers = User::all();
        $users = User::latest()->simplePaginate(20);

        // group data by gender
        $gender = $allusers->groupBy('gender');
        $gender->map(function($group, $key){
            if($key == 'female'){
                return [
                    'female' => $group->count(),
                ];
            }elseif($key == 'male'){
                return [
                    'male' => $group->count(),
                ];
        }
            
        });

        $agelessthan18 = 0;
        $agelessthan25 =  0;
        $agelessthan40 = 0;
        $agelessthan60 = 0;
        $agelessthan100 = 0;
      
        foreach($allusers as $singleUser){
            if($singleUser->age < 18){
                $agelessthan18++;  
            }elseif($singleUser->age >= 18 && $singleUser->age < 25){
                $agelessthan25++;
            }elseif($singleUser->age >= 25 && $singleUser->age < 40){
                $agelessthan40++;
            }elseif($singleUser->age >= 40 && $singleUser->age < 60){
                $agelessthan60++;
                
            }elseif($singleUser->age >= 60){
                $agelessthan100++;
            }
        }
        // dd($gender);
       return view('index')->with('users', $users)
                            ->with('allusers', $allusers)
                            ->with('agelessthan18', $agelessthan18)
                            ->with('agelessthan25', $agelessthan25)
                            ->with('agelessthan40', $agelessthan40)
                            ->with('agelessthan60', $agelessthan60)
                            ->with('agelessthan100', $agelessthan100)
                            ->with('gender', $gender);
    }

    public function create(){
       
        return view('form');
    }
    
    public function import(Request $request){
       
        $request->validate([
            'excelfile' => ['bail', 'required', 'extensions:xls,xlsx,csv'],
        ]);

        Excel::import(new UserImport, $request->file('excelfile'));
        return back()->with('message', 'excel imported')->with('message-color', 'alert-success');
    }


    public function export(){
        // download the customer data into excel
        return Excel::download(new UserExport(), time(), ExcelExcel::XLSX);
    }
}
