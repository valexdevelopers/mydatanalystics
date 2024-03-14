<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;

class UserImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //loop throught incoming excel data
        foreach($rows as $row){
            $data = [
               'name' => strtolower($row['name']), 
               'email' => strtolower($row['email']), 
               'country' => strtolower($row['country']), 
               'state' => strtolower($row['state']), 
               'gender' => strtolower($row['gender']), 
               'age' => strtolower($row['age']), 
            ];

           

            // insert data in database
            User::create($data);
        }
    }


     // validate incoming excel data to avoid duplicate entry
    public function rules():array{
        return [
            'name' => ['bail', 'required', 'string'], 
            'email' => ['bail', 'required', 'string', 'email', 'unique:'.User::class], 
            'country' => ['bail', 'required', 'string'], 
            'state' => ['bail', 'required', 'string'], 
            'gender' => ['bail', 'required', 'string'], 
            'age' => ['bail', 'required', 'numeric'], 
        ];
        
    }
}
