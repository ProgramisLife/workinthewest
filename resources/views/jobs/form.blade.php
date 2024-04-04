<head>
    <!-- Skrypt JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Wprowadź Tytuł" value="{{ $titleValue }}">
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
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

        </div>

        <div class="form-group">
            <label for="photo">Wgraj zdjęcie profilowe do twojej pracy:</label>
            <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpg, .jpeg, .png">
        </div>

        <!-- Kategoria pracy -->
        <div class="d-flex my-3">
            <div class="col-lg-6 form-group mx-1 d-sm-block">
                <label class="text-uppercase" for="categories">kategoria oferty pracy *</label>
                <select class="form-control @error('category') is-invalid @enderror" id="categories" name="category">
                    @foreach($jobcategories as $category)
                    <option value="{{$category->id}}" {{ old('category') == $category->id ? 'selected' : '' }}>{{$category->category}}</option>
                    @endforeach
                </select>
                @error('category')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Poziom stanowiska -->
            <div class="col-lg-6 form-group mx-1 d-sm-block">
                <label class="text-uppercase" for="levels">poziom stanowiska *</label>
                <select class="form-control @error('level') is-invalid @enderror" id="levels" name="level">
                    @foreach($joblevels as $level)
                    <option value="{{$level->id}}" {{ old('level') == $level->id ? 'selected' : '' }}>{{$level->level}}</option>
                    @endforeach
                </select>
                @error('level')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <!-- Wynagrodzenie od -->
        <div class="d-flex justify-content-between">
            <div class="col-6 mx-1 form-group d-inline-block my-3">
                <label class="text-uppercase" for="salary_from">
                    wynagrodzenie od
                </label>
                <input type="text" class="form-control @error('salary_from') is-invalid @enderror" id="salary_from" name="salary_from" placeholder="4000" value="{{ $salaryFromValue }}">
                @error('salary_from')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Wynagrodzenie do -->
            <div class="col-6 form-group mx-1 my-3 d-inline-block">
                <label class="text-uppercase" for="salary_to">
                    wynagrodzenie do
                </label>
                <input type="text" class="form-control @error('salary_to') is-invalid @enderror" id="salary_to" name="salary_to" placeholder="10000" value="{{ $salaryToValue }}">
                @error('salary_to')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <!-- Języki -->
        <div class="form-group">
            <label for="language" class="text-uppercase">języki</label>
            <select multiple class="form-control" id="language" name="language[]">
                @foreach($joblanguages as $language)
                <option value="{{$language->id}}" @if(in_array($language->id, $languageValue)) selected @endif>{{$language->language}}</option>
                @endforeach
            </select>
        </div>

        <!-- Wymiar pracy -->
        <div class="form-group mx-1 my-2">
            <label class="text-uppercase" for="types">wymiar pracy *</label>
            <select multiple class="form-control @error('type') is-invalid @enderror" id="types" name="type[]">
                @foreach($jobtypes as $type)
                <option value="{{$type->id}}" @if(in_array($type->id, $typeValue)) selected @endif>{{$type->type}}</option>
                @endforeach
            </select>
            @error('type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Waluta -->
        <div class="d-flex justify-content-start">
            <div class="form-group my-3 mx-2 d-inline-block">
                <label class="text-uppercase" for="currency">waluta *</label>
                <select class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency">
                    @foreach($jobcurrencies as $currency)
                    <option value="{{$currency->id}}" {{ old('currency') == $currency->id ? 'selected' : '' }}>{{$currency->currency}}</option>
                    @endforeach
                </select>
                @error('currency')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Płeć -->
            <div class="form-group my-3 mx-2 d-inline-block">
                <label class="text-uppercase" for="sex">Płeć</label>
                <select class="form-control @error('sex') is-invalid @enderror" id="sex" name="sex">
                    @foreach($sexOptions as $option)
                    <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                    @endforeach
                </select>
                @error('sex')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <!-- Email oraz data -->
        <div class="my-3 text-uppercase font-weight-bold h3">ustawienia aplikacji</div>
        <div class="d-flex row my-3">
            <div class="col-5 form-group mx-2 d-inline-block">
                <label class="text-uppercase" for="email">
                    e-mail do składania aplikacji*
                </label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="administrator123@work.pl" value="{{ $emailValue }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-5 form-group mx-2 d-inline-block">
                <label class="text-uppercase" for="datepicker">termin składania aplikacji</label>
                <input id="datepicker" width="300" name="deadline" value="{{ $deadlineValue }}" />
                <script>
                    $('#datepicker').datepicker({
                        uiLibrary: 'bootstrap5',
                        format: "dd-mm-yyyy", // Zaktualizuj format daty na "dd-mm-yyyy"
                        startView: "months",
                        minViewMode: "months",
                    });
                </script>
            </div>

        </div>

        <!-- Wymagane umiejętności -->
        <div class="form-group">
            <label class="text-uppercase h3 my-3" for="skills">wymagane umiejętności</label>
            <select multiple class="form-control" id="skills" name="skills[]">
                @foreach($jobskills as $skill)
                <option value="{{$skill->id}}" @if(in_array($skill->id, $skillValue)) selected @endif>{{$skill->skill}}</option>
                @endforeach
            </select>
        </div>

        <!-- Zdjęcia -->
        <div class="form-group my-3">
            <label for="photos">Zdjęcia</label>
            <input type="file" name="photos[]" class="form-control-file" id="photos" multiple accept=".jpg, .jpeg, .png, ,svg">
        </div>

        <!-- Wyróżnione -->
        <input type="hidden" name="featured" value="false">

        <!-- Data wygaśnięcia -->
        <input type="hidden" name="expiry" value="{{ $expiry }}" />

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <button type="submit" class="btn btn-primary my-3 d-block">
            {{ $submitBtnText }}
        </button>
        @method($method ?? 'POST')
    </form>
</div>