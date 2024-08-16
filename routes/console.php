<?php

use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

# Sales Employee Salary Pay Date Calculation and Generate CSV
Artisan::command('sales:pay-dates {arg1?}', function ($arg1 = NULL) { 
    $salary_Payday = $bonus_Payday = "";
    $csv = "year,month,salary_date,bonus_date\n";

    $now = Carbon::now();
    $year = $arg1 ?? date('Y');

    for ($i = ($year == date('Y') ? $now->format('n') : 1); $i <= 12; $i++) {
        $salary_pay_date = Carbon::create($year, $i, 1, 0, 0, 0); // First Day of the Month
        $bonus_pay_date = Carbon::create($year, $i, 15, 0, 0, 0); // 15th of every month
        $month = $salary_pay_date->format('M');

        // Find Bonus Payment Date
        $bonus_Payday = $bonus_pay_date->format('d-m-Y');
        if ($bonus_pay_date->isWeekend()) {
            $bonus_Payday = $bonus_pay_date->next(Carbon::WEDNESDAY)->format('d-m-Y');
        }

        // Find last day of month is WeedDay or Weekend
        $salary_Payday = $salary_pay_date->lastOfMonth()->format('d-m-Y');
        if ($salary_pay_date->lastOfMonth()->isWeekend()) {
            $salary_Payday = $salary_pay_date->lastOfMonth(Carbon::FRIDAY)->format('d-m-Y');
        }

        $csv .= "{$year},{$month},{$salary_Payday},{$bonus_Payday}\n";
    }
    echo $csv;
    Storage::disk('local')->put("employees_{$year}.csv", $csv);
    $this->info("CSV Generated !!");

})->purpose('Sales Employee Salary Pay Date Calculation and Generate CSV');