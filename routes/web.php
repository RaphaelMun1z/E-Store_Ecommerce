<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CartController;
use GuzzleHttp\Middleware;
use Spatie\FlareClient\Http\Client;

// Get

Route::get('/', [Controller::class, 'index']); // Index

// Produtos

Route::get('/produtos', [ProductController::class, 'index']); 
Route::get('/produtos/cadastrar', [ProductController::class, 'create'])->Middleware('staff'); 
Route::get('/produtos/deletar', [ProductController::class, 'delete'])->Middleware('staff'); 
Route::get('/produtos/categoria/adicionar', [ProductController::class, 'addcategory'])->Middleware('staff');
Route::get('/produtos/categorias', [ProductController::class, 'showcategories']);
Route::get('/produtos/{id?}', [ProductController::class, 'show']); 
Route::get('/produtos/atualizar/{id}', [ProductController::class, 'edit'])->Middleware('staff');

// Usuários

Route::get('/usuario', [UserController::class, 'index'])->Middleware('auth'); 
Route::get('/usuario/cadastrar', [UserController::class, 'create'])->Middleware('staff'); // Ok

// Admin

Route::get('/usuario/adm', [UserController::class, 'admarea'])->Middleware('staff'); // Ok
Route::get('/usuario/adm/pedidos', [UserController::class, 'showpurchases'])->Middleware('staff'); // Ok
Route::get('/usuario/adm/produtos', [UserController::class, 'showprodadm'])->Middleware('staff'); // Ok

// Admin [2]

Route::get('/usuario/adm/funcionarios', [StaffController::class, 'index'])->Middleware('adm'); // Ok
Route::post('/usuario/adm/funcionarios/cadastrar', [StaffController::class, 'create'])->Middleware('adm'); // Ok
Route::delete('/usuario/adm/funcionarios/deletar/{id}', [StaffController::class, 'destroy'])->Middleware('adm'); // Ok
Route::get('/usuario/adm/funcionarios/atualizar/{id}', [StaffController::class, 'edit'])->Middleware('adm');
Route::put('/usuario/adm/funcionarios/atualizar/{id}', [StaffController::class, 'update'])->Middleware('adm');

// Clientes

Route::get('/clientes', [ClientController::class, 'index'])->Middleware('auth')->Middleware('staff');
Route::get('/clientes/pedidos', [ClientController::class, 'purchase'])->Middleware('staff'); // Ok

Route::get('/clientes/atualizar/{id}', [ClientController::class, 'edit'])->Middleware('staff'); // Ok
Route::delete('/clientes/deletar/{id}', [ClientController::class, 'destroy'])->Middleware('staff'); // Ok
Route::put('/clientes/atualizar/{id}', [ClientController::class, 'update'])->Middleware('staff'); // Ok

// Cliente

Route::get('/cliente/dadosentrega', [ClientController::class, 'dadosentrega'])->Middleware('auth'); // Ok
Route::get('/cliente/dadospessoais', [ClientController::class, 'dadospessoais'])->Middleware('auth'); // Ok

Route::post('/cliente/dadosentrega', [ClientController::class, 'saveDeliveryAdrress'])->Middleware('auth'); // Ok
Route::post('/cliente/dadospessoais', [ClientController::class, 'savePersonalData'])->Middleware('auth'); // Ok

Route::put('/cliente/dadosentrega', [ClientController::class, 'attDeliveryAdrress'])->Middleware('auth'); // Ok
Route::put('/cliente/dadospessoais', [ClientController::class, 'attPersonalData'])->Middleware('auth'); // Ok

Route::get('/cliente/pedidos', [ClientController::class, 'myOrders'])->Middleware('auth'); // Ok

// Carrinho

Route::get('/carrinho', [CartController::class, 'index'])->Middleware('auth');
Route::get('/carrinho/finalizar', [CartController::class, 'finalize'])->Middleware('auth');

Route::post('/carrinho/finalizar/buy', [CartController::class, 'buy'])->Middleware('auth');

Route::get('/carrinho/inc/{id}', [CartController::class, 'updateInc'])->Middleware('auth');
Route::get('/carrinho/dec/{id}', [CartController::class, 'updateDec'])->Middleware('auth');


// Post

Route::post('/produtos', [ProductController::class, 'store'])->Middleware('staff');
Route::post('/produtos/categorias', [ProductController::class, 'storeCategory'])->Middleware('staff');

Route::post('/usuario', [UserController::class, 'createUser'])->Middleware('staff');

Route::post('/carrinho', [CartController::class, 'insertCart'])->Middleware('auth');

// Delete

Route::delete('/produtos/{id?}', [ProductController::class, 'destroy'])->Middleware('staff'); // Ok
Route::delete('/carrinho/del/{id}', [CartController::class, 'delete'])->Middleware('auth');
Route::delete('/usuario/adm/pedidos/{id}', [UserController::class, 'destroyPurchase'])->Middleware('staff'); // Ok

Route::put('/usuario/adm/pedidos/atualizar/{id}', [UserController::class, 'updatePurchaseStatus'])->Middleware('staff');

// Put

Route::put('/produtos/atualizar/{id}', [ProductController::class, 'update'])->Middleware('staff');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {});

Route::middleware(['adm'])->group(function () {});
Route::middleware(['staff'])->group(function () {});