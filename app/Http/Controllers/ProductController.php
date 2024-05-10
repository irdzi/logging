<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('product')->with('product', $product);
    }


    public function show()
    {
        $product = Product::all();
        return view('list-product')->with('product', $product);
    }


    public function create()
    {
        $product = new Product();
        return view('form')->with('product', $product);
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_produk' => 'required|string',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kondisi' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'required|url'
        ],
        [
            'gambar.required' => 'Error, URL Gambar wajib diisi.',
            'nama_produk.required' => 'Error, Nama Produk wajib diisi.',
            'berat.required' => 'Error, Berat wajib diisi.',
            'harga.required' => 'Error, Harga wajib diisi.',
            'stok.required' => 'Error, Stok wajib diisi.',
            'kondisi.required' => 'Error, Kondisi wajib diisi.',
            'deskripsi.required' => 'Error, Deskripsi wajib diisi.',
        ]);


        $product = new Product();
        $product->nama_produk = $request->nama_produk;
        $product->berat = $request->berat;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->kondisi = $request->kondisi;
        $product->deskripsi = $request->deskripsi;
        $product->gambar = $request->gambar;
        $product->save();

        return redirect()->route('list-product.show')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        return view('/form')->with('product', $product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('list-product.show')->with('success', 'Produk berhasil dihapus!');
    }
}
