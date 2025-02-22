<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // GET: ดึงข้อมูลทั้งหมด (รองรับ pagination และ search)
    public function index(Request $request)
    {
        $query = RoomType::query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */

    // POST: สร้างสินค้าใหม่
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $roomtype = RoomType::create($request->all());

        return response()->json($roomtype, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(RoomType::findOrFail($id));
    }

    // PUT: อัปเดตข้อมูลสินค้า
    public function update(Request $request, $id)
    {
        $roomtype = RoomType::findOrFail($id);
        $roomtype->update($request->all());

        return response()->json($roomtype);
    }

    /**
     * Remove the specified resource from storage.
     */
    // DELETE: ลบสินค้า
    public function destroy($id)
    {
        RoomType::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
