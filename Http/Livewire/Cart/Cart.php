<?php

namespace Modules\Product\Http\Livewire\Cart;

use Livewire\Component;
use Modules\Cart\Entities\CartItem;
class Cart extends Component
{
    public  $product;
    public  $cart;
    public  $items;
    public  $cssClass;
    public  $template = "timeline";

    public function mount()
    {
        $product = $this->items->where('product_id',$this->product->id)->first();
        $this->cssClass = $product ? '#088dcd' : '';
    }

    public function render()
    {
        return view('product::livewire.cart.cart');
    }

    public function addCartItem()
    {
       $item = $this->items->where('product_id',$this->product->id)->first();
       if(!$item)
       {
         $product = CartItem::create([
               'cart_id'    => $this->cart->id,
               'product_id' => $this->product->id,
           ]);
           $this->items     = $this->items->push($product);
           $this->cssClass  = '#088dcd';
           $this->emit('cartItemAction','add');
           return ;
       }
       $item->delete();
       $this->items = $this->items->reject(function($value) use ($item) {
            return $value->id == $item->id;
       });
       $this->cssClass = '';
       $this->emit('cartItemAction','remove');
    }
}
