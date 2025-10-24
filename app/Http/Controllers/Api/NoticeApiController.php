<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeApiController extends Controller
{
    public function notices()
    {
        $notices = Notice::all();
        return response()->json(['message' => 'Notices retrieved successfully', 'notices' => $notices]);
    }

    public function noticeDetails($id)
    {
        $notice = Notice::findOrFail($id);
        return response()->json(['message' => 'Notice details retrieved successfully', 'notice' => $notice]);
    }

    public function noticeUpdate(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $notice->update($validatedData);

        return response()->json(['message' => 'Notice updated successfully', 'notice' => $notice]);
    }

    public function noticeDelete($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();

        return response()->json(['message' => 'Notice deleted successfully', 'notice' => $notice]);
    }
}
