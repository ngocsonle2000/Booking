<?php

namespace App\Http\Controllers;

use App\Models\promo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function dauthang(Request $request)
    {
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $subSeven = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $earlyLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $endLastMonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub365day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $data = $request->all();
        if ($data['dasboard_value'] == 'seven-date') {
            $statistic = DB::table('bookrooms')
                ->select(DB::raw('OutDay, sum(CountPrice) AS "Count"'))
                ->whereBetween('OutDay', [$subSeven, $now])->where('PaymentStatus', '0')
                ->where('idAdmin', Auth::guard('custom')->user()->id)
                ->groupByRaw('OutDay')
                ->get();
        } elseif ($data['dasboard_value'] == 'last-month') {
            $statistic = DB::table('bookrooms')
                ->select(DB::raw('OutDay, sum(CountPrice) AS "Count"'))
                ->whereBetween('OutDay', [$earlyLastMonth, $endLastMonth])->where('PaymentStatus', '0')
                ->where('idAdmin', Auth::guard('custom')->user()->id)
                ->groupByRaw('OutDay')
                ->get();
        } elseif ($data['dasboard_value'] == 'this-month') {
            $statistic = DB::table('bookrooms')
                ->select(DB::raw('OutDay, sum(CountPrice) AS "Count"'))
                ->whereBetween('OutDay', [$dauthangnay, $now])->where('PaymentStatus', '0')
                ->where('idAdmin', Auth::guard('custom')->user()->id)
                ->groupByRaw('OutDay')
                ->get();
        } else {
            $statistic = DB::table('bookrooms')
                ->select(DB::raw('OutDay, sum(CountPrice) AS "Count"'))
                ->whereBetween('OutDay', [$sub365day, $now])->where('PaymentStatus', '0')
                ->where('idAdmin', Auth::guard('custom')->user()->id)
                ->groupByRaw('OutDay')
                ->get();
        }
        if ($statistic) {
            foreach ($statistic as $key => $val) {

                $chart_data[] = array(
                    'name' => $val->OutDay,
                    'y'    => $val->Count,
                );
            }
        } else {
            $chart_data[] = array(
                'name' => 0,
                'y'    => 0,
            );
        }

        echo json_encode($chart_data);
    }

    public function dayOrder(Request $request)
    {
        $subThirty = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();


        $statistic = DB::table('bookrooms')
            ->select(DB::raw('OutDay, sum(CountPrice) AS "Count"'))
            ->whereBetween('OutDay', [$subThirty, $now])->where('PaymentStatus', '0')
            ->where('idAdmin', Auth::guard('custom')->user()->id)
            ->groupByRaw('OutDay')
            ->get();

        foreach ($statistic as $key => $val) {

            $chart_data[] = array(
                'name' => $val->OutDay,
                'y'    => $val->Count,
            );
        }
        echo json_encode($chart_data);
    }

    public function dateFilter(Request $request)
    {
        $data = $request->all();
        $date_form = $data['date_form'];
        $date_to = $data['date_to'];

        $statistic = DB::table('bookrooms')
            ->select(DB::raw('OutDay, sum(CountPrice) AS "Count"'))
            ->whereBetween('OutDay', [$date_form, $date_to])->where('PaymentStatus', '0')
            ->where('idAdmin', Auth::guard('custom')->user()->id)
            ->groupByRaw('OutDay')
            ->get();

        foreach ($statistic as $key => $val) {

            $chart_data[] = array(
                'name' => $val->OutDay,
                'y'    => $val->Count,
            );
        }
        echo json_encode($chart_data);
    }

    public function HotelBrand(Request $request)
    {
        $data = $request->all();
        $dataRoom = DB::table('kindrooms')
            ->where('idHotel', $data['HotelBrand'])
            ->where('idUser', Auth::guard('custom')->user()->id)
            ->get();
        foreach ($dataRoom as $key => $val) {

            $chart_data[] = array(
                'id'   => $val->id,
                'name' => $val->name,
            );
        }
        echo json_encode($chart_data);
    }
    public function ApplyPromo(Request $request)
    {
        $data = $request->all();
        $check = promo::where('code', $data['promoDetails'])->first();
        if ($check) {
            if ($check->time == $check->number) {
                $chart_data[] = array(
                    'alert' => 'Số lượng mã giảm giá đã hết',
                );
            } else {
                $checkUser = promo::where('code', $data['promoDetails'])->where('idUser', 'LIKE', '%'.Auth::guard('custom')->user()->id.'%')->first();
                if($checkUser){
                    $chart_data[] = array(
                        'alert' => 'Mã giảm giá đã được sử dụng, vui lòng nhập mã khác',
                    );
                }else{
                    if ($check->idKindRoom == $data['idKindRoom']) {
                        $chart_data[] = array(
                            'id'   => $check->id,
                            'code' => $check->code,
                            'condition_promo' => $check->condition_promo,
                            'price'           => $check->price,
                            'count'           => $data['count'],
                        );
                    } else if ($check->idHotel == $data['idHotel']) {
                        $chart_data[] = array(
                            'id'   => $check->id,
                            'code' => $check->code,
                            'condition_promo' => $check->condition_promo,
                            'price'           => $check->price,
                            'count'           => $data['count'],
                        );
                    } else {
                        $chart_data[] = array(
                            'id'   => $check->id,
                            'code' => $check->code,
                            'condition_promo' => $check->condition_promo,
                            'price'           => $check->price,
                            'count'           => $data['count'],
                        );
                    }
                }
            }
        } else {
            $chart_data[] = array(
                'alert' => 'Mã giảm giá không hợp lệ hoặc sai mã giảm giá',
            );
        }
        echo json_encode($chart_data);
    }
}
