<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $action = '<a href="' . route("product.edit", $row->id) . '">Edit</a>
                    <form action="' . route("product.destroy", $row->id) . '" method="post">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete">
                    </form>';
                    return $action;
                })
                ->addColumn('image', function ($row) {
                    return '<img src="' . $row->getFirstMediaUrl('image') . '"width="100"/>';
                })

                ->rawColumns(['update', 'action', 'description', 'image'])
                ->make(true);
        }
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $category = Category::all();
        $product = Product::all();
        $attributes = Attribute::with('attributeValues')->get();
        return view('product.create', compact('product', 'category', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->input('special_price')) {
            $validatedData = $request->validate([
                'name' => 'required',
                'status' => 'required',
                'is_featured' => 'required',
                'sku' => 'required',
                'qty' => 'required',
                'stock_status' => 'required',
                'weight' => 'required',
                'price' => 'required',
                'special_price' => 'required',
                'special_price_from' => 'required',
                'special_price_to' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'related_product' => 'nullable',
                'meta_title' => 'required',
                'meta_keyword' => 'required',
                'meta_description' => 'required',
                'categories' => 'nullable',
                'product_attributes.*.attribute_id' => 'required',
                'product_attributes.*.value_id' => 'required'
            ]);
        } else {
            // dd($request->all());

            $validatedData = $request->validate([
                'name' => 'required',
                'status' => 'required',
                'is_featured' => 'required',
                'sku' => 'required',
                'qty' => 'required',
                'stock_status' => 'required',
                'weight' => 'required',
                'price' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'related_product' => 'nullable',
                'meta_title' => 'required',
                'meta_keyword' => 'required',
                'meta_description' => 'required',
                'categories' => 'nullable',
                'product_attributes.*.attribute_id' => 'required',
                'product_attributes.*.value_id' => 'required'
            ]);
        }
        // dd($request->all());


        $relatedProduct = $request->input('related_product', []);
        $relatedProduct = implode(",", $relatedProduct);
        $validatedData['related_product'] = $relatedProduct;
        if ($request->input('url_key')) {
            $validatedData['url_key'] = str_replace(' ', '', $request->input('url_key'));
        } else {
            $validatedData['url_key'] = str_replace(' ', '-', $validatedData['name']) . '-' . date('YmdHis');
            $count = 1;
            while (Product::where('url_key', $validatedData['url_key'])->exists()) {
                $validatedData['url_key'] = str_replace(' ', '-', $validatedData['name']) . '-' . date('YmdHis') . '-' . $count;
                $count++;
            }
        }

        $validatedData['special_price_from'];
        $product = Product::create($validatedData);
        $categorie = $request->input('categories');
        $product->categories()->sync($categorie);

        $attributes = $request->input('product_attributes', []);
        foreach ($attributes as $attribute) {
            $attributeId = $attribute['attribute_id'];
            $valueIds = $attribute['value_id'];
            foreach ($valueIds as $valueId) {
                $attributeData = [
                    'product_id' => $product->id,
                    'attribute_id' => $attributeId,
                    'attributevalue_id' => $valueId,
                ];
                ProductAttribute::create($attributeData);
            }
        }

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $product->addMedia($image)->toMediaCollection('image');
                }
            }
        }

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $proId = $product->id;
        $category = Category::all();
        $productAll = Product::all();
        $productCategories = $product->categories()->pluck('category_id')->toArray();
        $relatedProduct = explode(',', $product->related_product);
        $attributes = Attribute::with('attributeValues')->get();
        $selectedAtt = ProductAttribute::where('product_id', $proId)->pluck('attributevalue_id')->toArray();
        // dd($selectedAtt);
        return view('product.edit', compact('product', 'category', 'productAll', 'productCategories', 'relatedProduct', 'attributes', 'selectedAtt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        if ($request->input('special_price')) {
            $validatedData = $request->validate([
                'name' => 'required',
                'status' => 'required',
                'is_featured' => 'required',
                'sku' => 'required',
                'qty' => 'required',
                'stock_status' => 'required',
                'weight' => 'required',
                'price' => 'required',
                'special_price' => 'required',
                'special_price_from' => 'required',
                'special_price_to' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'related_product' => 'nullable',
                'meta_title' => 'required',
                'meta_keyword' => 'required',
                'meta_description' => 'required',
                'categories' => 'nullable',
                'product_attributes.*.attribute_id' => 'required',
                'product_attributes.*.value_id' => 'required'
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required',
                'status' => 'required',
                'is_featured' => 'required',
                'sku' => 'required',
                'qty' => 'required',
                'stock_status' => 'required',
                'weight' => 'required',  
                'price' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'related_product' => 'nullable',
                'meta_title' => 'required',
                'meta_keyword' => 'required',
                'meta_description' => 'required',
                'categories' => 'nullable',
                'product_attributes.*.attribute_id' => 'required',
                'product_attributes.*.value_id' => 'required'
            ]);
        }
        // dd($validatedData);

        $relatedProduct = $request->input('related_product', []);
        $relatedProduct = implode(",", $relatedProduct);
        $validatedData['related_product'] = $relatedProduct;
        $product = Product::find($id);
        $product->update($validatedData);
        $categorie = $request->input('categories');
        $product->categories()->sync($categorie);

        if ($request->hasFile('images')) {
            $product->clearMediaCollection('images');
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $product->addMedia($image)->toMediaCollection('images');
                }
            }
        }
        $attributes = $request->input('product_attributes', []);
        if ($attributes) {
            ProductAttribute::where('product_id', $id)->delete();

            foreach ($attributes as $attribute) {
                $attributeId = $attribute['attribute_id'];
                $valueIds = $attribute['value_id'];
                foreach ($valueIds as $valueId) {
                    $attributeData = [
                        'product_id' => $product->id,
                        'attribute_id' => $attributeId,
                        'attributevalue_id' => $valueId,
                    ];
                    ProductAttribute::create($attributeData);
                }
            }
        }

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        ProductAttribute::where('product_id', $id)->delete();

        return redirect()->back();
    }
}
