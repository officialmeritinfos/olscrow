<div class="blog-details-content">
    @inject('injected','App\Traits\Custom')
    <ul class="comment" id="comments" style="margin-bottom: 5rem;">
        @foreach($reviews as $review)
            <li>
                <img src="https://ui-avatars.com/api/?name={{$injected->getUserById($review->reviewer)->displayName??'N/A'}}" alt="Image">
                <h3>{{$injected->getUserById($review->reviewer)->displayName??'N/A'}}</h3>
                <span>{{date('d, F Y')}}</span>
                <p>
                    {{$review->content}}
                </p>
            </li>
        @endforeach
    </ul>

    <div class="leave-reply">
        <h3>Leave A Review<i class="ri-information-fill" data-bs-toggle="tooltip" title="Only if you have made at least one or more successful bookings"></i> </h3>

        <form method="post" action="{{route('user.hall.escort.review')}}" id="reviewEscort">
            <div class="row">
                <div class="col-lg-6 col-sm-6" style="display: none;">
                    <div class="form-group">
                        <label>Escort*</label>
                        <input type="text" name="escort" id="name" class="form-control" value="{{$escort->reference}}">
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea name="content" class="form-control" id="message" rows="8"></textarea>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <button type="submit" class="default-btn submit">
                        Post Review
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
