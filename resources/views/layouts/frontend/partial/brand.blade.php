<section class="light-bg pt-80 pb-50">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="brands list-unstyled d-flex flex-wrap align-items-center justify-content-center justify-content-md-between mb-0">
                    @foreach($brands as $key => $brand)
                        <li data-animate="fadeInUp" data-delay=".05"><img src="{{ url('storage/brand/'. $brand->image) }}" width="100" height="80" alt="{{ $brand->name }}" title="{{ $brand->name }}"></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>