@extends('account.layouts.app')

@section('account-content')
    <div class="flex lg:hidden">
        <button
            class="open-user-menu mr-2 bg-blue-500 flex items-center gap-x-1 font-DanaMedium text-white p-2 rounded-lg text-sm">
            <svg class="size-5">
                <use href="#bars-3"/>
            </svg>
            منوی کاربری
        </button>
        <div class="user-menu">
            <button class="close-user-menu">
                <svg class="size-6">
                    <use href="#x-mark"/>
                </svg>
            </button>
            <!-- NAME AND AVATAR  -->
            <div class="w-full flex items-center justify-between border-b border-gray-200 dark:border-white/20 py-3">
                <div class="flex items-center gap-x-3">
                    <img src="./images/svg/user.png" class="size-10 ring-2 ring-gray-400/20 rounded-full"
                         alt="AVATAR">
                    <span class="felx flex-col gap-y-2">
                            <p class="font-DanaMedium text-lg">پارسا وصالی</p>
                            <p class="text-gray-400">09100000001</p>
                        </span>
                </div>
                <span>
                        <svg class="w-6 h-6 cursor-pointer text-blue-500">
                            <use href="#edit"></use>
                        </svg>
                    </span>
            </div>
            <ul
                class="w-full relative space-y-2 child:duration-300 child:transition-all child:py-3  child:px-2 child:flex child:gap-x-2 text-lg child:cursor-pointer child:rounded-lg">
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#squares"></use>
                    </svg>
                    <a href="dashboard.html">داشبورد</a>
                </li>
                <li class="bg-blue-500/10 text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#shopping-bag"></use>
                    </svg>
                    <a href="dashboard-orders.html">
                        سفارش ها
                    </a>
                </li>
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#heart"></use>
                    </svg>
                    <a href="dashboard-favorite.html">علاقه‌مندی ها</a>
                </li>
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#map"></use>
                    </svg>
                    <a href="dashboard-address.html">آدرس ها</a>
                </li>
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#bell"></use>
                    </svg>
                    <a href="dashboard-messages.html">پیام ها</a>
                </li>
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#cog"></use>
                    </svg>
                    <a href="dashboard-account.html">اطلاعات حساب </a>
                </li>
                <li class="text-red-400">
                    <svg class="w-6 h-6 ">
                        <use href="#arrow-left-end"></use>
                    </svg>
                    <a href="index.html">خروج</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="flex flex-col shadow rounded-lg p-4 dark:bg-gray-800 bg-white mt-5 lg:mt-0">
               <span class="flex items-center justify-between">
                 <span class="flex items-center gap-x-2">
                    <img src="{{asset('assets/images/svg/status-delivered.svg')}}" class="w-10" alt="">
                    <h2 class="font-DanaMedium text-lg">سفارش های من :</h2>
                </span>
               </span>
        <div class="relative mt-5 overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700  bg-gray-100 dark:bg-gray-900 dark:text-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3.5">
                        شماره پیگیری
                    </th>
                    <th scope="col" class="px-6 py-3.5">
                        تعداد محصول
                    </th>
                    <th scope="col" class="px-6 py-3.5">
                        تاریخ
                    </th>
                    <th scope="col" class="px-6 py-3.5">
                        قیمت
                    </th>
                    <th scope="col" class="px-6 py-3.5">
                        وضعیت
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($userOrders as $order)
                    <tr class="bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                        <td class="px-6 py-5">
                            {{$order->tracking_code}}
                        </td>
                        <td class="px-6 py-5">
                            {{$order->total_products}}
                        </td>
                        <td class="px-6 py-5">
                            {{$order->created_at->toJalali()->format("Y/m/d")}}
                        </td>
                        <td class="px-6 py-5">
                            {{$order->total_price}}
                            تومان
                        </td>
                        <td class="px-6 py-5 text-red-500 font-DanaDemiBold">

                            @switch($order->status)
                                @case(\App\Enums\OrderStatus::PENDING)
                                    <span class="text-gray-500">در انتظار پرداخت</span>
                                @break
                                @case(\App\Enums\OrderStatus::PROCESSING)
                                    <span class="text-yellow-400">در حال پردازش</span>
                                @break
                                @case(\App\Enums\OrderStatus::SENT)
                                    <span class="text-blue-500" >ارسال شده</span>
                                @break
                                @case(\App\Enums\OrderStatus::DELIVERED)
                                    <span class="text-green-500">تحویل داده شده</span>
                                @break
                                @case(\App\Enums\OrderStatus::CANCELED)
                                    <span class="text-red-500">لغو شده</span>
                                @break
                                @case(\App\Enums\OrderStatus::REFUND)
                                    <span class="text-red-500">برگشت داده شده</span>
                                @break
                            @endswitch

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {{$userOrders->links()}}
        </div>
    </div>
@endsection
