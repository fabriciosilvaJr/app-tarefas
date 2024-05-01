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
        'title'   => 'required|min:3',
        'description' => 'required'

    ];

    }

    public function feedback(){
      return [
         'required' => 'O campo :attribute é obrigatório',
         'title.min' => 'O campo title deve ter no mínimo 3 caracteres'
      ];

    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
