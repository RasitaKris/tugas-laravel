<x-layout pageTitle="Login">

<div class="container py-4">
    <div class="soft-card mx-auto" style="max-width:420px;">
        <h3 class="mb-3">Login</h3>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary-accent w-100 mt-2">Login</button>

            <div class="text-center mt-3">
                <a href="{{ route('register') }}">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</div>

</x-layout>
