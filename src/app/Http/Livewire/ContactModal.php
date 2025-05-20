<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;

class ContactModal extends Component
{
    // モーダルウィンドウの表示状態を管理(true:表示, false:非表示)
    public $isOpen = false;
    // 表示する問い合わせのデータ
    public $contact;

    protected $listeners = ['openModal' => 'open'];

    // モーダルウィンドウを開くメソッド
    public function open($id)
    {
        $this->contact = Contact::find($id);

        if (!$this->contact) {
        \Log::error("Contact ID {$id} が見つかりません");
        return;
    }

        $this->isOpen = true;
    }

    // モーダルウィンドウを閉じるメソッド
    public function closeModel()
    {
        $this->isOpen = false;
    }

    //　Viewをレンタリングして、モーダルのHTMLを表示
    public function render()
    {
        return view('livewire.contact-modal');
    }
}
