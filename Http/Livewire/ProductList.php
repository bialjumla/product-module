<?php

namespace Modules\Product\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Cart\Repositories\CartRepository;
use Modules\Cart\Repositories\FavoriteRepository;
use Modules\Cart\Services\CartService;
use Modules\Product\Entities\Product;
use Modules\Product\Repositories\ProductRepository;

class ProductList extends Component
{
    private $cartService;
    private $cartRepository;
    private $favoriteRepository;
    private $productRepository;

    public  $user;
    public  $isCurrantUser;

    public  $data;

    public  $cart;
    public  $items;
    public  $favorites;
    public  $currantUser;

    public  $perPage = 10;
    public  $page;

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function boot()
    {
        $this->cartRepository       = new CartRepository();
        $this->favoriteRepository   = new FavoriteRepository();
        $this->cartService          = new CartService();
        $this->productRepository    = new ProductRepository();
    }


    public function booted()
    {
        $this->currantUser          = Auth::user();
        $this->cart                 = $this->cartService->getUserCart($this->currantUser);
        $this->items                = $this->cartRepository->getCartItems($this->cart);
        //$this->isCurrantUser        = $this->currantUser->name === $this->data['user']->name;
        $this->favorites            = $this->favoriteRepository->getUserFavoriteProduct($this->currantUser);
    }

    public function render()
    {
        $this->data                  = $this->productRepository->getUserProducts($this->user , $this->perPage , $this->page);

        return view('product::livewire.product-list');
    }
}
