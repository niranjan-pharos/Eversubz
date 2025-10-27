<div class="row justify-content-center">
    <div class="col-12 col-md-6">
        <form action="{{ route('register') }}" method="POST" id="signup-form" class="p-4 shadow rounded bg-white">
            <h5 class="mb-4 text-center">{{$titleText}}</h5>
            @csrf
            <input type="hidden" name="account_type" value="3">

            <div class="mb-3">
                <input type="text" class="form-control custom-input1" placeholder="Name" name="name" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control custom-input1" placeholder="Username" name="username" required>
            </div>

            <div class="mb-3">
                <input type="email" class="form-control custom-input1" placeholder="Business email" name="email" required>
            </div>

            <div class="mb-3 position-relative">
                <input type="password" class="form-control custom-input1" placeholder="Password" id="password" name="password" required>
                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword('password')">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <div class="mb-3 position-relative">
                <input type="password" class="form-control custom-input1" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required>
                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword('password_confirmation')">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="signup_check" name="signup_check" required>
                <label class="form-check-label small" for="signup_check">
                    By creating this account you accept our 
                    <a href="{{ asset('terms-of-use') }}">Terms of Use</a> and 
                    <a href="{{ asset('privacy-policy') }}">Privacy Policy</a>
                </label>
            </div>

            <div class="mb-3">
                <div id="signup-error" class="text-danger" style="display: none;"></div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 register-btn position-relative">
                <span class="btn-text">Register Now</span>
                <span class="spinner-border spinner-border-sm" style="display: none;" role="status" aria-hidden="true"></span>
            </button>

            <p class="text-center mt-3 small">
                Already have an account? <a href="{{ route('user.login') }}">Log in</a>
            </p>
        </form>
    </div>
</div>
<style>
    .custom-input1 {
        padding: 10px 15px;
        height: 56px;
        font-size: 14px;
        background-color: #f2f6fa;
        font-weight: 500;
    }

    .text-danger{
        color: red;
    }

    /* Spinner base */
        .spinner-border {
          display: inline-block;
          width: 2rem;      /* default size */
          height: 2rem;
          vertical-align: text-bottom;
          border: 0.25em solid currentColor;
          border-right-color: transparent;
          border-radius: 50%;
          animation: spinner-border 0.75s linear infinite;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Small spinner */
        .spinner-border-sm {
          width: 1rem;
          height: 1rem;
          border-width: 0.2em;
        }

        /* Spinner animation */
        @keyframes spinner-border {
          100% {
            transform: rotate(360deg);
          }
        }

        #signup-form {
            background: white;
            padding: 40px !important;
            border-radius: 22px !important;
        }
</style>
<script>
$('#signup-form').on('submit', function(e) {
    e.preventDefault();

    const $button = $('.register-btn'); 
    const $spinner = $button.find('.spinner-border');
    const $btnText = $button.find('.btn-text');
    const $errorDiv = $('#signup-error');

    $button.prop('disabled', true);
    $spinner.show();
    $btnText.hide();
    $errorDiv.hide();

    const formData = $(this).serialize();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                $errorDiv.removeClass('text-danger').addClass('text-success').text(response.message).show();
                setTimeout(() => { window.location.href = response.redirect; }, 1000);
            } else {
                $errorDiv.removeClass('text-success').addClass('text-danger').text(response.message).show();
                $button.prop('disabled', false);
                $spinner.hide();
                $btnText.show();
            }
        },
        error: function(xhr) {
            let errorMessage = 'Registration failed. Please try again.';
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                errorMessage = Object.values(errors).flat().join(' ');
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            $errorDiv.removeClass('text-success').addClass('text-danger').text(errorMessage).show();
            $button.prop('disabled', false);
            $spinner.hide();
            $btnText.show();
        }
    });
});

function togglePassword(fieldId) {
    const passwordField = $('#' + fieldId);
    const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
    passwordField.attr('type', type);
    const icon = passwordField.next('span').find('i');
    icon.toggleClass('fa-eye fa-eye-slash');
}
</script>

