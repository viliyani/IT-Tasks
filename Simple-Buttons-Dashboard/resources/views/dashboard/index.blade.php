<x-app-layout>
    <div class="container">
        <div class="text-center mt-4">
            <h1 class="page-title">Simple Buttons Dashboard</h1>
        </div>
        @include('common.flash-messages')

        <div class="row text-center mt-4">

            @foreach ($buttonsData as $button)
                <x-button-box colSize="4" buttonPosition="{{ $button['position'] }}" buttonTitle="{{ $button['title'] }}" buttonLink="{{ $button['link'] }}"
                    buttonColor="{{ $button['color'] }}" buttonIcon="{{ $button['icon'] }}" buttonIsNew="{{ $button['is_new'] }}" />
            @endforeach

        </div>
        <div class="row">
            <div class="col-md-12 mt-5 mb-3 text-center">
                <div>
                    To update or delete any button's data, click the button:
                </div>
                <div class="mt-2">
                    <button class="btn btn-info modify-data-btn">Modify Data</button>
                    <button class="btn btn-primary close-modifier-btn">Close Data Modifier</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>