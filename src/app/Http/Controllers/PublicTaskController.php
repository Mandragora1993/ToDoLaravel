<?php

namespace App\Http\Controllers;

use App\Models\TaskPublicLink;

class PublicTaskController
{
    public function show($token)
    {
        $taskLink = TaskPublicLink::where('token', $token)->first();

        if (!$taskLink || now()->greaterThan($taskLink->expires_at)) {
            abort(404, 'Link wygasł lub nie istnieje.');
        }

        $task = $taskLink->task;

        return view('tasks.public', compact('task'));
    }
}
