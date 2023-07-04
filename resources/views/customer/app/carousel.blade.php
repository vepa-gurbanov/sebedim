<div class="d-flex row justify-content-between mt-3 p-3 bg-white rounded" style="min-height: 25rem">
    <div class="col-3">
        <div class="h6">
            My markets <hr>
        </div>
        @foreach($categories as $category)

            <div class="dropend hover-dropend mb-3">
                <div class="category" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex justify-content-start">
                        <img src="{{ asset('img/user-profile.png') }}" alt="{{ $category->name }}" class="img-fluid rounded" height="24" width="24">
                        <span class="ms-2">{{ $category->name }}</span>
                    </div>
                    <i class="bi-chevron-right"></i>
                </div>
                <div class="dropdown-menu c-d-menu">
                    <div class="row justify-content-between m-3">
                        @foreach($category->child as $child)
                            <div class="col-4">
                                <a href="#" class="small text-decoration-none text-black fw-bold mb-3">{{ $child->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        @endforeach
    </div>
    <div class="col-6">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/slider1.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/slider2.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/slider3.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="col-3">ddewdewdfew</div>
</div>
