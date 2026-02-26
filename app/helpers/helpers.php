<?php

if (!function_exists("calcPercent")) {
    function calcPercent(int|float $total, int|float $amount): int
    {
        return $amount * 100 / $total;
    }
}
if (!function_exists("activeSort")) {
    function activeSort(string $type): ?string
    {
        $request = request();

        $default = "newest";

        if (!$request->filled('sort')) {
            if ($type == $default) {
                return 'text-blue-500';
            }
            return null;
        }

        return $request->input('sort') == $type ? 'text-blue-500' : 'text-gray-400';
    }
}
if (!function_exists("generateSortRoute")) {
    function generateSortRoute(string $type): array
    {
        $request = request();

        $queries = $request->all();

        $queries['sort'] = $type;

        return $queries;

    }
}
if (!function_exists("getUserFullName")) {
    function getUserFullName(): string
    {

        return auth()->user()->first_name . " " . auth()->user()->last_name;
    }
}
if (!function_exists("activeAccountSidebar")) {
    function activeAccountSidebar(string $routName): string
    {
        if (\Illuminate\Support\Facades\Route::currentRouteName() == $routName) {
            return 'bg-blue-500/10 text-blue-500';
        }
        return "hover:text-blue-500";
    }
}

if (!function_exists("getUserCartCount")) {
    function getUserCartCount(): int
    {
        return \App\Services\CartService::getCount();
    }
}

if (!function_exists("iconCartCount")) {
    function iconCartCount(): string
    {
        if (getUserCartCount() > 0) {
            return 'bg-blue-600';
        }
        return 'app-border';
    }
}

if (!function_exists("getProductQty")) {
    function getProductQty(int $productId): null | int
    {
         return \App\Services\CartService::getCartProductQty($productId);
    }
}

