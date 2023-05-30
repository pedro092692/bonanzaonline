<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\BankTranfer;

class StatusOrder extends Component
{

    public $order, $status, $bankTransferOrder; 

    public function mount(){
        $this->status = $this->order->status;
        $this->getBankTransferOrders();
    }

    public function getBankTransferOrders(){
        $this->bankTransferOrder = BankTranfer::where('order_id', $this->order->id)->get();
        
    }

    public function update(){
        $this->order->status = $this->status;
        $this->order->save();
    }

    public function render()
    {
        $items = json_decode($this->order->content);
        $elements = json_decode($this->order->content, true);
        $shipping = json_decode($this->order->shipping);

        return view('livewire.admin.status-order', compact('items', 'elements', 'shipping'));
    }
}
