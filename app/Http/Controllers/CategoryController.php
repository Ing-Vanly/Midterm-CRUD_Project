<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.backends.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
        ]);

        try {
            DB::beginTransaction();

            Category::create($request->only('name', 'description', 'status'));

            DB::commit();

            return redirect()->route('category.index')->with([
                'success' => true,
                'msg' => __('Created Successfully!')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error and return a user-friendly message
            Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->back()->with([
                'success' => false,
                'msg' => __('Something went wrong: ') . $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
        ]);

        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->update($request->only('name', 'description', 'status'));

            DB::commit();

            return redirect()->route('category.index')->with([
                'success' => true,
                'msg' => __('Updated Successfully!')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with([
                'success' => false,
                'msg' => __('Something went wrong! ') . $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->delete();

            DB::commit();

            return response()->json([
                'status' => 1,
                'msg' => __('User deleted successfully.')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 0,
                'msg' => __('Something went wrong!')
            ]);
        }
    }
}
