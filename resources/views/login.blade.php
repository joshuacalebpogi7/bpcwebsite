<x-layout>
    <div>
        <h2>Login form</h2>
        <form action="/login" method="POST">
            @csrf

            <label for="username-login">Username</label>
            <input value="{{ old('username_login') }}" type="text" placeholder="Username" name="username_login"
                id="username-login">
            @error('username_login')
                <p>{{ $message }}</p>
            @enderror


            <label for="password-login">Password</label>
            <input type="password" placeholder="Password" name="password_login" id="password-login">
            @error('password_login')
                <p>{{ $message }}</p>
            @enderror

            <button class="btn btn-primary" type="submit">Log in</button>
        </form>
    </div>
</x-layout>
