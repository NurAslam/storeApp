<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class ProductCategoryController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $show_product = $request->input('show_product');

        if ($id) {
            $category = ProductCategory::with(['category'])->find($id);
            if ($category) {
                return ResponseFormatter::success($category, 'Data category berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data category tidak ada', 404);
            }
        }
        $category =  ProductCategory::query();
        if ($name) {
            $category->where('name', 'LIKE', '%' . $name . '%');
        }
        return ResponseFormatter::success($category->paginate($limit), 'Data list category berhasil diambil');
    }
}