@extends('customer.layouts.app')
@section('content')
    <div class="d-flex justify-content-between">
        <div class="col-2 col-lg-2 col-xxl-3 my-3">

            <div class="bg-white border rounded p-1 px-2">
                    <div class="d-flex justify-content-between cursor-pointer collapse-down" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span>Price</span>
                        <span class="bi-caret-down-fill"></span>
                    </div>
                <div class="collapse" id="collapseExample">
                    <div class="">
                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                    </div>
                </div>
            </div>

        </div>
        <div class="col-auto">
            <div class="d-flex justify-content-between">

                <div class="col-auto"></div>
            </div>
        </div>
    </div>
@endsection
