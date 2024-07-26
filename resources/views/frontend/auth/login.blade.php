<x-site.layout.master page-title="Login">

<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="" id="form_data">
            @csrf
            <span id="reauth-email" class="reauth-email"></span>
            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autofocus>
            <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required>
                    @error('password')
                    <span class="error invalid-password text-danger" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                    @enderror
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form>
        <a href="#" class="forgot-password">
            Forgot the password?
        </a>
    </div><!-- /card-container -->
</div>
</x-site.layout.master>
