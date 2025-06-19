<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RunningTextController extends Controller
{
    public function edit()
    {
        $runningText = DB::table('runningtexts')->where('key', 'running_text')->value('value');
        return view('admin.runningtexts.edit', compact('runningText'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:255',
        ]);

        DB::table('runningtexts')->updateOrInsert(
            ['key' => 'running_text'],
            ['value' => $request->value]
        );

        return redirect()->route('admin.runningtexts.edit')->with('success', 'Running text has been updated.');
    }
}
