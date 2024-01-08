<div class="container-fluid">

    @push('css')
        <style>
            .thumbnail-container {
                display: flex;
                flex-wrap: wrap;
            }

            .thumbnail {
                width: 200px; /* Adjust as needed */
                height: 200px; /* Adjust as needed */
                object-fit: cover; /* Maintain aspect ratio and cover the container */
                margin: 5px; /* Optional margin between thumbnails */
            }
        </style>
        <!-- Lightbox CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    @endpush
    <div class="ui-kit-card grid mb-24 row thumbnail-container justify-content-center">
        @php
            $cnt=1;
        @endphp
        @foreach($photos as $photo)

            <div class="col-md-3">
                <a href="{{$photo->photo}}" data-fancybox="gallery" data-caption="Image {{$cnt}} ">
                    <img src="{{$photo->photo}}" class="img-thumbnail thumbnail">
                </a>
            </div>
            @php
                $cnt++;
            @endphp
        @endforeach
    </div>


    @push('js')
            <!-- Lightbox JS -->
            <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    @endpush
</div>
