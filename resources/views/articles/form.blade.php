<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
</head>
<div class="bg-light col-lg-10 col-sm-6">
    <form action="{{ $action }}" method="{{ $formMethod ?? 'POST' }}" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row">
            <!-- Tytuł -->
            <div class="form-group my-3">
                <label class="text-uppercase" for="title">
                    Tytuł*
                </label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    placeholder="Wprowadź Tytuł" value="{{ $titleValue }}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="photo">Wgraj zdjęcie profilowe do twojego artykułu:</label>
                <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpg, .jpeg, .png">
            </div>

            <!-- Opis -->
            <div class="form-group my-3">
                <label for="description" class="text-uppercase">
                    Opis*
                </label>
                <textarea autofocus class="form-control @error('description') is-invalid @enderror" id="editor"
                    name="description" rows="5">{{ $descriptionValue }}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Źródło -->
            <div class="form-group my-3">
                <label class="text-uppercase" for="source">
                    Źródło*
                </label>
                <input type="text" class="form-control @error('source') is-invalid @enderror" id="source" name="source"
                    placeholder="Link do źródła" value="{{ $sourceValue }}">
                @error('source')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary my-3 d-block">
                {{ $submitBtnText }}
            </button>
            @method($method ?? 'POST')
    </form>
</div>
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
</script>