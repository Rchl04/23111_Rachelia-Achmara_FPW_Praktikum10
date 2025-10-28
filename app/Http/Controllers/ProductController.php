<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Membuat query builder baru untuk model Product
        $query = Product::query();
        // Cek apakah ada parameter 'search' di request
        if ($request->has('search') && $request->search != '') {
            // Melakukan pencarian berdasarkan nama produk atau informasi
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('unit', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('information', 'like', '%' . $search . '%')
                    ->orWhere('producer', 'like', '%' . $search . '%');
            });
        }

        // --- Fitur Sorting ---
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');

        // Batasi hanya kolom yang boleh di-sort
        $allowedSorts = ['product_name', 'unit', 'type', 'information', 'qty', 'producer'];
        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('id', 'asc'); // default sorting
        }

        // Jika tidak ada parameter ‘search’, langsung ambil produk dengan paginasi
        $data = $query->paginate(5)->appends($request->query());

        return view('master-data.product-master.index-product', compact('data', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("master-data.product-master.create-product");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi_data = $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'information' => 'required|string',
            'qty' => 'required|integer',
            'producer' => 'required|string|max:255',
        ]);

        try {
            Product::create($validasi_data);
            return redirect()->route('product-index')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add product.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view("master-data.product-master.detail-product", compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('master-data.product-master.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'information' => 'required|string',
            'qty' => 'required|integer',
            'producer' => 'required|string|max:255',
        ]);


        try {
            $product = Product::findOrFail($id);
            $product->update([
                'product name' => $request->product_name,
                'unit' => $request->unit,
                'type' => $request->type,
                'information' => $request->information,
                'qty' => $request->qty,
                'producer' => $request->producer,
            ]);

            return redirect()->route('product-index')->with('success', 'Product update successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', 'Product berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Product tidak ditemukan.');
    }
}
