<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Staff;
use App\Models\User;

class ProductController extends Controller
{

    public function index()
    {
        $search = request('pesquisa');
        $categorySearch = request('categoria');

        if (substr($search, 0, 1) == '@') {
            $products = Product::where([
                ['description', 'like', '%' . substr($search, 1) . '%']
            ])->orderByRaw('updated_at DESC, stock DESC, sold DESC')->paginate(20);
        } elseif ($search) {

            $products = Product::where([
                ['title', 'like', '%' . $search . '%']
            ])->orderByRaw('updated_at DESC, stock DESC, sold DESC')->paginate(20);
        } elseif ($categorySearch) {

            $products = Product::where([
                ['category', $categorySearch]
            ])->orderByRaw('updated_at DESC, stock DESC, sold DESC')->paginate(20);
        } else {

            $products = Product::orderByRaw('stock DESC, sold DESC')->paginate(20);
        }

        return view('products.index', ['products' => $products, 'search' => $search, 'category' => $categorySearch]);
    }

    public function create()
    {
        $category = Category::all();
        return view('products.new', ['categories' => $category]);
    }

    public function delete()
    {
        return view('products.del');
    }

    public function addcategory()
    {
        return view('products.category.create');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        if ($product->stock > 0)
            return view('products.view', ['product' => $product]);
        else
            return back()->with('msg', 'Produto indisponível no momento!')->with('stts', 0);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();

        return view('products.att', ['product' => $product, 'categories' => $category]);
    }

    public function showcategories()
    {
        $category = Category::all();

        return view('products.category.index', ['categories' => $category]);
    }

    // Post

    public function store(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $user = User::with('staff')->where('id', auth()->id())->get();

            $product = new Product();

            $product->title = $request->title;
            $product->description = $request->description;
            $product->stock = $request->stock;
            $product->category = $request->category;
            $product->price = $request->price;
            $product->creator_id = $user->get(0)->staff['id'];
            $product->image = $request->image;

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('m/d/Y h:i:s a', time());
            $product->created_at = date('Y-m-d H:i:s', strtotime($date));


            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/products'), $imageName);
            $product->image = $imageName;

            Staff::where('id', $user->get(0)->staff['id'])->increment('publications', 1);

            if ($product->save())
                return redirect('/produtos/cadastrar')->with('msg', 'Produto cadastrado com sucesso!')->with('stts', 1);
            else
                return redirect('/produtos/cadastrar')->with('msg', 'Houve um problema ao cadastrar o produto')->with('stts', 0);
        } else {
            return redirect('/produtos/cadastrar')->with('msg', 'Houve um problema ao cadastrar o produto!')->with('stts', 0);
        }
    }

    public function storeCategory(Request $request)
    {
        $category = new Category();

        $category->name = $request->name;

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('m/d/Y h:i:s a', time());
        $category->created_at = date('Y-m-d H:i:s', strtotime($date));

        if ($category->save())
            return redirect('/produtos/categoria/adicionar')->with('msg', 'Categoria cadastrada com sucesso!')->with('stts', 1);
        else
            return redirect('/produtos/categoria/adicionar')->with('msg', 'Houve um problema ao cadastrar a categoria')->with('stts', 0);
    }

    // Delete

    public function destroy($id)
    {
        if (Product::findOrFail($id)->delete())
            return redirect('/usuario/adm')->with('msg', 'Produto excluído com sucesso!')->with('stts', 1);
        else
            return redirect('/usuario/adm/produtos')->with('msg', 'Houve um problema ao excluir o produto')->with('stts', 0);
    }

    // Put

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            unlink(public_path('img/products/' . $product->image));
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/products'), $imageName);
            $data['image'] = $imageName;
        }

        if (Product::findOrFail($request->id)->update($data))
            return redirect('/')->with('msg', 'Produto atualizado com sucesso!')->with('stts', 1);
        else
            return redirect('/produtos/atualizar')->with('msg', 'Houve um problema ao atualizar o produto!')->with('stts', 0);
    }
}
