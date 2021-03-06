<div class="tab-pane fade active show" id="timeline" wire:ignore.self>

{{--     @livewire('product::product.product-actions', ['user' => $data["user"]])--}}

    @foreach ($data['products'] as $product)

{{--     @livewire('product::show-product', [--}}
{{--    "user"=>$data['user'],--}}
{{--    "product"=>$product,--}}
{{--    "cart"=>$cart ,--}}
{{--    "items"=>$items,--}}
{{--    "isCurrantUser"=>$isCurrantUser ,--}}
{{--    "favorites"=>$favorites--}}
{{--    ], key(time().$product->id)) --}}

    <livewire:product::show-product
    :user='$data["user"]'
    :product='$product'
    :cart='$cart'
    :items='$items'
    :isCurrantUser='$isCurrantUser'
    :favorites="$favorites"
    :wire:key="md5(rand())" />
    @endforeach


    <div
        x-data="{
            observe() {
                let observer = new IntersectionObserver((entries) => {
                console.log(entries)
                entries.forEach(entry => {
                    if (entry.isIntersecting)
                    {
                        @this.call('loadMore')
                    }
                   })
                },{
                   root: null
                })
                    observer.observe(this.$el)
            }
        }"
        x-init="observe">

    </div>

    @if($data['products']->hasMorePages())
        @include('components.loading')
    @endif

    @livewire('user::user.suggested-users',['template' =>'slider'])
</div>
