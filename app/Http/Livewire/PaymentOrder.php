<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Currency;
use Illuminate\Http\Client\Request;
use Livewire\WithFileUploads;

class PaymentOrder extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;


    public $order;

    public $payment_method = 1, $dollar_value;

    public $paymentForm = [
        'reference' => null,
        'receipt' => null
    ];

    protected $rules = [
        'paymentForm.reference' => 'required|integer|digits:4',
        'paymentForm.receipt' => 'required|image|max:512'
    ];

    protected $validationAttributes = [
        'paymentForm.reference' => 'Nro referencia',
        'paymentForm.receipt' => 'recibo de transferencia'
    ];

    protected $listeners = ['payOrder'];

    public function mount(Order $order){
        $this->order = $order;
        $this->dollar_value = Currency::where('name', 'dollar')->latest()->first();
    }

    public function updatedPaymentMethod(){
    }

    public function payOrder(){
        $this->order->status = 2;
        $this->order->save();
        return redirect()->route('orders.show', $this->order);

    }

    public function bankTransfer(){
       $order = $this->order;
       $this->validate();
       
       $image = $this->paymentForm['receipt']->store('transfers');

       $order->bankTransfer()->create([
                'amount' =>  $this->order->total *  $this->dollar_value->value,
                'reference' => $this->paymentForm['reference'],
                'image' => $image
           ]);

        $order->status = 6;
        $order->save();

        return redirect()->route('orders.show', $this->order);
    
    }

    public function render()
    {
        $this->authorize('author', $this->order);
        $this->authorize('payment', $this->order);

        $items = json_decode($this->order->content);
        $elements = json_decode($this->order->content, true);
        $shipping = json_decode($this->order->shipping);
        return view('livewire.payment-order', compact('items', 'elements', 'shipping'));
    }
}


