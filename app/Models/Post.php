<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts'; // quando for necessario informar qual e a tabela relacionada com model
    protected $fillable = ['title', 'content']; // para informar ao banco que apenas essas colunas devem ser preenchidas quando receber um valor

}
