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
        \Log::debug("open() called with ID: " . $id); // ここがログに出るはず

        $this->contact = Contact::find($id);
        $this->isOpen = true;
        $this->contactId = $id;


        if ($this->contact) {
            \Log::debug('取得したContactの内容: ' . json_encode($this->contact->toArray(), JSON_UNESCAPED_UNICODE));
        }else {
            \Log::error("Contact ID {$id} が見つかりません");
        }
    }

    // モーダルウィンドウを閉じるメソッド
    public function closeModal()
    {
        $this->isOpen = false;
    }

    //　Viewをレンタリングして、モーダルのHTMLを表示
    public function render()
    {
        \Log::debug('レンダー実行: isOpen=' . ($this->isOpen ? 'true' : 'false'));
        return view('livewire.contact-modal');
    }
}
