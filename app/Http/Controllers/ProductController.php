<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function index(Request $request) {
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc'); 
    
        if (!in_array($sortField, ['id', 'name', 'price'])) {
            $sortField = 'id';
        }
    
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }
    
        $products = Product::orderBy($sortField, $sortDirection)->get();
    
        return view('products.index', compact('products', 'sortField', 'sortDirection'));
    }
    

    public function create() {
        return view( 'products.create' );
    }

    public function store( Request $request ) {
        $request->validate( [
            'product_id'       => 'required|string|unique:products,product_id',
            'product_name'     => 'required|string',
            'product_desc'     => 'nullable',
            'product_price'    => 'required|numeric|min:0',
            'product_quantity' => 'nullable|integer|min:0',
            'product_image'    => 'required|mimes:jpeg,png,jpg,gif|max:6048',
        ] );

        if ( $request->hasFile( 'product_image' ) ) {
            $filename = time() . "." . $request->product_image->extension();
            $request->product_image->move( public_path( 'images' ), $filename );
        }

        $product_id = rand( 100000, 999999 );

        Product::create( [
            'product_id'  => $product_id,
            'name'        => $request->product_name,
            'description' => $request->product_desc,
            'price'       => $request->product_price,
            'stock'       => $request->product_quantity,
            'image'       => $filename,
        ] );

        return redirect()->route( 'products.index' )->with( 'success', 'Product Created Successfull !' );
    }

    public function show( Request $request, $id ) {
        $product = Product::find( $id );
        return view( 'products.show', compact( 'product' ) );
    }

    public function edit( Request $request, $id ) {
        $product = Product::find( $id );
        return view( 'products.edit', compact( 'product' ) );
    }

    public function update( Request $request, $id ) {

        $request->validate( [
            'product_name'     => 'required|string',
            'product_desc'     => 'nullable',
            'product_price'    => 'required|numeric|min:0',
            'product_quantity' => 'nullable|integer|min:0',
        ] );

        $product = Product::find( $id );

        $product_id = rand( 100000, 999999 );
        $filename = $product->image;

        if ( $request->hasFile( 'product_image' ) ) {
            $filename = time() . '.' . $request->product_image->extension();
            $request->product_image->move( public_path( 'images' ), $filename );

            if ( $product->image && File::exists( public_path( 'images/' . $product->image ) ) ) {
                File::delete( public_path( 'images/' . $product->image ) );
            }
        }

        $product->update( [
            'product_id'  => $product_id,
            'name'        => $request->product_name,
            'description' => $request->product_desc,
            'price'       => $request->product_price,
            'stock'       => $request->product_quantity,
            'image'       => $filename,
        ] );

        $product->save();
        return redirect()->route( 'products.index' )->with( 'success', 'Product Update Successfull !' );

    }

    function destroy( Request $request, $id ) {
        $product = Product::find( $id );
        $product->delete();
        return redirect()->route( 'products.index' )->with( 'success', 'Product Deleted Successfull !' );
    }

    public function search(Request $request) {
        $search = $request->input('search');
        $products = Product::where('name', 'like', "%{$search}%")
                            ->orWhere('product_id', 'like', "%{$search}%")
                            ->orWhere('price', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")->get();

        // Return only the rows as a partial view
        return view('products.partials.table_rows', compact('products'));
    }


}
