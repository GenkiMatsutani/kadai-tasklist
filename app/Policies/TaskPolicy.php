// <?php

// namespace App\Policies;

// use App\Models\Task;
// use App\Models\User;
// use Illuminate\Auth\Access\HandlesAuthorization;

// class TaskPolicy
// {
//     use HandlesAuthorization;
    
//     public function view(User $user, Task $task)
//     {
//         if ($user->id !== $task->user_id) {
//             return view('dashboard'); // ログインページにリダイレクト
//         }
//         return true; // 条件を満たす場合は true を返す
//     }
    
//         public function edit(User $user, Task $task)
//         {
//             if ($user->id !== $task->user_id) {
//                 return view('dashboard'); // ログインページにリダイレクト
//             }
//             return true; // 条件を満たす場合は true を返す
//         }

//     public function update(User $user, Task $task)
//     {
//         if ($user->id !== $task->user_id) {
//             return view('dashboard'); // ログインページにリダイレクト
//         }
//         return true; // 条件を満たす場合は true を返す
//     }

//     public function delete(User $user, Task $task)
//     {
//         if ($user->id !== $task->user_id) {
//             return view('dashboard'); // ログインページにリダイレクト
//         }
//         return true; // 条件を満たす場合は true を返す
//     }
// }