<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
<<<<<<< HEAD
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
=======
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Models\expenses;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function control(Request $request)
    {
        switch ($request->input('action')) {
            case 'expense':
                route('expense');

        }
    }

    public function addNewExpenseTest()
    {
        echo 'WOW - New Expence';
    }

    public function chgdate()
    {
        $v = expenses::find(2);
        dump($v->id);
        $v->created_at = '2018-01-19 10:00:00';
        $v->save(['timestamps' => false ]);
        $date = now();

        $year = date('Y', strtotime($date));
        $day = date('d', strtotime($date));

        $month = date('m', strtotime($date));
        echo $day;
        echo $month;
        echo $year;
    }
}

>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
