<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLike;

    //Constructor en livewite
    public function mount($post){
        $this->isLike = $post->likedBy(auth()->user());
    }

    //Evaluar si el usuario ha dado like o no a un post, si no ha dado like lo agrega y si lo ha dado lo quitará
    public function like(){
        if ($this->post->likedBy(auth()->user())){
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLike = false;
        }else{
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLike = true;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
