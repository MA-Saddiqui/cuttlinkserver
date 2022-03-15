@section('site_title', formatTitle([__('New'), __('Page'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('admin.dashboard'), 'title' => __('Admin')],
    ['url' => route('admin.faqs'), 'title' => __('Faqs')],
    ['title' => __('New')],
]])

<h2 class="mb-3 d-inline-block">{{ __('New') }}</h2>

<div class="card border-0 shadow-sm">
    <div class="card-header"><div class="font-weight-medium py-1">{{ __('FAQ') }}</div></div>
    <div class="card-body">
        @include('shared.message')

        <form action="{{ route('admin.faqs.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="i_title">{{ __('Question') }}</label>
                <input type="text" name="question" id="i_title" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" value="{{ old('question') }}">
                @if ($errors->has('question'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label>{{ __('Visibility') }}</label>
                <div class="row">
                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="status" id="i_footer" value="1" @if(old('status')) checked @endif>
                            <label class="custom-control-label" for="i_footer">{{ __('Status') }}</label>
                            @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="i_content">{{ __('Answer') }}</label>
                <textarea name="answer" id="i_content" class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}">{{ old('answer') }}</textarea>
                @if ($errors->has('answer'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('answer') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" name="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </form>
    </div>
</div>

@push('js')
<script src="{{asset('ckeditor/ckeditor/ckeditor.js')}}"></script>
<script>
        CKEDITOR
            .replace( document.querySelector( '#i_content' ),{
                extraPlugins: 'forms',
                filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            } );
</script>
@endpush
