@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 to-green-200 px-4 py-8">
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8 text-center">
        <img src="{{ asset('images/icon.png') }}" alt="Logo" class="w-20 mx-auto mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-2">Create an Account</h2>
        <p class="text-sm text-gray-600 mb-6">Join SEA Catering today!</p>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 rounded p-3 mb-4 text-left">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4 text-left">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-2 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 p-2 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 p-2 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border border-gray-300 p-2 rounded-lg" required>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700">Sign Up</button>
        </form>

        <p class="text-sm text-gray-600 mt-6">Already have an account?
            <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:underline">Login here</a>.
        </p>
    </div>
</div>
@endsection
