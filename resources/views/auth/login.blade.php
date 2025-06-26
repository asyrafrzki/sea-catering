@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 to-green-200 px-4 py-8">
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8 text-center">
        <img src="{{ asset('images/icon.png') }}" alt="Logo" class="w-20 mx-auto mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-2">Welcome Back</h2>
        <p class="text-sm text-gray-600 mb-6">Login to your SEA Catering account</p>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4 text-sm text-left">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 rounded p-3 mb-4 text-left">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-4 text-left">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 transition duration-200">Login</button>
        </form>

        <p class="text-sm text-gray-600 mt-6">Don't have an account?
            <a href="/register" class="text-green-700 font-semibold hover:underline">Register here</a>.
        </p>
    </div>
</div>
@endsection
