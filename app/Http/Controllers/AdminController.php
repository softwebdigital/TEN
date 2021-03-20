<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Beneficiary;
use App\Payment;
use App\Thrift;
use App\Group;
use Hash;
use App\Http\Controllers\Globals as Util;
use Carbon\Carbon;
use DB;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class AdminController extends Controller
{

    public function __invoke()
    {
        $data['users'] = User::where('is_admin', false)->count();
        $data['beneficiaries'] = Beneficiary::get();
        $data['groups'] = Group::count();
        $data['entities'] = Thrift::limit(10)->latest()->get();
        $data['total_paid'] = Payment::sum('amount');
        $data['last_month'] = Payment::whereDate('created_at', '=', Carbon::now()->subMonth()->toDateString())->sum('amount');
        $data['this_month'] = Payment::where('created_at','>=',Carbon::now()->subdays(30))->sum('amount');
        //
        $months = [];
        $values = [];
        $beneficiariesB = [];
        $volunteersB = [];
        $thriftsB = [];
        for($i=1;$i<13;$i++){
        	$months[] = Carbon::createFromFormat('!m', $i)->monthName;
        	$values[] = Payment::whereMonth('created_at', '=', Carbon::createFromFormat('!m', $i)->month)->whereYear('created_at', '=', date('Y'))->sum('amount');
        	$beneficiariesB[] = Beneficiary::whereMonth('created_at', '=', Carbon::createFromFormat('!m', $i)->month)->whereYear('created_at', '=', date('Y'))->count();
        	$volunteersB[] = User::whereMonth('created_at', '=', Carbon::createFromFormat('!m', $i)->month)->whereYear('created_at', '=', date('Y'))->count();
        	$thriftsB[] = Thrift::where('status', 'approved')->whereMonth('created_at', '=', Carbon::createFromFormat('!m', $i)->month)->whereYear('created_at', '=', date('Y'))->sum('amount');
        }
		$data['chart'] = LarapexChart::barChart()
			->setColors(["#f0643b"])
			->setHeight(279)
		    ->addData('Amount', $values)
		    ->setXAxis($months);
		$data['chart2'] = LarapexChart::areaChart()
			->setHeight(480)
			->setColors(["#f0643b", "#56c2d6"])
		    ->addData('Beneficiaries', $beneficiariesB)
		    ->addData('Volunteers', $volunteersB)
		    ->setXAxis($months);
		$data['chart3'] = LarapexChart::radarChart()
		    ->addData('Thrifts', $thriftsB)
		    ->setHeight(300)
		    ->setXAxis($months)
		    ->setMarkers(['#303F9F'], 7, 10);
        return view('admins.home', $data);
    }
}
