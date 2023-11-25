<!-- Modal -->
<div class="modal fade" id="upload_photo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Upload Photos
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3 submit-property-form" id="galleryUpload" action="{{route('user.gallery.upload')}}"
                      method="post">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Live Image</label>
                            <div class="file-upload">
                                <input type="file" name="photos[]" accept="image/*" id="image" multiple class="inputfile">
                                <label class="upload" for="image">
                                    <i class="ri-image-add-fill"></i>
                                    Upload at most 5 pictures
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="selectedImages"></div>

                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="default-btn submit rounded-pill">Upload Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
