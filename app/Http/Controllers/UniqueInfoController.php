<?php

namespace App\Http\Controllers;

use App\Models\UniqueInfo;
;
use Illuminate\Http\Request;

class UniqueInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // GET: ดึงข้อมูลทั้งหมด (รองรับ pagination และ search)
    public function index(Request $request)
    {
        $query = UniqueInfo::query();

        if ($request->has('search')) {
            $query->where('id', 'LIKE', "%{$request->search}%");
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
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ]);

        $uniqueinfo = UniqueInfo::create($request->all());

        return response()->json($uniqueinfo, 201);
    }

    /**
     * Display the specified resource.
     */

    // GET: ดึงข้อมูลสินค้าเดี่ยว
    public function show($id)
    {
        return response()->json(UniqueInfo::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */

    // PUT: อัปเดตข้อมูลสินค้า
    public function update(Request $request, $id)
    {
        $uniqueinfo = UniqueInfo::findOrFail($id);
        $uniqueinfo->update($request->all());

        return response()->json($uniqueinfo);
    }

    /**
     * Remove the specified resource from storage.
     */

    // DELETE: ลบสินค้า
    public function destroy($id)
    {
        UniqueInfo::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
