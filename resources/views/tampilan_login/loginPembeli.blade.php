@extends('layouts.main')

@section('content')

<div class="font-Quicksand">
    <div class="bg-slate-100 min-h-screen flex items-center justify-center p-6 md:p-0">
        <div class="relative bg-white shadow-lg flex flex-col lg:flex-row rounded-xl overflow-hidden lg:w-2/3 2xl:w-1/2 transition-transform"
            id="auth-container">
            <!-- Form Login -->
            <div class="p-8 lg:w-1/2" id="login-form">
                <h1 class="font-bold text-gray-700 text-2xl md:text-3xl mb-6">
                    Form Login Pembeli
                </h1>
                <form action="{{ route('loginpembeli') }}" method="POST" class="flex flex-col">
                    @csrf

                    <!-- Menampilkan pesan error jika ada -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500 text-xs">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Kolom Nomor Telepon (WA) -->
                    <div class="flex flex-col mb-4 relative">
                        <i class="fas fa-phone absolute top-11 right-5 text-zinc-400"></i>
                        <label for="login-no_hp_wa" class="mb-2 text-gray-900">Nomor Telepon (WA)</label>
                        <!-- Input Nomor Telepon -->
                        <input type="text" name="no_hp_wa" id="login-no_hp_wa" placeholder="Masukkan no telepon (WA) anda"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:border-hijau focus:outline-none" required />
                    </div>
                    
                    <!-- Kolom Password -->
                    <div class="flex flex-col relative">
                        <i class="fi fi-rr-lock absolute top-11 right-5 text-gray-400"></i>
                        <label for="login-password" class="mb-2 text-gray-900">Password</label>
                        <!-- Input Password -->
                        <input type="password" name="password" id="login-password" placeholder="Masukkan password anda"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:outline-none focus:border-hijau" required />
                    </div>
                    <!-- Tombol Login -->
                    <button type="submit"
                        class="my-6 bg-primary hover:bg-hijau text-white font-medium text-lg px-4 py-2 rounded-md">
                        Login
                    </button>
                </form>

                <!-- Tautan ke halaman Register jika belum punya akun -->
                <p class="text-gray-900">
                    Belum memiliki akun ?
                    <a href="{{ route('register.nasabah') }}" class="text-blue-500 font-bold underline" onclick="showRegister()">Register</a>
                </p>

            </div>
            <!-- Gambar (hanya ditampilkan di layar besar) -->
            <div class="hidden lg:block lg:w-1/2 transition-transform transform" id="login-image">
                <img src="{{ asset('img/icon.png') }}" alt="Placeholder Image" class="h-full w-full object-cover" />
            </div>
        </div>
    </div>
</div>
@endsection
