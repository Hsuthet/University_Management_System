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

 public function noticeCreate(Request $request)
{

    $request->validate([
        'event_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'date' => 'required|date',
        'location' => 'nullable|string|max:150',
        'notice_image' => 'nullable|image|max:2048',
        'academic_year_id' => 'required|exists:academic_years,id',
        'department_id' => 'required|exists:departments,id',
    ]);

    $notice = new Notice();
    $notice->event_name = $request->event_name;
    $notice->description = $request->description;
    $notice->date = $request->date;
    $notice->location = $request->location;
    $notice->academic_year_id = $request->academic_year_id;
    $notice->department_id = $request->department_id;

  
    if ($request->hasFile('notice_image')) {
        $notice->notice_image = $request->file('notice_image')->store('notices', 'public');
    }

    $notice->save();


    return response()->json([
        'message' => 'Notice created successfully',
        'notice' => $notice,
    ], 201); // 201 = HTTP Created
}

}
