@extends('layouts.master')

@section('body')
    <div class="display font-sans">
        <header class="p-3 bg-orange-600 text-gray-800">
            Header
        </header>
        <main class="p-3 lg:px-64 text-gray-800 mx-auto">
            @yield('content')
        </main>
        <aside class="p-3 bg-orange-700 text-white flex">
            <div class="flex pt-1 pr-3 text-white">
                <i class="fad fa-keyboard fa-fw fa-2x"></i>
            </div>
            <input
                class="flex-1 px-3 py-2 border border-orange-800 bg-orange-600 focus:bg-orange-300 focus:text-gray-800 outline-none placeholder-white"
                placeholder="Enter commands here"
            />
        </aside>
        <footer class="p-3 bg-orange-900 text-gray-300 text-xs text-center">
            Copyright &copy; 2020{{ date('Y') != 2020?'-'.date('Y'):''  }} All Rights Reserved - Any unauthorized reproduction, alteration, distribution, or other use of this work is prohibited. | This software is open-sourced and can be found on <a class=" text-orange-500" href="https://github.com/matalina/text-adventure-game">Github</a> licensed under the <a class="text-orange-500" href="https://opensource.org/licenses/MIT">MIT License</a>
        </footer>
    </div>
@endsection
