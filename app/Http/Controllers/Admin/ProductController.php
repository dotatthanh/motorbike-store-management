<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Supplier;
use App\Models\Variant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Product::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
        ];

        return view('admin.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $data = [
            'suppliers' => $suppliers,
            'categories' => $categories,
        ];

        return view('admin.product.create', $data);
    }

    public function uploadImageDetails(Request $request)
    {
        $data = [];
        foreach ($request->file as $file) {
            $data[] = $this->uploadImage($file, 'product/detail');
        }

        return $this->responseSuccess(Response::HTTP_OK, $data);
    }

    private function uploadImage(UploadedFile $file, $dirPath)
    {
        $name = time().'_'.$file->getClientOriginalName();
        Storage::disk('public_uploads')->putFileAs($dirPath, $file, $name);

        return 'uploads/'.$dirPath.'/'.$name;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $params = $request->all();
            $params['file_path'] = $this->uploadImage($request->file_path, 'product');
            $product = Product::create($params);

            // product category
            $product->categories()->attach($request->categories);

            // product image
            $this->createProductImage($request->product_images, $product->id);

            // variants
            $this->syncVariantsWithProduct($product, $request->variants);

            DB::commit();

            return redirect()->route('products.index')->with('alert-success', 'Thêm sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Thêm sản phẩm thất bại!');
        }
    }

    private function deleteProductImage($productId)
    {
        ProductImage::where('product_id', $productId)->delete();
    }

    private function createProductImage($productImages, $productId)
    {
        foreach ($productImages as $filePath) {
            ProductImage::create([
                'file_path' => $filePath,
                'product_id' => $productId,
            ]);
        }
    }

    private function syncVariantsWithProduct($product, $variants)
    {
        $variantIds = [];
        foreach ($variants as $item) {
            $item['size'] = strtoupper($item['size']);
            $variant = Variant::where($item)->first();

            if (is_null($variant)) {
                $variant = Variant::create($item);
            }

            $variantIds[] = $variant->id;
        }
        // sync quan hệ product - variant
        $product->variants()->sync($variantIds);
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
        $suppliers = Supplier::all();
        $categories = Category::all();
        $data = [
            'suppliers' => $suppliers,
            'categories' => $categories,
            'data_edit' => $product,
        ];

        return view('admin.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // dd($request->product_images);
        DB::beginTransaction();
        try {
            $params = $request->all();
            if ($request->file('file_path')) {
                $params['file_path'] = $this->uploadImage($request->file_path, 'product');
            }
            $product->update($params);

            // product category
            $product->categories()->sync($request->categories);

            // product image
            $this->deleteProductImage($product->id);
            $this->createProductImage($request->product_images, $product->id);

            // variants
            $this->syncVariantsWithProduct($product, $request->variants);

            DB::commit();

            return redirect()->route('products.index')->with('alert-success', 'Cập nhật sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Cập nhật sản phẩm thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();

            DB::commit();

            return redirect()->route('products.index')->with('alert-success', 'Xóa sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Xóa sản phẩm thất bại!');
        }
    }

    public function getVariants($id)
    {
        $data = ProductVariant::with('variant')->select('id', 'product_id', 'variant_id', 'quantity')->where('product_id', $id)->get();

        return $this->responseSuccess(Response::HTTP_OK, $data);
    }

    public function getProductsBySupplierId($id)
    {
        $data = Product::select('id', 'name')->where('supplier_id', $id)->get();

        return $this->responseSuccess(Response::HTTP_OK, $data);
    }
}
