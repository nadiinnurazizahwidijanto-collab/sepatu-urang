<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Konstruktor untuk keamanan:
     * Hanya mengizinkan user dengan is_admin = 1
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->is_admin != 1) {
                return redirect('/')->with('error', 'Akses Ditolak! Anda bukan Admin.');
            }
            return $next($request);
        });
    }

    // Halaman Produk Admin
    public function products()
    {
        $products = Product::all();
        return view('admin.products', [
            'products' => $products,
            'titlePage' => 'Produk Admin',
        ]);
    }

    // Halaman Order Admin
    public function orders()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders', [
            'orders' => $orders,
            'titlePage' => 'Daftar Pesanan',
        ]);
    }

    // Menambah Produk Baru
    public function storeProduct(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string', // <-- tambahkan validasi deskripsi
        ]);

        // Upload gambar
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('img'), $imageName);

        // Simpan produk
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image_path' => $imageName,
            'category_id' => $request->category_id,
            'description' => $request->description, // <-- tambahkan ini
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menghapus Produk
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_path && file_exists(public_path('img/'.$product->image_path))) {
            unlink(public_path('img/'.$product->image_path));
        }

        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    // Update Status Order menjadi Selesai
    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'S'; // 'S' = Selesai
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
