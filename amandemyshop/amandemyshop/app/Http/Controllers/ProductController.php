<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $users = User::all();
        $products = Product::all();
        return view('product')->with('users', $users)->with('products', $products);
    }


    public function show()
    {
        $product = Product::all();
        return view('list-product')->with('product', $product);
    }

    // public function create()
    // {
    //     // Mendapatkan ID pengguna dari sesi
    //     $user_id = session()->get('user_id');
    //     // Lakukan operasi lainnya, misalnya membuat objek produk baru
    //     return view('form')->with('user_id', $user_id);
    // }

        public function create($id)
    {
        // Menggunakan ID pengguna dari parameter rute
        $product = new Product();
        $user = User::find($id);

        return view('form')->with('product', $product)->with('user', $user);
    }


    public function store(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nama_produk' => 'required|string',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kondisi' => 'required|string',
            'deskripsi' => 'required|string|max:2000',
            'gambar' => 'required|image|max:2048'
        ],
        [
            'gambar.required' => 'Error, Gambar wajib diisi.',
            'gambar.image' => 'Error, Harus memilih file gambar.',
            'gambar.max' => 'Error, Ukuran gambar tidak boleh lebih dari 2MB.',
            'nama_produk.required' => 'Error, Nama Produk wajib diisi.',
            'berat.required' => 'Error, Berat wajib diisi.',
            'harga.required' => 'Error, Harga wajib diisi.',
            'stok.required' => 'Error, Stok wajib diisi.',
            'kondisi.required' => 'Error, Kondisi wajib diisi.',
            'deskripsi.max' => 'Error, Deskripsi tidak boleh lebih dari 2000 karakter.',
        ]);

        $user = User::find($id);

         // Menyimpan gambar yang diunggah ke direktori storage/app/public/images
        $gambarPath = $request->file('gambar')->store('public/images');

        // Ambil nama file gambar yang disimpan di direktori storage
        $namaGambar = basename($gambarPath);

        $product = new Product();
        $product->nama_produk = $request->nama_produk;
        $product->berat = $request->berat;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->kondisi = $request->kondisi;
        $product->deskripsi = $request->deskripsi;
        $product->gambar = $namaGambar; // Simpan nama file gambar ke dalam database
        $product->user_id = $user->id;
        $product->save();

        return redirect()->route('list-product-by-user', ['id' => $user->id])->with('success', 'Product berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        $user_id = $product->user_id;

        return view('/form')->with('product', $product)->with('user_id', $user_id);
    }


    public function update(Request $request, $id)
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


        $product = Product::find($id);
        $user_id = $product->user_id;
        $product->nama_produk = $request->nama_produk;
        $product->berat = $request->berat;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->kondisi = $request->kondisi;
        $product->deskripsi = $request->deskripsi;
        $product->gambar = $request->gambar;
        $product->save();


        // return redirect()->route('list-product.show')->with('success', 'Produk berhasil diperbarui!');
        return redirect()->route('list-product-by-user', ['id' => $user_id])->with('success', 'Product berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $user_id = $product->user_id; // Mendapatkan ID pengguna dari produk
        $product->delete();

        return redirect()->route('list-product-by-user', ['id' => $user_id])->with('success', 'Produk berhasil dihapus!');
    }



        public function listProductByUser($id)
    {
    // Mendapatkan data pengguna berdasarkan ID
    $user = User::find($id);

    // Ambil produk yang dimiliki oleh pengguna dengan ID tertentu
    $products = Product::where('user_id', $id)->get();

    // Kirim data produk dan data pengguna ke view
    return view('list-product')->with('products', $products)->with('user', $user);
    }

}
