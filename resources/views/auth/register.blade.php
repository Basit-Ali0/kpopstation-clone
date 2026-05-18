@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center py-12">
    <div class="bg-white border border-gray-200 rounded-lg p-10 w-full max-w-md shadow-sm">
        <h2 class="text-2xl font-bold text-center mb-4">Register</h2>
        <p class="text-center text-sm text-gray-700 mb-8 px-2">Daftar sebagai anggota untuk menikmati berbagai program dan manfaat lainnya.</p>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="first_name" class="block text-xs font-semibold text-gray-600 mb-1">Nama Depan</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-sm">
                @error('first_name') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="last_name" class="block text-xs font-semibold text-gray-600 mb-1">Nama Belakang</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-sm">
                @error('last_name') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold text-gray-600 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-sm">
                @error('email') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone" class="block text-xs font-semibold text-gray-600 mb-1">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-sm">
                @error('phone') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="dob" class="block text-xs font-semibold text-gray-600 mb-1">Tanggal Lahir</label>
                <input type="date" id="dob" name="dob" value="{{ old('dob') }}" class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-sm text-sm">
                @error('dob') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-600 mb-1">Password</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-sm">
                @error('password') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-600 mb-1">Tulis ulang Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 rounded-sm">
            </div>

            <button type="submit" class="w-full border border-black py-2 font-bold hover:bg-gray-50 transition duration-300 mt-4">
                Register
            </button>
        </form>

        <div class="mt-6 text-center text-xs">
            <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">Kembali ke halaman login</a>
        </div>
    </div>
</div>
@endsection
