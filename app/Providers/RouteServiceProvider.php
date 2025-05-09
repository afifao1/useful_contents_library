<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Ilova yo‘riqnomalarini yuklash.
     *
     * @return void
     */
    public function boot()
    {
        // Yo‘riqnoma yoki marshrutlarni shu yerda ko‘rsatish mumkin
    }

    /**
     * Routerlar uchun asosiy joylashuvni o‘rnatish.
     *
     * @return void
     */
    public function map()
    {
        // Ushbu joyda marshrutlarni ro‘yxatga olish mumkin
    }

    /**
     * Ilovadagi asosiy home URL manzilini olish.
     *
     * @return string
     */
    public const HOME = '/home';  // Buni o'zgartirishingiz mumkin
}
