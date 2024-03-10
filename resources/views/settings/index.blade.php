@extends('layouts.app')
@section('css')
    <style>
        #container {
            width: 1000px;
            margin: 20px auto;
        }

        .ck-editor__editable[role="textbox"] {
            /* Editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* Block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    {!! Form::open(['route' => 'settings.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{ csrf_field() }}
    @if (count($settings))
        @foreach ($settings as $setting)
            <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="" class="required">Setting Name</label>
                        <input type="text" name="key" class="form-control" value="{{ ucfirst(str_replace('_',' ', $setting->key))  }}">
                    </div>
                    {{-- <div class="col-md-6">
                            <label for="" class="required">Type</label>
                            <select name="" id="" class="form-control">
                                <option value="">1</option>
                            </select>
                        </div> --}}
                </div>
                <div class="form-group">
                    <textarea id="editor" class="form-control" rows="5" name="value">{{ $setting->value }}</textarea>
                </div>
            </div>
        @endforeach

    @else
        <div class="form-group">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="" class="required">Setting Name</label>
                    <input type="text" name="key" class="form-control">
                </div>
                {{-- <div class="col-md-6">
                        <label for="" class="required">Type</label>
                        <select name="" id="" class="form-control">
                            <option value="">1</option>
                        </select>
                    </div> --}}
            </div>
            <div class="form-group">
                <textarea id="editor" class="form-control" rows="5" name="value"></textarea>
            </div>
        </div>
    @endif
        <div class="pull-right">
            <button type="submit" class="btn btn-success">Update Settings</button>
        </div>
    {!! Form::close() !!}
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('#editor').summernote({
            tabsize: 2,
            height: 200
        });
    </script>
@endsection
