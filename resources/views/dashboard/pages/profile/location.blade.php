@extends('dashboard.layout.base')
@section('content')
    @inject('option','App\Traits\Custom')
    <div class="profile-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="profile-information">
                        <h6>Location Information</h6>
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                <tr>
                                    <th scope="row">Full Name :</th>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Display Name :</th>
                                    <td>{{$user->displayName}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Username :</th>
                                    <td>{{$user->username}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile :</th>
                                    <td>
                                        <a href="{{$user->phoneCode}}{{$user->phone}}">{{$user->phoneCode}}{{$user->phone}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail :</th>
                                    <td>
                                    {{$user->email}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Country :</th>
                                    <td>{{$option->getCountryByCode($user->countryCode)->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">State :</th>
                                    <td>{{$option->getStateById($user->state)->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">City :</th>
                                    <td>{{$option->getCityById($user->city)->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status :</th>
                                    <td>
                                        @switch($user->isPublic)
                                            @case(1)
                                                <span class="badge bg-success">Public</span>
                                            @break
                                            @default
                                                <span class="badge bg-danger">Private</span>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ui-kit-cards grid mb-24 ">

                        <form class="row g-3" id="editOrder" action="{{route('user.profile.location.set')}}"
                              method="post">
                            @csrf
                            <div class="col-md-6 mt-3">
                                <label for="inputEmail4" class="form-label">
                                    Display Name<sup class="text-danger">*</sup>
                                    <i class="ri-information-fill" data-bs-toggle="tooltip" title="The name to display in place of your real name"></i>
                                </label>
                                <input type="text" class="form-control form-control-lg" id="inputEmail4" name="displayName" value="{{$user->displayName}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="inputPassword4" class="form-label">
                                    Phone<sup class="text-danger">*</sup>
                                    <i class="ri-information-fill" data-bs-toggle="tooltip" title="Mobile number - we will call to verify this number is reachable"></i>
                                </label>
                                <input type="text" name="phone" class="form-control form-control-lg" id="inputPassword4"
                                       value="{{$user->phone}}">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="inputEmail4" class="form-label">Country<sup class="text-danger">*</sup></label>
                                <select name="country" class="form-control form-control-lg selectize" id="inputEmail4"
                                        required>
                                    <option value="">Select country</option>
                                    @foreach($countries as $country)
                                        @if($country->iso3 ==$user->countryCode)
                                            <option value="{{$country->iso3}}" selected>{{$country->name}}</option>
                                            @continue
                                        @endif
                                        <option value="{{$country->iso3}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="inputEmail4" class="form-label">State/Region<sup class="text-danger">*</sup></label>
                                <select name="state" class="form-control form-control-lg state" id="inputEmail4"
                                        required>
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="inputEmail4" class="form-label">City<sup class="text-danger">*</sup></label>
                                <select name="city" class="form-control form-control-lg state" id="inputEmail4"
                                        required>
                                </select>
                            </div>

                            <div class="col-12 text-center mt-5">
                                <button type="submit" class="default-btn submit rounded-pill">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @push('js')
        <script src="{{asset('requests/dashboard/orders.js')}}"></script>
        <script>
            $(function() {
                function fetchData(url, dataKey,values,keys, dropdownName, placeholder) {
                    var value = [values]

                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: { [keys]: value },
                        beforeSend: function() {
                            $('.submit').attr('disabled', true);
                            $(".submit").LoadingOverlay("show", { text: "Please wait ...", size: "20" });
                        }
                    })
                        .done(function(data) {
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");

                            if (data.error === true) {
                                toastr.options = { "closeButton": true, "progressBar": true };
                                toastr.error(data.data.error);
                            } else if (data.error === 'ok') {
                                $('select[name="' + dropdownName + '"]').empty().append('<option value="">' + placeholder + '</option>');

                                $.each(data.data[dataKey], function(index, item) {
                                    $('select[name="' + dropdownName + '"]').append('<option value="' + item.id + '">' + item.name + '</option>');
                                });
                                $('select[name="' + dropdownName + '"]').addClass('selectize');
                            }
                        })
                        .fail(function(xhr, status, error) {
                            toastr.options = { "closeButton": true, "progressBar": true };
                            toastr.error(error);
                        });
                }

                $(document).ready(function() {
                    $('select[name="country"]').change(function() {
                        var value = $(this).val();
                        fetchData("{{route('user.fetch_country_states')}}", 'states', value,'country', 'state', 'Select a State');
                    });

                    $('select[name="state"]').change(function() {
                        var value = $(this).val();
                        fetchData("{{route('user.fetch_state_city')}}", 'cities',value,'state','city', 'Select a City');
                    });
                });
                $(document).ready(function() {
                    var value = $('select[name="country"]').val();
                    fetchData("{{route('user.fetch_country_states')}}", 'states', value, 'country', 'state', 'Select a State');
                });
            });

        </script>
    @endpush
@endsection
