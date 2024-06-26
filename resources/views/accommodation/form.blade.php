<head>
    <!-- Skrypt JavaScript -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
</head>
<div class="container offset-2">
    <div class="row justify-content-start">
        <div class="bg-light col-lg-10 col-sm-6">
            <form action="{{ $action }}" method="{{ $formMethod ?? 'POST' }}" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row">
                    <!-- Tytuł -->
                    <div class="form-group my-3">
                        <label class="text-uppercase" for="title">
                            Tytuł*
                        </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" placeholder="Wprowadź Tytuł" value="{{ $titleValue }}">
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
                        <textarea autofocus class="ckeditor form-control @error('description') is-invalid @enderror"
                            id="editor" name="description">{!! $descriptionValue !!}</textarea>
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
                        @if($data['photos']['hasExistingPhoto'])
                        <p>Obecne zdjęcie:</p>
                        <img style="max-width: 10rem; max-height:10rem;"
                            src="{{ asset('images/accommodation/main-photo/' . $accommodation->main_image_path) }}"
                            alt="Obecne zdjęcie">
                        <p>Obecna nazwa pliku: {{ $accommodation->main_image_path }}</p>
                        <p>Jeśli chcesz zaktualizować to zdjęcie, wgraj nowe poniżej:</p>
                        <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpg, .jpeg, .png">
                        @else
                        <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpg, .jpeg, .png">
                        @endif
                    </div>

                    <!-- Zdjęcia -->
                    <div class="form-group">
                        <label for="photos">Zdjęcia</label>
                        @if($data['photos']['hasExistingPhotos'])
                        <p>Obecne zdjęcia:</p>
                        <div class="text-align-center">
                            @foreach($accommodation->photos as $photo)
                            <img style="max-width: 10rem; max-height:10rem;"
                                src="{{ asset('images/accommodation/photos/' . $photo->photo) }}" alt="Zdjęcie">
                            <p>Obecna nazwa pliku: {{ Str::limit($photo->photo, 20) }} , </p>
                            <p>Jeśli chcesz zaktualizować te zdjęcia, wgraj nowe poniżej:</p>
                            @endforeach
                            <input type="file" name="photos[]" class="form-control-file" id="photos" multiple
                                accept=".jpg, .jpeg, .png, ,svg">
                        </div>
                        @else
                        <input type="file" name="photos[]" class="form-control-file" id="photos" multiple
                            accept=".jpg, .jpeg, .png, ,svg">
                        @endif
                    </div>
                </div>

                <div class="d-flex row my-3 justify-content-start">
                    <div class="text-uppercase h3 my-3">informacje</div>
                    <!-- Kategoria wynajęcia -->
                    <div class="text-align-center">
                        <p class="text-uppercase my-1">kategorie</p>
                        @foreach ($data['accommodation']['accommodationCategory'] as $category)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input category_checkbox" type="checkbox"
                                id="category_{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                            <label class="form-check-label"
                                for="category_{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Cena do zakupu -->
                    <div class="col-4 form-group my-3" id="value1_field" style="display: none;">
                        <label class="text-uppercase" for="price_buy">
                            cena do zakupu
                        </label>
                        <input type="text" class="form-control @error('price_buy') is-invalid @enderror" id="price_buy"
                            name="price_buy" placeholder="4000" value="{{ $priceBuyValue }}">
                        @error('price_buy')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Cena do wynajmu -->
                    <div class="col-4 form-group my-3" id="value2_field" style="display: none;">
                        <label class="text-uppercase" for="price_rent">
                            cena do wynajęcia
                        </label>
                        <input type="text" class="form-control @error('price_buy') is-invalid @enderror" id="price_rent"
                            name="price_rent" placeholder="4000" value="{{ $priceRentValue }}">
                        @error('price_rent')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Waluta -->
                    <div class="col-3 form-group mx-1 my-3 d-inline-block">
                        <label class="text-uppercase" for="currency">waluta *</label>
                        <select class="form-control @error('currency') is-invalid @enderror" id="currency"
                            name="currency">
                            @foreach ($data['accommodation']['currency'] as $currency)
                            <option value="{{ $currency->id }}" @if (old('currency')==$currency->id) selected @endif>
                                {{ $currency->currency }}
                            </option>
                            @endforeach
                        </select>
                        @error('currency')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-3 form-group mx-1 my-3 d-inline-block">
                        <div class="form-group mx-2">
                            <label class="text-uppercase" for="datepicker">Data wygaśnięcia</label>
                            <input id="datepicker" width="200" name="expiry" value="{{ $expiryValue }}" />
                            <script>
                                $('#datepicker').datepicker({
                                    uiLibrary: 'bootstrap5',
                                    format: "yyyy-mm-dd", // Zaktualizuj format daty na "yyyy-mm-dd"
                                    startView: "months",
                                    minViewMode: "months",
                                });
                            </script>
                            @error('expiry')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Dodatkowe informacje -->
                <div class="my-3 text-uppercase font-weight-bold h3">informacje kontaktowe</div>
                <div class="d-flex row my-3">
                    <!-- Osoba kontaktowa / Nazwa firmy -->
                    <div class="col-5 form-group mx-2 d-inline-block">
                        <label class="text-uppercase" for="contact">
                            Osoba kontaktowa / Nazwa firmy*
                        </label>
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact"
                            name="contact" placeholder="Firma XYZ" value="{{ $contactValue }}">
                        @error('contact')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!-- E-mail -->
                    <div class="col-5 form-group mx-2 d-inline-block">
                        <label class="text-uppercase" for="email">
                            e-mail*
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="administrator123@work.pl" value="{{ $emailValue }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!-- Numer telefonu -->
                    <div class="col-5 form-group my-3 mx-2 d-inline-block">
                        <label class="text-uppercase" for="phone_number">
                            Numer telefonu
                        </label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                            id="phone_number" name="phone_number" placeholder="899 677 555" value="{{ $phoneNumber }}">
                        @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
        </div>

        <!-- Państwo -->
        <div class="d-flex row my-3 justify-content-start">
            <div class="titleheaders">Lokalizacja</div>
            <div class="col-3 form-group d-sm-block">
                <label class="text-uppercase" for="countries">Wybierz kraj</label>
                <select class="form-control @error('countries') is-invalid @enderror" id="countries" name="countries">
                    @foreach ($data['countries'] as $country)
                    <option value="{{ $country->id }}" {{ $country->id == $countryValue ? 'selected' : '' }}>
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
                <label class="text-uppercase" for="states">Wybierz stan</label>
                <select class="form-control @error('states') is-invalid @enderror" id="states" name="states"
                    data-selected="{{ $stateValue }}">
                    <option value="">Wybierz stan</option>
                </select>
                @error('states')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Miasto -->
            <div class="col-4 form-group mx-1 d-sm-block">
                <label class="text-uppercase" for="cities">Wybierz miasto</label>
                <select class="form-control @error('cities') is-invalid @enderror" id="cities" name="cities"
                    data-selected="{{ $cityValue }}">
                    <option value="">Wybierz miasto</option>
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

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="col-md-4 justify-content-start">
            <button type="submit" class="btn btn-primary my-3 d-block">
                {{ $submitBtnText }}
            </button>
        </div>

        @method($method ?? 'POST')
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        function loadStates(countryId, selectedStateId = null) {
            if (countryId) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('accommodations.getState') }}",
                    data: {
                        country_id: countryId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var states = response.states;
                        $('#states').empty().append('<option value="">Wybierz stan</option>');
                        if (states.length > 0) {
                            $.each(states, function(key, value) {
                                $('#states').append('<option value="' + value.id + '">' + value.state + '</option>');
                            });
                            if (selectedStateId) {
                                $('#states').val(selectedStateId);
                                loadCities(selectedStateId, $('#cities').data('selected'));
                            }
                        }
                    }
                });
            } else {
                $('#states').empty().append('<option value="">Wybierz stan</option>');
                $('#cities').empty().append('<option value="">Wybierz miasto</option>');
            }
        }

        function loadCities(stateId, selectedCityId = null) {
            if (stateId) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('accommodations.getCity') }}",
                    data: {
                        state_id: stateId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var cities = response.cities;
                        $('#cities').empty().append('<option value="">Wybierz miasto</option>');
                        if (cities.length > 0) {
                            $.each(cities, function(key, value) {
                                $('#cities').append('<option value="' + value.id + '">' + value.city + '</option>');
                            });
                            if (selectedCityId) {
                                $('#cities').val(selectedCityId);
                            }
                        }
                    }
                });
            } else {
                $('#cities').empty().append('<option value="">Wybierz miasto</option>');
            }
        }

        // Obsługa zmiany kraju
        $('#countries').change(function() {
            var countryId = $(this).val();
            loadStates(countryId);
        });

        // Obsługa zmiany stanu
        $('#states').change(function() {
            var stateId = $(this).val();
            loadCities(stateId);
        });

        // Przy ładowaniu strony ustaw stany i miasta, jeśli są już wybrane
        var selectedCountry = $('#countries').val();
        var selectedState = $('#states').data('selected');
        var selectedCity = $('#cities').data('selected');

        if (selectedCountry) {
            loadStates(selectedCountry, selectedState);
        }
    });
</script>

<script>
    $(document).ready(function() {
    // Obsługa zmiany stanu checkboxów
    $(".category_checkbox").change(function() {
        let checkbox1_checked = $("#category_{{$data["accommodation"]["accommodationCategory"][0]->id}}").is(":checked");
        let checkbox2_checked = $("#category_{{$data["accommodation"]["accommodationCategory"][1]->id}}").is(":checked");

        if (checkbox1_checked && !checkbox2_checked) {
            $('#value1_field').show();
            $('#value2_field').hide();
        } else if (!checkbox1_checked && checkbox2_checked) {
            $('#value1_field').hide();
            $('#value2_field').show();
        } else if (checkbox1_checked && checkbox2_checked) {
            $('#value1_field').show();
            $('#value2_field').show();
        } else {
            $('#value1_field').hide();
            $('#value2_field').hide();
        }
    });
});
</script>