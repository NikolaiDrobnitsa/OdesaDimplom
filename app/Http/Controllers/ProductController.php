<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images', 'category')->get();
        return response()->json([
            'products' => $products
        ]);
    }

    public function latestProducts()
    {

        $products = Product::with('images','category')->orderBy('updated_at','desc')->take(6)->get();
        return response()->json([
            'products' => $products
        ]);
    }
    public function swapImageNames(Request $request, $productId)
    {
        $request->validate([
            'swappedIndex' => 'required|integer|min:0',
        ]);

        $swappedIndex = $request->swappedIndex;

        $product = Product::with('images')->findOrFail($productId);

        if (count($product->images) <= 1 || $swappedIndex >= count($product->images)) {
            return response()->json(['message' => 'Операція не вийшла'], 400);
        }

        $firstImageName = $product->images[0]->image;

        $product->images[0]->image = $product->images[$swappedIndex]->image;
        $product->images[$swappedIndex]->image = $firstImageName;

        $product->images[0]->save();
        $product->images[$swappedIndex]->save();

        return response()->json([
            'message' => 'Вибранне зображення'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Валидация (простой пример, вы можете расширить в соответствии с вашими требованиями)
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'price' => 'required',
//            'description' => 'nullable|string',
//            'category_id' => 'required|integer|exists:categories,id',
//            'images' => 'nullable|array',
//            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'  // пример валидации каждого изображения
//        ]);

        // Создание продукта
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();

        // Обработка и сохранение изображений продукта
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_new_name = time() . $image->getClientOriginalName();
                $image->move('products/', $image_new_name);

                // Сохранение информации об изображении в таблице product_images
                $product->images()->create(['image' => $image_new_name]);
            }
        }

        // Ответ сервера после успешного создания продукта
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function updateImage(Request $request, $id, $imageIndex)
    {
        $product = Product::with('images')->findOrFail($id);

        // Проверка, если у продукта нет изображений или индекс изображения выходит за пределы
        if (!$product->images || !isset($product->images[$imageIndex])) {
            return response()->json(['message' => 'Зображення не знаденно'], 404);
        }

        $imageInstance = $product->images[$imageIndex];

        if ($request->hasFile('newImage')) {
            $newImage = $request->file('newImage');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move('products/', $newImageName);

            // Удаление старого изображения
            @unlink('products/' . $imageInstance->image);

            // Обновление записи изображения
            $imageInstance->image = $newImageName;
            $imageInstance->save();

            return response()->json([
                'message' => 'Зображення успішно оновленно!',
                'newImageName' => $newImageName
            ]);
        } else {
            return response()->json(['message' => 'Помилка зображення'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('images', 'category')->find($id);

        if ($product) {
            return response()->json(['product' => $product], 200);
        } else {
            return response()->json(['message' => 'Будиочок не знайденно'], 404);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;


//        if ($request->image && $request->image !== $product->image){
//            $image = $request->image;
//            $image_new_name = time().$image->getClientOriginalName();
//            $image->move('products/',$image_new_name);
//            $product->image = $image_new_name;
//
//        }
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Будиночок успішно видален'
        ]);
    }
}
