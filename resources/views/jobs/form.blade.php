<head>
    <!-- Skrypt JavaScript -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/jobs/form.css') }}" type="text/css" />
</head>
<div class="bg-light col-lg-8 col-sm-6">
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

            <!-- Opis -->
            <div class="form-group my-3">
                <label for="description" class="text-uppercase">
                    Opis*
                </label>
                <textarea autofocus class="ckeditor form-control @error('description') is-invalid @enderror" id="editor"
                    name="description">{!! $descriptionValue !!}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>

        <!-- Zdjęcia -->
        <div class="titleheaders">zdjęcia</div>

        <div class="d-flex justify-content-between">
            <div class="form-group">
                <label for="photo">Zdjęcie profilowe:</label>
                @if($data['photo']['hasExistingPhoto'])
                <p>Obecne zdjęcie:</p>
                <img style="max-width: 10rem; max-height:10rem;"
                    src="{{ asset('images/jobs/main-photo/' . $job->main_image_path) }}" alt="Obecne zdjęcie">
                <p>Obecna nazwa pliku: {{ $job->main_image_path }}</p>
                <p>Jeśli chcesz zaktualizować to zdjęcie, wgraj nowe poniżej:</p>
                @else
                <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpg, .jpeg, .png">
                @endif
            </div>

            <!-- Zdjęcia -->
            <div class="form-group">
                <label for="photos">Zdjęcia</label>
                @if($data['photo']['hasExistingPhotos'])
                <p>Obecne zdjęcia:</p>
                <div class="text-align-center">
                    @foreach($job->photos as $photo)
                    <img style="max-width: 10rem; max-height:10rem;"
                        src="{{ asset('images/jobs/photos/' . $photo->photo) }}" alt="Zdjęcie">
                    <p>Obecna nazwa pliku: {{ Str::limit($photo->photo, 20) }} , </p>
                    @endforeach
                </div>
                @else
                <input type="file" name="photos[]" class="form-control-file" id="photos" multiple
                    accept=".jpg, .jpeg, .png, ,svg">
                @endif
            </div>
        </div>

        <!-- Wynagrodzenie od -->
        <div class="titleheaders">wynagordzenie</div>
        <div class="d-flex justify-content-start">
            <div class="col-4 form-group d-inline-block">
                <label class="text-uppercase" for="salary_from">
                    wynagrodzenie od
                </label>
                <input type="text" class="form-control @error('salary_from') is-invalid @enderror" id="salary_from"
                    name="salary_from" placeholder="4000" value="{{ $salaryFromValue }}">
                @error('salary_from')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Wynagrodzenie do -->
            <div class="col-4 form-group mx-2 d-inline-block">
                <label class="text-uppercase" for="salary_to">
                    wynagrodzenie do
                </label>
                <input type="text" class="form-control @error('salary_to') is-invalid @enderror" id="salary_to"
                    name="salary_to" placeholder="10000" value="{{ $salaryToValue }}">
                @error('salary_to')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Waluta -->
            <div class="col-3 form-group mx-2 d-inline-block">
                <label class="text-uppercase" for="currency">waluta *</label>
                <select class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency">
                    @foreach($data['job']['jobcurrencies'] as $currency)
                    <option value="{{$currency->id}}" {{ old('currency')==$currency->id ? 'selected' : ''}}>
                        {{$currency->currency}}
                    </option>
                    @endforeach
                </select>
                @error('currency')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <!-- Email oraz data -->
        <div class="titleheaders">ustawienia aplikacji</div>

        <div class="d-flex row my-3">
            <div class="d-flex justify-content-start">
                <div class="col-lg-4 form-group mx-1 d-sm-block">
                    <label class="text-uppercase" for="email">
                        e-mail do składania aplikacji*
                    </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="administrator123@work.pl" value="{{ $emailValue }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-lg-3 mx-4 form-group d-sm-block mx-2">
                    <label class="text-uppercase" for="datepicker">termin składania aplikacji</label>
                    <input id="datepicker" width="300" name="deadline" value="{{ $deadlineValue }}"
                        class="@error('deadline') is-invalid @enderror" />
                    @error('deadline')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <script>
                        $('#datepicker').datepicker({
                    uiLibrary: 'bootstrap5',
                    format: "yyyy-mm-dd",
                    startView: "months",
                    minViewMode: "months",
                    });
                    </script>
                </div>
            </div>

            <!-- Poziom stanowiska -->
            <div class="d-flex justify-content-start">
                <div class="col-lg-4 form-group mx-1 d-sm-block">
                    <label class="text-uppercase" for="levels">poziom stanowiska *</label>
                    <select class="form-control @error('level') is-invalid @enderror" id="levels" name="level">
                        @foreach($data['job']['joblevels'] as $level)
                        <option value="{{$level->id}}" {{ old('level')==$level->id ? 'selected' : ''
                            }}>{{$level->level}}
                        </option>
                        @endforeach
                    </select>
                    @error('level')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Kategoria pracy -->
                <div class="col-lg-4 form-group mx-4 d-sm-block">
                    <label class="text-uppercase" for="categories">kategoria oferty pracy *</label>
                    <select class="form-control @error('category') is-invalid @enderror" id="categories"
                        name="category">
                        @foreach($data['job']['jobcategories'] as $category)
                        <option value="{{$category->id}}" {{ old('category')==$category->id ? 'selected' :
                            ''}}>{{$category->category}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>


            <!-- wymiar pracy -->
            <div class="row justify-content-start">
                <div class="col-lg-3 my-3 form-group mx-1">
                    <label class="text-uppercase" for="types">wymiar pracy *</label>
                    <select multiple class="form-control @error('type') is-invalid @enderror" id="types" name="type[]">
                        @foreach($data['job']['jobtypes'] as $type)
                        <option value="{{$type->id}}" @if(in_array($type->id, $typeValue)) selected @endif>
                            {{$type->type}}
                        </option>
                        @endforeach
                    </select>
                    @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- języki -->
                <div class="col-lg-4 my-3 form-group mx-1">
                    <label for="language" class="text-uppercase">języki</label>
                    <select multiple class="form-control" id="language" name="language[]">
                        @foreach($data['job']['joblanguages'] as $language)
                        <option value="{{$language->id}}" @if(in_array($language->id, $languageValue)) selected @endif>
                            {{$language->language}}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-4 my-3 form-group mx-1">
                    <label for="jobstate" class="text-uppercase">rodzaj pracy</label>
                    <select multiple class="form-control" id="jobstate" name="jobstate[]">
                        @foreach($data['job']['jobstate'] as $jobstate)
                        <option value="{{$jobstate->id}}" @if(in_array($jobstate->id, $jobstateValue)) selected @endif>
                            {{$jobstate->name}}
                        </option>
                        @endforeach
                    </select>
                    @error('jobstate')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

        </div>

        <!-- Wymagane umiejętności -->
        <div class="form-group">
            <label class="titleheaders" for="skills">wymagane umiejętności</label>
            <select multiple class="form-control" id="skills" name="skills[]">
                @foreach($data['job']['jobskills'] as $skill)
                <option value="{{$skill->id}}" @if(in_array($skill->id, $skillValue)) selected @endif>{{$skill->skill}}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Płeć -->
        <div class="form-check my-3 d-inline-block">
            <label class="form-check-label titleheaders">płeć</label>
            @foreach($data['job']['sexOptions'] as $option)
            <div>
                <input class="form-check-input @error('sex') is-invalid @enderror" type="radio" id="sex_{{ $option }}"
                    name="sex" value="{{ $option }}">
                <label class="form-check-label" for="sex_{{ $option }}">{{ ucfirst($option) }}</label>
            </div>
            @endforeach
            @error('sex')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Państwo -->
        <div class="d-flex row my-3 justify-content-start">
            <div class="titleheaders">lokalizacja</div>
            <div class="col-3 form-group d-sm-block">
                <label class="text-uppercase" for="countries">wybierz kraj</label>
                <select class="form-control @error('countries') is-invalid @enderror" id="countries" name="countries">
                    @foreach ($data['countries'] as $country)
                    <option value="{{ $country->id }}" {{ old('countries')==$country->id ? 'selected' : '' }}>
                        {{ $country->country }}
                    </option>
                    @endforeach
                </select>
                @error('countries')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Stan -->
            <div class="col-4 form-group d-sm-block">
                <label class="text-uppercase" for="states">wybierz stan</label>
                <select class="form-control @error('states') is-invalid @enderror" id="states" name="states">
                    <!-- Opcje stanów zostaną dynamicznie wygenerowane za pomocą AJAX -->
                </select>
                @error('states')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Miasto -->
            <div class="col-4 form-group mx-1 d-sm-block">
                <label class="text-uppercase" for="cities">wybierz miasto</label>
                <select class="form-control @error('cities') is-invalid @enderror" id="cities" name="cities">
                    <!-- Opcje miast zostaną dynamicznie wygenerowane za pomocą AJAX -->
                </select>
                @error('cities')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <!-- Wyróżnione -->
        <input type="hidden" name="featured" value="false">

        <!-- Data wygaśnięcia -->
        <input type="hidden" name="expiry" value="{{ $data['job']['expiry'] }}" />

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

<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
</script>

<script>
    $(document).ready(function() {
        // Obsługa zmiany kraju
        $('#countries').change(function() {
            var countryId = $(this).val();
            if (countryId) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('jobs.getState') }}",
                    data: {
                        country_id: countryId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var states = response.states;
                        $('#states').empty();
                        if (states.length > 0) {
                            // Jeśli kraj ma stany, wyświetl je
                            $.each(states, function(key, value) {
                                $('#states').append('<option value="' + value.id +
                                    '">' + value.state + '</option>');
                            });
                        } else {
                            // Jeśli kraj nie ma stanów, wyczyść pole stanów i miast
                            $('#states').append('<option value="">Wybierz stan</option>');
                            $('#cities').empty().append(
                                '<option value="">Wybierz miasto</option>');
                        }
                    }
                });
            }
        });

        // Obsługa zmiany stanu
        $('#states').change(function() {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('jobs.getCity') }}",
                    data: {
                        state_id: stateId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var cities = response.cities;
                        $('#cities').empty();
                        $.each(cities, function(key, value) {
                            $('#cities').append('<option value="' + value.id +
                                '">' + value.city + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>