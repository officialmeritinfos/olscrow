@extends('dashboard.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')

    <div class="profile-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">


                    <div class="profile-face">
                        <div class="row align-items-end justify-content-center">
                            <div class="col-lg-12 col-md-12 text-center">
                                <div class="avatar">
                                    <img src="{{empty($escort->photo)?'https://ui-avatars.com/api/?name='.$escort->name.'&background=random&round=true':$escort->photo}}"
                                         alt="Images" class="img-thumbnail" style="width: 150px;">
                                    <h3>
                                        {{empty($escort->displayName)?ucfirst($escort->username):$escort->displayName}}
                                        @if($escort->isVerified==1)
                                            <i class="ri-checkbox-circle-fill text-success" style="font-size: 1.5rem;"
                                               data-bs-toggle="tooltip" title="Verified Profile"></i>
                                        @endif
                                    </h3>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="projects">
                                    <p>
                                        {!! \Illuminate\Support\Str::words($injected->fetchEscortProfile($escort->id)->shortBio) !!}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="profile-information">
                        <h6>BIO</h6>
                        <p>
                            {!! \Illuminate\Support\Str::words($injected->fetchEscortProfile($escort->id)->about) !!}
                        </p>

                    </div>

                    <div class="profile-face" id="userFeatures">
                        <div class="row align-items-end justify-content-center">
                            <h6 class="mb-3">Escort Features</h6>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$injected->convertToAge($escort->dateOfBirth)}} Yrs</h6>
                                    <p>Age</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$injected->fetchEscortProfile($escort->id)->education}}</h6>
                                    <p>Education</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$injected->fetchEscortProfile($escort->id)->occupation}}</h6>
                                    <p>Occupation</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$injected->getUserFeature($injected->fetchEscortProfile($escort->id)->weight)->name}}</h6>
                                    <p>Weight</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$injected->getUserFeature($injected->fetchEscortProfile($escort->id)->height)->name}}</h6>
                                    <p>Height</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$injected->getUserFeature($injected->fetchEscortProfile($escort->id)->bustSize)->name}}</h6>
                                    <p>Bust Size</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$injected->getUserFeature($injected->fetchEscortProfile($escort->id)->build)->name}}</h6>
                                    <p>Build</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$injected->getUserFeature($injected->fetchEscortProfile($escort->id)->looks)->name}}</h6>
                                    <p>Looks</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$injected->getUserFeature($injected->fetchEscortProfile($escort->id)->ethnicity)->name}}</h6>
                                    <p>Ethnicity</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6 style="word-break: break-word;">{{$injected->fetchEscortProfile($escort->id)->sexualOrientation}}</h6>
                                    <p>Sexual Orientation</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-face" id="userFeatures">
                        <div class="row align-items-end justify-content-center">
                            <h6 class="mb-3">Escort Services</h6>
                            @php
                                $servs = explode(',',$profile->services)
                            @endphp
                            @foreach($servs as $serv)
                                <div class="col-lg-4 col-sm-6 col-md-4">
                                    <div class="projects">
                                        <h6></h6>
                                        <p>{{$injected->getServiceById($serv)->name}}</p>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    @include('dashboard.pages.hall.menu')

                    @includeWhen(url()->current()==route('user.escort.detail',['username'=>$escort->username]),'dashboard.pages.hall.pages.home')
                    @includeWhen(url()->current()==route('user.escort.reviews',['username'=>$escort->username]),'dashboard.pages.hall.pages.reviews')
                    @includeWhen(url()->current()==route('user.escort.gallery',['username'=>$escort->username]),'dashboard.pages.hall.pages.gallery')

                </div>
            </div>
        </div>
    </div>


@endsection
