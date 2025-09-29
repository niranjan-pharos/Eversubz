<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeType;
use App\Models\AttributeValue;
use App\Models\BusinessProduct;

class AttributesController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('adminDashboard')],
            ['label' => 'Product Attributes', 'url' => null],
        ];

        return view('admin.product_attributes.index', compact('breadcrumbs'));
    }

    public function fetchTableData(Request $request)
    {
        $query = AttributeValue::with('type');

        if ($request->filled('type_id')) {
            $query->where('attribute_type_id', $request->type_id);
        }

        if (!is_null($request->status)) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'success' => true,
            'data' => $query->get(),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'attribute_type_id' => 'required|exists:attribute_types,id',
            'value' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $attribute = AttributeValue::create([
            'attribute_type_id' => $request->attribute_type_id,
            'value' => $request->value,
            'status' => $request->input('status', 1),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attribute value created successfully',
            'data' => $attribute,
        ]);
    }

    public function editAttribute($id)
    {
        $attribute = AttributeValue::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $attribute,
        ]);
    }

    public function updateAttribute(Request $request, $id)
    {
        $request->validate([
            'attribute_type_id' => 'required|exists:attribute_types,id',
            'value' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $attribute = AttributeValue::findOrFail($id);
        $attribute->update([
            'attribute_type_id' => $request->attribute_type_id,
            'value' => $request->value,
            'status' => $request->input('status', $attribute->status),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attribute value updated successfully',
            'data' => $attribute,
        ]);
    }

    public function deleteAttribute($id)
    {
        $attribute = AttributeValue::findOrFail($id);
        $attribute->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attribute value deleted successfully',
        ]);
    }

    public function changeAttributeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:attribute_values,id',
            'status' => 'required|boolean',
        ]);

        $attribute = AttributeValue::findOrFail($request->id);
        $attribute->status = $request->status;
        $attribute->save();

        return response()->json([
            'success' => true,
            'message' => 'Attribute value status updated successfully',
        ]);
    }

    public function assignToProduct(Request $request)
    {
        $request->validate([
            'business_product_id' => 'required|exists:business_products,id',
            'attribute_value_ids' => 'required|array|min:1',
            'attribute_value_ids.*' => 'exists:attribute_values,id',
        ]);

        $product = BusinessProduct::findOrFail($request->business_product_id);
        $product->attributeValues()->sync($request->attribute_value_ids);

        return response()->json([
            'success' => true,
            'message' => 'Attributes assigned to product successfully',
            'data' => $product->attributeValues,
        ]);
    }

    public function getAttributesByType($typeId)
    {
        $attributes = AttributeValue::where('attribute_type_id', $typeId)
                                    ->where('status', 1)
                                    ->get();

        return response()->json([
            'success' => true,
            'data' => $attributes,
        ]);
    }
}
