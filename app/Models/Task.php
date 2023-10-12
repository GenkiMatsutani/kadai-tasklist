<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'status'];

    /**
     * この投稿を所有するユーザ。（Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function view(User $user, Task $task)
    {
        // ユーザーがタスクの作成者である場合に true を返す
        return $user->id === $task->user_id;
    }
}