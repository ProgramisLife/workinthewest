<div class="bg-light col-lg-10 col-sm-6">
    <form action="{{ $action }}" method="{{ $formMethod ?? 'POST' }}" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row">
            <!-- Tytuł -->
            <div class="form-group my-3">
                <label class="text-uppercase" for="title">
                    Tytuł*
                </label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Wprowadź Tytuł" value="{{ $titleValue }}">
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
                <textarea autofocus class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ $descriptionValue }}</textarea>
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
                <input type="text" class="form-control @error('source') is-invalid @enderror" id="source" name="source" placeholder="Link do źródła" value="{{ $sourceValue }}">
                @error('source')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Youtube -->
            <div class="form-group my-3">
                <label class="text-uppercase" for="youtube">
                    Youtube
                </label>
                <input type="text" class="form-control @error('youtube') is-invalid @enderror" id="youtube" name="youtube" placeholder="Link do youtuba" value="{{ $youtubeValue }}">
                @error('youtube')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Facebook -->
            <div class="form-group my-3">
                <label class="text-uppercase" for="facebook">
                    Facebook
                </label>
                <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" placeholder="Link do facebooka" value="{{ $facebookValue }}">
                @error('facebook')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Vimeo -->
            <div class="form-group my-3">
                <label class="text-uppercase" for="vimeo">
                    Vimeo
                </label>
                <input type="text" class="form-control @error('vimeo') is-invalid @enderror" id="vimeo" name="vimeo" placeholder="Link do Vimeo" value="{{ $vimeoValue }}">
                @error('vimeo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- X -->
            <div class="form-group my-3">
                <label class="text-uppercase" for="vimeo">
                    X
                </label>
                <input type="text" class="form-control @error('x') is-invalid @enderror" id="x" name="x" placeholder="Link do X" value="{{ $xValue }}">
                @error('x')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Linkedin -->
            <div class="form-group my-3">
                <label class="text-uppercase" for="linkedin">
                    Linkedin
                </label>
                <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" name="linkedin" placeholder="Link do Linkedin" value="{{ $linkedinValue }}">
                @error('linkedin')
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