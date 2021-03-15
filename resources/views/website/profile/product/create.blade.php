@extends('website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">


    <style>
        .hidden{
            visibility: hidden;
        }
        .alert {
            text-align: center;
        }
        .alert-title {
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .alert-about {
            padding-bottom: 25px;
        }

        .images-holder {
            padding: 40px 0px 0px 0px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            perspective: 300px;
        }
        .images-holder__thumbnail {
            position: relative;
            padding-bottom: 40px;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            animation: AnimIn 500ms ease-in;
            flex-wrap: wrap;
            width: 150px;
        }
        .images-holder__holder {
            position: relative;
            width: 100px;
            height: 100px;
            overflow: hidden;
            border: solid 5px white;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
            display: inline-flex;
            justify-content: center;
            background: white;
        }
        .images-holder__holder:hover .images-holder__overlay {
            opacity: 1;
        }
        .images-holder__image {
            object-fit: scale-down;
        }
        .images-holder__title {
            padding: 10px;
            width: 100%;
            font-weight: bold;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .images-holder__overlay {
            position: absolute;
            left: 0;
            top: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            width: 100%;
            height: 100%;
            transition: opacity 500ms ease-in;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .images-holder__overlay span {
            color: white;
            font-size: 22px;
        }
        .images-holder__remove {
            position: absolute;
            top: -1em;
            width: 25px;
            height: 25px;
            background: black;
            content: "x";
            color: white;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.2);
            border: solid 2px white;
        }

        @keyframes AnimIn {
            0% {
                opacity: 0;
                transform: rotateX(5deg);
            }
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col s5">
            <div class="center-align">

            </div>
        </div>
        <div class="col s6">
            <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" value="name">
                @if($errors->has('name'))
                    <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                @endif
                <input type="text" name="title" placeholder="title">
                @if($errors->has('title'))
                    <span class="help-block text-danger">{{ $errors->first('title') }}</span>
                @endif
                <input type="text" name="tools" placeholder="tools">
                @if($errors->has('tools'))
                    <span class="help-block text-danger">{{ $errors->first('tools') }}</span>
                @endif
                <div class="form-group">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-info" data-image-uploader-app>
                                    <div class="alert alert-danger" data-image-uploader-error>
                                        <ul data-image-uploader-error-list></ul>
                                    </div>
                                    <h3 class="alert-title">
                                        <b>Upload your images</b>
                                    </h3>
                                    <p class="alert-about">
                                        You can upload your product pics!
                                    </p>
                                    <div style="margin-left: 50px;">
                                        <a data-image-uploader-button class="btn btn-primary btn-lg">
                                            <span class="glyphicon glyphicon-camera"></span>
                                            Upload Images
                                        </a>
                                    </div>
                                    <input data-image-uploader class="hidden" type="file" name="images[]" id="fileToUpload"  capture=camera" multiple/>
                                    <div data-image-uploads class="images-holder"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('images'))
                        <span class="help-block text-danger">{{ $errors->first('images') }}</span>
                    @endif
                </div>
                <input type="text" name="video_link" placeholder="video link">
                @if($errors->has('video_link'))
                    <span class="help-block text-danger">{{ $errors->first('video_link') }}</span>
                @endif

                <input type="text" name="tags" placeholder="tags">
                @if($errors->has('tags'))
                    <span class="help-block text-danger">{{ $errors->first('tags') }}</span>
                @endif

               <select name="category">
                   <option value="first">First</option>
                   <option value="">Second</option>
                   <option value="">Tree</option>
               </select>
                @if($errors->has('category'))
                    <span class="help-block text-danger">{{ $errors->first('category') }}</span>
                @endif
                <textarea name="desc_en"></textarea>
                <textarea name="desc_ru"></textarea>
                <textarea name="desc_sp"></textarea>
                <textarea name="desc_it"></textarea>
                <textarea name="desc_arm"></textarea>

                <input type="text" name="desc_seo">
                <input type="text" name="seo_keyword">
                <input type="submit" value="Make product">
            </form>
        </div>
@endsection
@section('js')
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script type="text/javascript">
        var $btn = $('[data-image-uploader-button]')
        var $uploaderApp = $('[data-image-uploader-app]')
        var $uploader = $('[data-image-uploader]')
        var $uploads = $('[data-image-uploads]')
        var $uploaderErrors = $('[data-image-uploader-error]')
        var $uploaderErrorList = $('[data-image-uploader-error-list]')

        var imageFiles = []
        var imageErrors = []

        function addThumbnail(file, index) {
            var $thumbnail = $('<div class="images-holder__thumbnail">')
            var $imgHolder = $('<div class="images-holder__holder">')
            var $img = $('<img class="images-holder__image">')
            var $imgOverlay = $('<div class="images-holder__overlay">')
            var $imgOverlayIcon = $('<span class="glyphicon glyphicon-eye-open">')
            var $title = $('<span class="images-holder__title">')
            var $imgRemove = $('<span data-image-upload="' + index + '" class="images-holder__remove">')
            $img.file = file
            $title.text(file.name)
            $imgHolder.append($img)
            $imgOverlay.append($imgOverlayIcon)
            $imgHolder.append($imgOverlay)
            $thumbnail.append($imgHolder)
            $thumbnail.append($title)
            $thumbnail.append($imgRemove)
            $uploads.append($thumbnail)

            var reader = new FileReader()
            reader.onload = (e) => $img[0].src = e.target.result
            reader.readAsDataURL(file)
        }

        function updateThumbnails(files)  {

            $uploads.empty()

            imageFiles = files

            imageFiles.forEach((file, index) => addThumbnail(file, index))

        }

        function getUniqueFiles(files) {
            return files.reduce((unique, file, i) => {
                var findFile = unique.find((u) => u.name === file.name)
                if (findFile === undefined) {
                    return unique.concat([file])
                }
                return unique
            }, [])
        }

        function addValidationError(messages) {
            var errorMessageList = messages.map((message) => {
                return $('<li>').text(message)
            })
        }

        function validateImage(file) {
            var valid = /^image\//.test(file.type)

            if (!valid) {
                imageErrors.push('Not an image.')
            }

            return valid
        }

        function validateImageSize(file) {
            return true
        }

        $uploaderErrors.hide()

        $btn.click(function() {
            $uploader.trigger('click')
        });

        $uploader.change(function() {
            var $this = $(this)
            var files = []
                .slice
                .call($this[0].files)
                .filter(validateImage)
                .filter(validateImageSize)

            var thumbnailFiles = getUniqueFiles(imageFiles.concat(files))

            updateThumbnails(thumbnailFiles)

        });

        $(document).on('click', '[data-image-upload]', function() {

            var index = $(this).attr('data-image-upload')

            imageFiles.splice(index, 1)

            updateThumbnails(imageFiles)

        })
    </script>
@endsection
