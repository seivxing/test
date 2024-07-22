<?php

namespace App\Providers;
use Livewire\Livewire;

use App\Livewire\Pages\Admin\Product\ProductBrandComponent;
use App\Livewire\Pages\Admin\Product\ProductCategoryComponent;
use App\Livewire\Pages\Admin\Product\ProductComponent;
use App\Livewire\Pages\Admin\AddStockProduct\AddStockProductComponent;
use App\Livewire\Pages\Admin\RenewStockProduct\RenewStockProductComponent;
use App\Livewire\Pages\Admin\Setting\ProductSetting;
use App\Livewire\Pages\Admin\ProductTrackingAdmin\ProductTrackingAdmin;
use App\Livewire\Pages\User\ProductCart\ProductCartCount;
use App\Livewire\Pages\User\ProductCart\ProductCartShow;
use App\Livewire\Pages\User\ProductTracking\ProductTracking;
use Illuminate\Pagination\Paginator;
use App\Livewire\Pages\User\CheckOutProduct\CheckOutComponent;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Livewire::component('product-tracking',ProductTracking::class);
        Livewire::component('product-cart-show',ProductCartShow::class);
        Livewire::component('product-cart-count',ProductCartCount::class);
        Livewire::component('check-out-component',CheckOutComponent::class);
        Livewire::component('product-tracking-admin',ProductTrackingAdmin::class);
        Livewire::component('product-settings',ProductSetting::class);
        Livewire::component('product-brand-component',ProductBrandComponent::class);
        Livewire::component('product-category-component',ProductCategoryComponent::class);
        Livewire::component('product-component',ProductComponent::class);
        Livewire::component('renew-stock-product-component',RenewStockProductComponent::class);
        Livewire::component('add-stock-product-component',AddStockProductComponent::class);
        Paginator::useBootstrap();
        date_default_timezone_set('Asia/Bangkok');
    }
}
