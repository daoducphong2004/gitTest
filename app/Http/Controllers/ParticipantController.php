<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    // Lấy tất cả participants
    public function index()
    {
        $participants = Participant::all();
        return response()->json($participants);
    }

    // Thêm mới participant
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:participants',
        ]);

        $participant = Participant::create($request->all());
        return response()->json($participant, 201);
    }

    // Lấy một participant cụ thể
    public function show(Participant $participant)
    {
        return response()->json($participant);
    }

    // Cập nhật participant
    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
        ]);

        $participant->update($request->all());
        return response()->json($participant);
    }

    // Xóa participant
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return response()->json(null, 204);
    }
}

