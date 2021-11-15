<x-app-layout>
    <div class="container">
        <div class="text-center mt-4">
            <h1 class="page-title">Edit Button's Data</h1>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        Edit Data
                    </div>
                    <div class="card-body">
                        @include('common.flash-messages')

                        <form class="row g-3" method="POST" action="{{ route('buttons.update',$button->position) }}">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <label for="buttonTitle" class="form-label fw-bold">Title:</label>
                                <input type="text" class="form-control edit-input-title" id="buttonTitle" name="title"
                                    value="{{ $button->title }}">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="buttonLink" class="form-label fw-bold">Link:</label>
                                <input type="text" class="form-control edit-input-link" id="buttonLink" name="link"
                                    value="{{ $button->link }}">
                                @error('link')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="buttonColor" class="form-label fw-bold">Color:</label>
                                <input type="color" class="form-control edit-input-color" id="buttonColor" name="color"
                                    value="{{ $button->color }}">
                                @error('color')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="buttonIcon" class="form-label fw-bold">Icon:</label>
                                <input type="text" class="form-control edit-input-icon" id="buttonIcon" name="icon"
                                    value="{{ $button->icon }}" data-fa-browser>
                                @error('icon')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success w-100">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        Preview
                    </div>
                    <div class="card-body text-center edit-button-preview-box">
                        <x-button-box class="mx-auto" colSize="9" buttonPosition="{{ $button->position }}" buttonTitle="{{ $button->title }}" buttonLink="{{ $button->link }}"
                            buttonColor="{{ $button->color }}" buttonIcon="{{ $button->icon }}" buttonIsNew="0" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="additionalCss">
        <link href="{{ asset('css/fontawesome-browser.css') }}" rel="stylesheet" />
    </x-slot>

    <x-slot name="additionalJs">
        <script src="{{ asset('js/fontawesome-browser.js') }}"></script>
        <script src="{{ asset('js/auto-button-preview.js') }}"></script>

        <script>
            $(function($) {
                $.fabrowser();
            });
        </script>
    </x-slot>

</x-app-layout>