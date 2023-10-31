<?php

namespace App\Imports;

use DateTime;
use App\Sample;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new User([
            'username' => $row[0],
            'email'    => $row[1], 
            'password' => Hash::make($row[2]),
            'first_name' => ($row[3]),
            'middle_name' => ($row[4]),
            'last_name' => ($row[5]),
            'course' => ($row[6]),
            'year_graduated' => ($row[7]),
            'contact_no' => ($row[8]),
            'gender' => ($row[9]),
            'birthday' => Date::excelToDateTimeObject($row[10]),
        ]);
    }
}
