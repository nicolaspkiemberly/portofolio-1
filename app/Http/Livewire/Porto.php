<?php

namespace App\Http\Livewire;

use App\Models\Portofolio;
use Livewire\WithFileUploads;
use Livewire\Component;

class Porto extends Component
{

    use WithFileUploads;

    public $portofolios, $portofolio_id, $title, $description, $image;
    public $portofolio;

    public $isModal = false, $showModal = false;

    public function render()
    {
        $this->portofolios = Portofolio::all();
        return view('livewire.porto');
    }

    //show modal
    public function openModal(){
        $this->isModal = true;
    }

    public function edit($id){
        $this->portofolio = Portofolio::find($id);
        $this->title = $this->portofolio->title;
        $this->description = $this->portofolio->description;
        $this->openModal();
        
    }

    public function resetFields(){
        $this->title = '';
        $this->description = '';
        $this->image = '';
    }

    public function closeModal(){
        $this->isModal = false;
    }

    public function openShowModal(){
        $this->showModal = true;
    }


    public function closeShowModal(){
        $this->showModal = false;
    }


    public function store(){

        $this->validate([
            'title' => 'required|string|max:50|min:5',
            'description' => 'required|string|max:255',
            'image' => 'required|image'
        ]);
        
        Portofolio::updateOrCreate(['id' => $this->id], [
            'title' => $this->title,
            'description' => $this->description,
            'portofolio_image' => $this->image->storePublicly('portofolio-image', 'public')
        ]);

        session()->flash('message', $this->portofolio_id ? $this->title.' berhasil di update' : 'Sukses membuat portofolio baru');
       
        $this->closeModal();
        $this->resetFields();

    }

    public function show($id){
        $this->portofolio = Portofolio::find($id);
        $this->openShowModal();
    }

    public function delete($id){
        Portofolio::destroy($id);
        session()->flash('message', 'Sukses menghapus portofolio');
        $this->closeShowModal();
    }
}
