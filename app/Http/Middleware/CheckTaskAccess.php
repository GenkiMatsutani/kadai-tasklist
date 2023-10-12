<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Task; // Task モデルをインポート

class CheckTaskAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     $taskId = $request->route('task'); // ルートパラメータ 'task' を取得
    //     $task = Task::find($taskId); // タスクをデータベースから取得

    //     if ($request->user() && $task && $request->user()->can('view', $task)) {
    //         return $next($request);
    //     }
    //     return redirect('/'); // ポリシーに違反した場合、トップページにリダイレクト
    // }
    

    public function handle($request, Closure $next)
    {
        $taskId = $request->route('task'); // ルートパラメータ 'task' を取得
        $task = Task::find($taskId); // タスクをデータベースから取得

        if (!$task || $task->user_id !== auth()->id()) {
            return redirect('/');
        }
        
        if (strpos($request->url(), 'edit') !== false) {
            if ($task->user_id !== auth()->id()) {
                return redirect('/');
            }
        }
        return $next($request);
    }
}
