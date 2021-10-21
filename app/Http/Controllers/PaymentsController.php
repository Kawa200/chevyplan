<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DocType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PaymentsController extends Controller
{
    public function getForm() {

        $doc_types = DocType::all();

        return view('form-consulta')->with('doc_types', $doc_types);
    }

    public function getData(Request $request)
    {
        $client = Client::where('doc_type_id', $request->doctype)->where('doc_num', $request->docnum)->first();

        $interest = Config::get('interest');
        $data = [];

        if ($client) {
            foreach ($client->plans as $plan) {

                $paidOut = 0;
                $remainingPayments = $plan->payments_num;

                foreach ($plan->payments as $payment) {
                    $paidOut += $payment->value;
                    $remainingPayments--;
                }

                $remainingDebt = $plan->full_cost - $paidOut;
                $remainingDebtWithInterest = $remainingDebt + ($remainingDebt * $interest);

                for ($i = 1; $i <= $remainingPayments; $i++) {
                    $date = Carbon::createFromFormat('Y-m-d', $plan->start_date);

                    $subData = [
                        "i" => $i,
                        "num_plan" => $plan->plan_num,
                        "valor" => bcdiv($remainingDebtWithInterest/$remainingPayments, '1', 0),
                        "vencimiento" => $date->addMonths($i)->format('Y-m-d'),
                        "vigencia" => 1,
                    ];

                    array_push($data, $subData);
                }
            }
        }

        return response()->json([
            'nombre' => $client->name,
            'fecha_plan' => $plan->start_date,
            'data' => $data
        ]);
    }

    // Método para chequear los cálculos

    public function prueba() {
        $client = Client::with('plans', 'plans.payments')->where('doc_type_id', 4)->where('doc_num', 6816055812)->first();

        $interest = Config::get('interest');
        $data = [];

        if ($client) {
            foreach ($client->plans as $plan) {
                echo "Deuda inicial: $".$plan->full_cost; echo"<br>";

                $paidOut = 0;
                echo $remainingPayments = $plan->payments_num;echo " cuotas<br>";

                foreach ($plan->payments as $payment) {
                    $paidOut += $payment->value;
                    $remainingPayments--;
                    echo "Pago registrado por: $".$payment->value."<br>";
                }

                $remainingDebt = $plan->full_cost - $paidOut;
                $remainingDebtWithInterest = $remainingDebt + ($remainingDebt * $interest);

                echo "Total pagado: $".$paidOut;echo "<br>";
                echo "Cuotas pendientes: ".$remainingPayments;echo "<br>";
                echo "Saldo: ".$remainingDebtWithInterest;echo "<br>";
                echo "O sea, ".$remainingPayments." pagos de ".number_format($remainingDebtWithInterest/$remainingPayments, 0);

                for ($i = 1; $i <= $remainingPayments; $i++) {
                    $date = Carbon::createFromFormat('Y-m-d', $plan->start_date);

                    $subData = [
                        "i" => $i,
                        "num_plan" => $plan->plan_num,
                        "valor" => bcdiv($remainingDebtWithInterest/$remainingPayments, '1', 0),
                        "vencimiento" => $date->addMonths($i)->format('Y-m-d'),
                        "vigencia" => 1,
                    ];

                    array_push($data, $subData);
                }
            }

            echo "<hr>";
        }

        dd($data);
    }
}
