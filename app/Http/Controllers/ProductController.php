<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);

        return view('admin.backends.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.backends.product.create', compact('categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.backends.product.show', compact('product'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'status'      => 'required|boolean',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->only('category_id', 'name', 'description', 'price', 'status');

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/products'), $imageName);
                $data['image'] = $imageName;
            }

            Product::create($data);

            DB::commit();

            return redirect()->route('product.index')->with([
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

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.backends.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'status'      => 'required|boolean',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);

            $data = $request->only('category_id', 'name', 'description', 'price', 'status');

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                    unlink(public_path('uploads/products/' . $product->image));
                }
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/products'), $imageName);
                $data['image'] = $imageName;
            }

            $product->update($data);

            DB::commit();

            return redirect()->route('product.index')->with([
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

            $product = Product::findOrFail($id);

            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }

            $product->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'msg' => 'Product deleted successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product deletion failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'msg' => 'Failed to delete product.'
            ]);
        }
    }
}
