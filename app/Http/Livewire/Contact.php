<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact as mailable;
use Livewire\WithFileUploads;

class Contact extends Component
{
    use WithFileUploads;

    public $subject = null;

    public $createForm = [
        'name' => null,
        'message' => null,
        'subject' => null,
        'reason' => null,
        'order' => null,
        'email' => null, 
    ];

    protected $rules = [
        'createForm.message' => 'required|min:10|max:255',
        'createForm.subject' => 'required',
        'createForm.reason' => 'required|min:5|max:255',
    ];

    protected $validationAttributes = [
        'createForm.message' => 'mensaje',
        'createForm.subject' => 'asunto',
        'createForm.reason' => 'razón',
        'createForm.name' => 'nombre', 
        'createForm.order' => 'orden',
        'createForm.email' => 'correo',
    ];

    public function save(){
        if(!auth()->user()){
            $this->rules['createForm.name'] = 'required';
            $this->rules['createForm.email'] = 'required|email';
        }else{
            $this->createForm['name']= auth()->user()->name;
            $this->createForm['email'] = auth()->user()->email;
        }

        if($this->subject == 2){
            $this->rules['createForm.order'] = 'required';
        }

        $this->validate();

        $mail = new mailable($this->createForm);

        
        Mail::to($this->createForm['email'])->send($mail);

        
        return redirect('https://bonanzasonline.com');

        
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
