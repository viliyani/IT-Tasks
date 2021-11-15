@props([
'buttonPosition',
'buttonTitle',
'buttonLink',
'buttonColor',
'buttonIcon',
'buttonIsNew',
'colSize'
])
<div {{ $attributes->merge(['class' => 'col-'.$colSize.' button-box-container']) }}>
    <div class="button-box" data-button-position="{{ $buttonPosition }}" data-button-title="{{ $buttonTitle }}"
        data-button-link="{{ $buttonLink }}" data-button-color="{{ $buttonColor }}" data-button-icon="{{ $buttonIcon }}"
        data-button-is-new="{{ $buttonIsNew }}" style="color: {{ $buttonColor }};">
        <div class="icon-box">
            <i class="{{ $buttonIcon }}"></i>
        </div>
    </div>
    <div class="button-overlay-info">
        <div class="button-title-box">
            {{ $buttonTitle }}
        </div>
        <div class="button-data-options">
            <div class="position-info">Position: {{ $buttonPosition }}</div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('buttons.edit', $buttonPosition) }}" class="btn btn-sm btn-warning">Edit</a>
                </div>
                <div class="col">
                    <form method="POST" action="/buttons/{{$buttonPosition}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger {{  $buttonIsNew == "1" ? "disabled-delete-btn" : "" }}" type="submit" {{  $buttonIsNew == "1" ? "disabled" : "" }}>Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>