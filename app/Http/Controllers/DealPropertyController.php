<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Contruct;
use App\Models\Property;
use App\Models\Installment;
use App\Models\PaymentPlan;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\DealsProperty;
use App\Models\PropertyPayment;

class DealPropertyController extends Controller
{

    public function paymentplansIndex(Request $request)
    {
        $title = "Payment plans";
        $data = PaymentPlan::latest()->get();
        return view('backend/paymentplans', compact('data', 'title'));
    }

    public function paymentplansStore(Request $request)
    {
        // $request->validate([
        //     'name' =>'required|max:255',
        //     'price' =>'required|numeric',
        //     'duration' =>'required|numeric',
        // ]);

        $data = new PaymentPlan();
        $data->name = $request->name;
        $data->ins_number = $request->ins_number;
        $data->status = 1;
        $data->save();
        return back()->with('success', 'Payment plan created successfully.');
    }

    public function paymentplansEdit($id)
    {
    }
    public function paymentplansUpdate(Request $request, $id)
    {
        // $request->validate([
        //     'name' =>'required|max:255',
        //     'price' =>'required|numeric',
        //     'duration' =>'required|numeric',
        // ]);

        $data = PaymentPlan::find($id);
        $data->name = $request->name;
        $data->ins_number = $request->ins_number;
        $data->save();
        return back()->with('success', 'Payment plan updated successfully.');
    }
    public function paymentplansDelete($id)
    {
        $data = PaymentPlan::find($id);
        $data->delete();
        return back()->with('success', 'Payment plan deleted successfully.');
    }

    public function paymentplansStatus($id, $status)
    {
        $data = PaymentPlan::find($id);
        $data->status = $status;
        $data->save();
        return back()->with('success', 'Payment plan status updated successfully.');
    }
    public function DealStore()
    {
        $title = "Deal Store";
        $deal = DealsProperty::join('clients', 'clients.id', '=', 'deals_properties.client_id')
            ->join('properties', 'properties.id', '=', 'deals_properties.property_id')
            ->join('property_payments', 'property_payments.invoice_id', '=', 'deals_properties.id')
            ->select(
                'clients.firstname',
                'clients.lastname',
                'deals_properties.created_at',
                'properties.title',
                'deals_properties.id',
                'deals_properties.invoice_id',
                'deals_properties.invoice_date',
                'deals_properties.area',
                'deals_properties.price',
                'deals_properties.booking_amount',
            )
            ->latest()->get();
        // dd($deal);
        // dd($deal);
        $client = Client::all();
        $type = PropertyType::all();
        $contrct = Contruct::all();
        $property = Property::all();
        $planp = PaymentPlan::all();
        return view('property/deal', compact('deal', 'title', 'client', 'type', 'contrct', 'property', 'planp'));
    }

    public function getPrices($propertyId)
    {
        $property = Property::find($propertyId);

        if ($property) {
            return response()->json([
                'price' => $property->price,
                'area' => $property->area
            ]);
        } else {
            return response()->json(['error' => 'Property not found'], 404);
        }
    }
    public function DealStoreacrion(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'title' => 'required|max:255',
        //     'description' => 'required',
        //     'price' => 'required|numeric',
        //     'payment_plan_id' => 'required',
        // ]);

        $deal = new DealsProperty();
        $deal->client_id = $request->client_id;
        $deal->type_id = $request->type_id;
        $deal->contract_id = $request->contract_id;
        $deal->property_id = $request->property_id;
        $deal->installment_id = $request->installment_id;
        $deal->invoice_date = $request->invoice_date;
        // $deal->invoice_id = 'INV-000' . $deal->id;
        $deal->booking_amount = $request->booking_amount;
        $deal->discount = $request->discount;
        $deal->agent_id = $request->agent_id;
        $deal->price = $request->price;
        $deal->area = $request->area;
        $deal->save();
        $deal->invoice_id = 'INV-000' . str_pad($deal->id, 6, '0', STR_PAD_LEFT);

        // Save the deal again to update the invoice ID
        $deal->save();
        $payment = new PropertyPayment();
        $payment->invoice_id = $deal->id;
        $payment->payment_plan_id = $deal->installment_id;
        $payment->due_amount = $deal->due_amount;
        $payment->paid_amount = $deal->booking_amount;
        $payment->save();
        // dd($payment);


        return redirect()->route('show-payment', $deal->id)->with('success', 'Deal and payment recorded successfully.');
    }

    public function Installmentpaymntindex($id)
    {

        $title = "Installment Payment";
        $deal = DealsProperty::join('payment_plans', 'payment_plans.id', '=', 'deals_properties.installment_id')->select('deals_properties.id', 'payment_plans.ins_number', 'payment_plans.name')
            ->where('deals_properties.id', $id)->first();
        // dd($deal);


        return view('property/installment', compact('title', 'deal'));
    }

    public function storeInstallments(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'deal_id' => 'required|exists:deals,id',
            'installments' => 'required|array',
            'installments.*.installment_name' => 'required|string',
            'installments.*.installment_price' => 'required|numeric|min:0',
            'installments.*.due_date' => 'required'
        ]);

        // Get the deal and related payment plan information
        $deal = DealsProperty::join('payment_plans', 'payment_plans.id', '=', 'deals_properties.installment_id')
            ->select('deals_properties.id', 'payment_plans.ins_number', 'payment_plans.name')
            ->where('deals_properties.id', $validated['deal_id'])
            ->first();

        // Check and log the deal and installments for debugging
        \Log::info('Deal Retrieved:', ['deal' => $deal]);
        \Log::info('Validated Installments:', ['installments' => $validated['installments']]);

        // Ensure the installments array is reindexed
        $installments = array_values($validated['installments']);

        // Loop through the installments and save them
        for ($i = 0; $i < $deal->ins_number; $i++) {
            if (isset($installments[$i])) {
                $installmentData = $installments[$i];
                Log::info('Processing Installment:', ['installmentData' => $installmentData]); // Debug statement

                $installment = new Installment();
                $installment->deal_id = $deal->id;
                $installment->installment_name = $installmentData['installment_name'];
                $installment->installment_price = $installmentData['installment_price'];
                $installment->due_date = $installmentData['due_date'];
                $installment->status = 0;
                $installment->save();

                Log::info('Installment Saved:', ['installment' => $installment]); // Debug statement
            }
        }

        return redirect()->route('deal/add',)->with('success', 'Deal and payment recorded successfully.');
    }

    public function makePayment($id)
    {
        $title = "Pay";
        $deal = DealsProperty::find($id);
        $installments = Installment::where('deal_id', $id)->orderBy('due_date')->get();
        $firstInstallment = $installments->first();
        // dd($firstInstallment->status);
        return view('property/make_payment', compact('deal', 'title', 'firstInstallment', 'installments'));
    }

    public function PaymentStore(Request $request)
    {
        // dd($request->all());
        $payment = new PropertyPayment();
        $payment->invoice_id = $request->invoice_id;
        $payment->payment_plan_id = $request->payment_plan_id;
        $payment->due_date = $request->due_date;
        $payment->payment_date = $request->payment_date;
        $payment->paid_amount = $request->paid_amount;
        $payment->save();

        $deal = DealsProperty::find($request->invoice_id);
        // dd($deal);
        if (!$deal) {
            abort(404, 'Deal not found');
        }

        // Retrieve installments for the deal, ordered by due date
        $installment = Installment::findOrFail($request->payment_plan_id);
        $installment->status = 1; // Assuming '1' indicates paid status, adjust as needed
        $installment->save();
        // dd($installment);
        return back();
    }
    public function paymentHistory($id)
    {
        $title = "Payment History";
        $deal = DealsProperty::find($id);
        $payments = PropertyPayment::join('deals_properties', 'deals_properties.id', '=', 'property_payments.invoice_id')
            ->join('installments', 'installments.id', '=', 'property_payments.payment_plan_id')
            ->select('deals_properties.id', 'property_payments.paid_amount', 'installments.installment_name')
            ->where('deals_properties.id', $id)->get();
        // dd($payments);
        return view('property.payment_history', compact('deal', 'title', 'payments'));
    }
}
