@extends('dashboard.layout.base')
@section('content')
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endpush
<div class="container-fluid">
    <div class="order-details-area mb-5">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <form class="search-bar d-flex">
                        <i class="ri-search-line"></i>
                        <input class="form-control search" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="add-new-orders">
                        <button data-bs-target="#upload_photo" data-bs-toggle="modal" href="#" class="new-orders">
                            Upload new photos
                            <i class="ri-add-circle-line"></i>
                        </button>
                    </div>
                </div>

            </div>

            <div class="latest-transaction-area">
                <div class="table-responsive" data-simplebar>
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">PHOTO</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($photos as $photo)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <span class="badge bg-primary">#{{$photo->reference}}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{$photo->photo}}" data-lightbox="images">
                                        <img src="{{$photo->photo}}" width="100" height="100" class="img-thumbnail"/>
                                    </a>
                                    <sup>
                                        @if($photo->isProfile==1)
                                            <span class="badge bg-success">Profile Photo</span>
                                        @endif
                                    </sup>
                                </td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @if($photo->isProfile!=1)
                                                <li>
                                                    <a class="dropdown-item" href="{{route('user.gallery.setProfile',['id'=>$photo->reference])}}">
                                                        Make Profile Image
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{route('user.gallery.delete',['id'=>$photo->reference])}}">
                                                    Delete
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5">
                        {{$photos->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


    @push('js')
        @include('dashboard.pages.modal.gallery_modal')
        <script src="{{asset('requests/dashboard/gallery.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('.inputfile').change(function () {
                    var maxFilesAllowed=5

                    if (this.files.length > maxFilesAllowed) {

                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.error('You can only upload a maximum of ' + maxFilesAllowed + ' photos.');
                        // Clear the file input to prevent further processing
                        $(this).val('');
                    } else {
                        displaySelectedImages(this);
                    }
                });

                $('#selectedImages').on('click', '.remove-btn', function () {
                    // Remove the parent div containing the image
                    $(this).closest('.image-container').remove();
                });
                function displaySelectedImages(input) {
                    var selectedImagesDiv = $('#selectedImages');
                    selectedImagesDiv.empty(); // Clear previous selections

                    if (input.files && input.files.length > 0) {
                        for (var i = 0; i < input.files.length; i++) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                var imageContainer = $('<div class="mb-3 image-container"></div>');
                                var image = $('<img src="' + e.target.result + '" class="img-thumbnail" width="100" height="100">');
                                var actionsContainer = $('<div class="image-actions"></div>');
                                var zoomBtn = $('<button class="btn btn-secondary btn-sm zoom-btn"><i class="fas fa-search-plus"></i> Zoom</button>');
                                var removeBtn = $('<i class="fas fa-trash text-danger"></i>');

                                //actionsContainer.append(zoomBtn);
                                actionsContainer.append(removeBtn);

                                imageContainer.append(image);
                                imageContainer.append(actionsContainer);


                                selectedImagesDiv.append(imageContainer);
                            };

                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                }
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    @endpush
@endsection
