<div class="ui-kit-card grid mb-24" id="escortMenu">
    <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="{{route('user.escort.detail',['username'=>$escort->username])}}" class="nav-link {{url()->current()==route('user.escort.detail',['username'=>$escort->username])?'active':''}}"
               type="button" role="tab"
               aria-controls="pills-home"
               aria-selected="true">Home</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{route('user.escort.gallery',['username'=>$escort->username])}}#escortMenu" class="nav-link {{url()->current()==route('user.escort.gallery',['username'=>$escort->username])?'active':''}}"
               type="button" role="tab" aria-controls="pills-profile"
               aria-selected="false">Gallery</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{route('user.escort.reviews',['username'=>$escort->username])}}#escortMenu" class="nav-link {{url()->current()==route('user.escort.reviews',['username'=>$escort->username])?'active':''}}"
               type="button" role="tab" aria-controls="pills-profile"
               aria-selected="false">Reviews</a>
        </li>
    </ul>
</div>
