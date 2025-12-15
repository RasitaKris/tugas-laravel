<x-layout pageTitle="Register">

<div class="container py-4">
    <div class="soft-card mx-auto" style="max-width:420px;">
        <h3 class="mb-3">Create Account</h3>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button class="btn btn-primary-accent w-100 mt-2">Register</button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Already have an account? Login</a>
            </div>
        </form>
    </div>
</div>

</x-layout>
