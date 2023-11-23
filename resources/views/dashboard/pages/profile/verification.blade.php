@extends('dashboard.layout.base')
@section('content')

    <div class="container-fluid">
        @if($user->isVerified==4)
            <div class="alert-email">
                <i class="ri-notification-3-fill"></i>
                <span class="email-text">Pending: Submission has been received</span>

                <div class="email-content">
                    <p class="free-report">We are currently reviewing your Verification submission.</p>
                    <p class="report">
                        If we take time to approve your profile, please chat up support on the livechat with your ID.
                    </p>

                    <p class="dastone">Thanks for choosing <span>{{$siteName}}</span><br/> Admin.</p>
                </div>
            </div>
        @elseif($user->isVerified==1)
            <div class="alert-email">
                <i class="ri-check-double-fill"></i>
                <span class="email-text">Success: Submission has been approved</span>

                <div class="email-content">
                    <p class="free-report">We have completed the review of your account verification</p>
                    <p class="report">
                        If we need more information from you later, we will let you know.
                    </p>

                    <p class="dastone">Thanks for choosing <span>{{$siteName}}</span><br/> Admin.</p>
                </div>
            </div>
        @else
            <div class="submit-property-area col-md-12 mx-auto">
                <div class="container-fluid">
                    <form class="submit-property-form" method="post" action="{{route('user.verification.submit')}}"
                          enctype="multipart/form-data" id="editOrder">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label>Video Sample</label>
                                            <div class="file-upload">
                                                <img src="{{asset('dashboard/images/cover-img.jpg')}}" style="height: 140px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label>Live Video<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                title="Make a short vide pronouncing the word BURST"></i> </label>
                                            <div class="file-upload">
                                                <input type="file" name="liveVideo" accept="video/*" id="file" class="inputfile">
                                                <label class="upload" for="file">
                                                    <i class="ri-video-add-fill"></i>
                                                    Upload Live Video
                                                </label>
                                            </div>
                                            <small>Make a short vide pronouncing the word <b>BURST</b></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label>Image Sample</label>
                                            <div class="file-upload">
                                                <img src="{{asset('dashboard/images/cover-img.jpg')}}" style="height: 140px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label>Live Image</label>
                                            <div class="file-upload">
                                                <input type="file" name="liveImage" accept="image/*" id="image" class="inputfile">
                                                <label class="upload" for="image">
                                                    <i class="ri-image-add-fill"></i>
                                                    Upload Live Image
                                                </label>
                                            </div>
                                            <small>
                                                On a plain paper, write the word <b>{{$siteName}}</b>. Below the word, write:
                                                <b>MY USERNAME IS {{$user->username}}</b>. Hold the paper and snap yourself while
                                                holding the picture. Ensure that the image is clear enough.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 text-center">
                                <button type="submit" class="default-btn me-3 submit">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

    @push('js')
        <script src="{{asset('requests/dashboard/escortVerification.js')}}"></script>
    @endpush
@endsection
