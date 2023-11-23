@extends('dashboard.layout.base')
@section('content')

    <div class="submit-property-area">
        <div class="container-fluid">
            <form class="submit-property-form col-md-8 mx-auto" id="editOrder" method="post" action="{{route('user.security.password')}}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Old Password<sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control form-control-lg password" placeholder="Enter your current password"
                            name="oldPassword">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>New password <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control form-control-lg password" placeholder="Enter your new password" name="password">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Repeat New Password <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control form-control-lg password" placeholder="Repeat your new password" name="password_confirmation">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="login-action">
                            <span class="forgot-login toggle-btn">
                                Show Password
                            </span>
                        </div>
                    </div>


                    <div class="col-lg-12 text-center">
                        <button type="submit" class="default-btn submit">
                            Save Change
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="submit-property-area mt-24 mb-24" style="margin-bottom: 5rem;">
        <div class="container-fluid">
            <form class="submit-property-form col-md-8 mx-auto" id="createOrder" method="post" action="{{route('user.security.security')}}">
                <h3>Two-factor Authentication</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="twoFactor">Two-factor Authentication<sup class="text-danger">*</sup></label>
                            <select class="form-control form-control-lg selectize" id="twoFactor" name="twoFactor">
                                <option value="1" {{($setting->twoFactor==1)?'selected':''}}>ON</option>
                                <option value="2" {{($setting->twoFactor==2)?'selected':''}}>OFF</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> Password <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control form-control-lg password" placeholder="Enter your password" name="password">
                        </div>
                    </div>



                    <div class="col-lg-12 text-center">
                        <button type="submit" class="default-btn submit">
                            Save Change
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @push('js')
        <script src="{{asset('requests/dashboard/orders.js')}}"></script>
        <script>
            $(document).ready(function() {
                $('.toggle-btn').click(function() {
                    var passwordInput = $('.password');
                    var type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                    passwordInput.attr('type', type);

                    // Change button text
                    var buttonText = type === 'password' ? 'Show Password' : 'Hide Password';
                    $(this).text(buttonText);
                });
            });
        </script>
    @endpush
@endsection
