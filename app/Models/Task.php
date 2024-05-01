<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id'];

    public function rules(){
      return [
        'user_id' => 'required',
        'title'   => 'required',
        'description' => 'required'

    ];

    }

    public function feedback(){
      return ['required' => 'O campo :attribute é obrigatório'];

    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
