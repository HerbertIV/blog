<?php

namespace App\Http\Livewire\Components\Inputs;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Trix extends Component
{
    const EVENT_VALUE_UPDATED = 'trix_value_updated';

    use WithFileUploads;

    public $value;
    public $content;
    public string $trixId;
    public $photos = [];

    public function mount($value = ''){
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

//    public function updatedValue($value) {
//        $this->emit(self::EVENT_VALUE_UPDATED, $this->value);
//    }

    public function completeUpload(string $uploadedUrl, string $trixUploadCompletedEvent){

        foreach($this->photos as $photo){
            if($photo->getFilename() == $uploadedUrl) {
                // store in the public/photos location
                $newFilename = $photo->store('public/photos');

                // get the public URL of the newly uploaded file
                $url = Storage::url($newFilename);

                $this->dispatchBrowserEvent($trixUploadCompletedEvent, [
                    'url' => $url,
                    'href' => $url,
                ]);
            }
        }
    }

    public function render(): View
    {
        return view('admin.livewire.components.inputs.trix');
    }
}
