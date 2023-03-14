<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Email Verification Mail </div>
                <div class="card-body">
                    Please verify your email with link:
                    <a href="{{ route('user.verify', $token) }}">Verify Email</a>
                </div>
            </div>
        </div>
    </div>
</div>
