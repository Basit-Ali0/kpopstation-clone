@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center py-12">
    <div class="bg-white border border-gray-200 rounded-lg p-10 w-full max-w-md shadow-sm">
        <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
        <p class="text-center text-sm text-gray-700 mb-8">Login untuk melacak pesanan dan mengelola akun anda.</p>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            
            @if($errors->any())
                <div class="bg-red-50 text-red-500 text-xs p-3 rounded-sm border border-red-200">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label for="email" class="block text-xs font-semibold text-gray-600 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-sm">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-600 mb-1">Password</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-sm">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center text-gray-600">
                    <input type="checkbox" name="remember" class="mr-2 border-gray-300 text-green-500 focus:ring-green-500 rounded-sm">
                    Biarkan saya tetap ter-login
                </label>
                <a href="#" class="text-green-600 font-semibold hover:underline">Lupa Password</a>
            </div>

            <button type="submit" class="w-full border border-black py-2 font-bold hover:bg-gray-50 transition duration-300 mt-2">
                Login
            </button>
        </form>

        <div class="mt-6 text-center text-xs">
            <span class="text-gray-600">Tidak memiliki akun?</span>
            <a href="{{ route('register') }}" class="text-green-600 font-semibold hover:underline ml-1">Daftar</a>
        </div>
    </div>
</div>
@endsection
