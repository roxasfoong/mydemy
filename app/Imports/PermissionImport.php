<?php

namespace App\Imports;

use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\ToModel;

class PermissionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Check if the array key exists before accessing it


        // Return a new Permission model with the data
        return new Permission([
            'name' => $row[0],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'group_name' =>  $row[1],
        ]);
    }
}
