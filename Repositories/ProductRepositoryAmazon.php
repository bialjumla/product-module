<?php

namespace Modules\Product\Repositories;

use App\Models\User;

class ProductRepositoryAmazon implements ProductRepositoryInterface
{

    public function getUserProducts(User $user)
    {
        dd("From Amazon");
    }
}
