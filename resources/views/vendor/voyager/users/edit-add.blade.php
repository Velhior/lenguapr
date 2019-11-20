@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
              method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                    {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">{{ __('voyager::generic.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('voyager::generic.name') }}"
                                       value="{{ old('name', $dataTypeContent->name ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('voyager::generic.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}"
                                       value="{{ old('email', $dataTypeContent->email ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('voyager::generic.password') }}</label>
                                @if(isset($dataTypeContent->password))
                                    <br>
                                    <small>{{ __('voyager::profile.password_hint') }}</small>
                                @endif
                                <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                            </div>

                            @can('editRoles', $dataTypeContent)
                                <div class="form-group">
                                    <label for="default_role">{{ __('voyager::profile.role_default') }}</label>
                                    @php
                                        $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};

                                        $row     = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                                <div class="form-group">
                                    <label for="additional_roles">{{ __('voyager::profile.roles_additional') }}</label>
                                    @php
                                        $row     = $dataTypeRows->where('field', 'user_belongstomany_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                            @endcan
                            @php
                            if (isset($dataTypeContent->locale)) {
                                $selected_locale = $dataTypeContent->locale;
                            } else {
                                $selected_locale = config('app.locale', 'en');
                            }

                            @endphp

                            @php
                            //Additional Data Arrays
                            $interests = [
                                '',
                                'games',
                                'travel',
                                'business',
                                'studying',
                                'technical',
                                'tests',                                
                            ];

                            $regions = [
                                '',
                                'Австралия',
                                'Австрия',
                                'Азербайджан',
                                'Албания',
                                'Алжир',
                                'Ангола',
                                'Андорра',
                                'Антигуа и Барбуда',
                                'Аргентина',
                                'Армения',
                                'Афганистан',
                                'Багамские Острова',
                                'Бангладеш',
                                'Барбадос',
                                'Бахрейн',
                                'Белоруссия',
                                'Белиз',
                                'Бельгия',
                                'Бенин',
                                'Болгария',
                                'Боливия',
                                'Босния и Герцеговина',
                                'Ботсвана',
                                'Бразилия',
                                'Бруней',
                                'Буркина-Фасо',
                                'Бурунди',
                                'Бутан',
                                'Вануату',
                                'Великобритания',
                                'Венгрия',
                                'Венесуэла',
                                'Восточный Тимор',
                                'Вьетнам',
                                'Габон',
                                'Гаити',
                                'Гайана',
                                'Гамбия',
                                'Гана',
                                'Гватемала',
                                'Гвинея',
                                'Гвинея-Бисау',
                                'Германия',
                                'Гондурас',
                                'Гренада',
                                'Греция',
                                'Грузия',
                                'Дания',
                                'Джибути',
                                'Доминика',
                                'Доминиканская Республика',
                                'Египет',
                                'Замбия',
                                'Зимбабве',
                                'Израиль',
                                'Индия',
                                'Индонезия',
                                'Иордания',
                                'Ирак',
                                'Иран',
                                'Ирландия',
                                'Исландия',
                                'Испания',
                                'Италия',
                                'Йемен',
                                'Кабо-Верде',
                                'Казахстан',
                                'Камбоджа',
                                'Камерун',
                                'Канада',
                                'Катар',
                                'Кения',
                                'Кипр',
                                'Киргизия',
                                'Кирибати',
                                'Китай',
                                'Колумбия',
                                'Коморы',
                                'Республика Конго',
                                'Демократическая Республика Конго',
                                'КНДР',
                                'Республика Корея',
                                'Коста-Рика',
                                'Кот-д’Ивуар',
                                'Куба',
                                'Кувейт',
                                'Лаос',
                                'Латвия',
                                'Лесото',
                                'Либерия',
                                'Ливан',
                                'Ливия',
                                'Литва',
                                'Лихтенштейн',
                                'Люксембург',
                                'Маврикий',
                                'Мавритания',
                                'Мадагаскар',
                                'Малави',
                                'Малайзия',
                                'Мали',
                                'Мальдивы',
                                'Мальта',
                                'Марокко',
                                'Маршалловы Острова',
                                'Мексика',
                                'Мозамбик',
                                'Молдавия',
                                'Монако',
                                'Монголия',
                                'Мьянма',
                                'Намибия',
                                'Науру',
                                'Непал',
                                'Нигер',
                                'Нигерия',
                                'Нидерланды',
                                'Никарагуа',
                                'Новая Зеландия',
                                'Норвегия',
                                'ОАЭ',
                                'Оман',
                                'Пакистан',
                                'Палау',
                                'Панама',
                                'Папуа',
                                'Парагвай',
                                'Перу',
                                'Польша',
                                'Португалия',
                                'Россия',
                                'Руанда',
                                'Румыния',
                                'Сальвадор',
                                'Самоа',
                                'Сан-Марино',
                                'Сан-Томе и Принсипи',
                                'Саудовская Аравия',
                                'Северная Македония',
                                'Сейшельские Острова',
                                'Сенегал',
                                'Сент-Винсент и Гренадины',
                                'Сент-Китс и Невис',
                                'Сент-Люсия',
                                'Сербия',
                                'Сингапур',
                                'Сирия',
                                'Словакия',
                                'Словения',
                                'США',
                                'Соломоновы Острова',
                                'Сомали',
                                'Судан',
                                'Суринам',
                                'Сьерра-Леоне',
                                'Таджикистан',
                                'Таиланд',
                                'Танзания',
                                'Того',
                                'Тонга',
                                'Тринидад и Тобаго',
                                'Тувалу',
                                'Тунис',
                                'Туркмения',
                                'Турция',
                                'Уганда',
                                'Узбекистан',
                                'Украина',
                                'Уругвай',
                                'Федеративные Штаты Микронезии',
                                'Фиджи',
                                'Филиппины',
                                'Финляндия',
                                'Франция',
                                'Хорватия',
                                'Центральноафриканская Республика',
                                'Чад',
                                'Черногория',
                                'Чехия',
                                'Чили',
                                'Швейцария',
                                'Швеция',
                                'Шри-Ланка',
                                'Эквадор',
                                'Экваториальная Гвинея',
                                'Эритрея',
                                'Эсватини',
                                'Эстония',
                                'Эфиопия',
                                'ЮАР',
                                'Южный Судан',
                                'Ямайка',
                                'Япония',
                            ];
                            $specialities = [
                                'Подготовка к атестации',
                                'Технический язык',
                                'Бизнес направление',
                                

                            ];
                            @endphp


                            <div class="form-group">
                                <label for="locale">{{ __('voyager::generic.locale') }}</label>
                                <select class="form-control select2" id="locale" name="locale">
                                    @foreach (Voyager::getLocales() as $locale)
                                    <option value="{{ $locale }}"
                                    {{ ($locale == $selected_locale ? 'selected' : '') }}>{{ $locale }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <h4>Contacts:</h4>
                            <div class="form-group">
                                <label for="phone">Phone number</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Type the phone number"
                                       value="{{ old('phone', $dataTypeContent->phone ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="skype">Skype Login</label>
                                <input type="text" class="form-control" id="skype" name="skype" placeholder="Type the skype number"
                                       value="{{ old('skype', $dataTypeContent->skype ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="whatsupp">WhatsApp</label>
                                <input type="text" class="form-control" id="whatsupp" name="whatsupp" placeholder="Type the WhatsApp number"
                                       value="{{ old('whatsupp', $dataTypeContent->whatsupp ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="zoom">Zoom</label>
                                <input type="text" class="form-control" id="zoom" name="zoom" placeholder="Type the zoom number"
                                       value="{{ old('zoom', $dataTypeContent->zoom ?? '') }}">
                            </div>                               
                            <hr>
                            <h4>Status:</h4>                            
                            <div class="form-group  status-group">
                                <label>Is teacher</label>
                                <input type="checkbox" id="is_teacher" name="is_teacher" @if($dataTypeContent->is_teacher == 1) checked @endif>
                                <small>(The user is a teacher)</small>
                            </div>
                            <div class="form-group status-group">
                                <label>Is student</label>
                                <input type="checkbox" id="is_student" name="is_student" @if($dataTypeContent->is_student == 1) checked @endif>
                                <small>(The user is a student)</small>
                            </div>
                            <div class="form-group status-group">
                                <label>Is approved</label>
                                <input type="checkbox" id="is_approved" name="is_approved" @if($dataTypeContent->is_approved == 1) checked @endif>
                                <small>(User Data (like email and phone number) has been approved)</small>
                            </div>
                            <hr>
                            <h4>Region:</h4>                            
                            <div class="form-group  status-group">
                                <label>Region</label>
                                <select name="region" id="region">
                                @foreach ($regions as $region)
                                    <option value="{{$region}}" @if($region == $dataTypeContent->region) checked  @endif>{{$region}}</option>      
                                @endforeach
                                </select> 
                                <small>User region</small>
                            </div>
                            <h4>Speciality:</h4>                            
                            <div class="form-group  status-group">
                                <label>Speciality</label>
                                <select name="speciality" id="speciality">
                                @foreach ($specialities as $speciality)
                                    <option value="{{$speciality}}" @if($speciality == $dataTypeContent->speciality) checked  @endif>{{$speciality}}</option>      
                                @endforeach
                                </select> 
                                <small>User speciality</small>
                            </div>
                            <h4>Interests:</h4>
                            <div class="form-group status-group">
                                <label>Interest 1:</label>
                                <select name="interest_1" id="interest_1">
                                    @foreach ($interests as $interest)
                                        <option value="{{$interest}}" @if($interest == $dataTypeContent->interest_1) checked  @endif>{{$interest}}</option>      
                                    @endforeach                                    
                                </select>                                    
                                <small>User interest 1</small>
                            </div>
                            <div class="form-group status-group">
                                <label>Interest 2:</label>
                                <select name="interest_2" id="interest_2">
                                        @foreach ($interests as $interest)
                                            <option value="{{$interest}}" @if($interest == $dataTypeContent->interest_2) checked  @endif>{{$interest}}</option>      
                                        @endforeach                                    
                                    </select>   
                                <small>User interest 2</small>
                            </div>
                            <div class="form-group status-group">
                                <label>Interest 3:</label>
                                <select name="interest_3" id="interest_3">
                                        @foreach ($interests as $interest)
                                            <option value="{{$interest}}" @if($interest == $dataTypeContent->interest_3) checked  @endif>{{$interest}}</option>      
                                        @endforeach                                    
                                    </select>   
                                <small>User interest 3</small>
                            </div>
                            <div class="form-group status-group">
                                <label>Interest 4:</label>
                                <select name="interest_4" id="interest_4">
                                        @foreach ($interests as $interest)
                                            <option value="{{$interest}}" @if($interest == $dataTypeContent->interest_4) checked  @endif>{{$interest}}</option>      
                                        @endforeach                                    
                                    </select>   
                                <small>User interest 4</small>
                            </div>
                            <div class="form-group status-group">
                                <label>Interest 5:</label>
                                <select name="interest_5" id="interest_5">
                                        @foreach ($interests as $interest)
                                            <option value="{{$interest}}" @if($interest == $dataTypeContent->interest_5) checked  @endif>{{$interest}}</option>      
                                        @endforeach                                    
                                    </select>   
                                <small>User interest 5</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                @if(isset($dataTypeContent->avatar))
                                    <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="avatar" name="avatar">
                            </div>
                            <div class="form-group">
                                <label for="description">User Description</label>
                                <textarea rows="15" class="form-control" id="description" name="description">
                                       {{ old('zoom', $dataTypeContent->zoom ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                {{ __('voyager::generic.save') }}
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
