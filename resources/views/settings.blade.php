@php
    $setting['is_tbot_active'] = is_null($settings) ? false : $settings->is_tbot_active;
    $setting['tbot_token'] = is_null($settings) ? "" : $settings->tbot_token;
    $setting['tbot_channel_id'] = is_null($settings) ? "" : $settings->tbot_channel_id;;
@endphp

<x-header/>
<x-app-layout/>
<div>
    <div class="d-flex flex-row justify-content-center">
        <h2>Настройки</h2>
    </div>
    <form class="formform-control" id="category" method="post" enctype="multipart/form-data" action="{{route('settings.save')}}">
        @csrf
        <div class="d-flex flex-row justify-content-center">
            <div class="d-flex flex-column justify-content-center fw-bold border border-secondary px-3">
                Настройки telegramm-бота:
            </div>
            <div class="d-flex flex-column justify-content-start border border-secondary px-3">
                <div class="d-flex flex-column justify-content-center">
                    Активирован:
                </div>
                <div class="d-flex flex-column justify-content-start text-center align-content-center form-check form-switch">
                    @if ($setting['is_tbot_active'])
                        <input id="isTBotActive" class="form-check-input" type="checkbox" name="isTBotActive" checked>
                    @else
                        <input id="isTBotActive" class="form-check-input" type="checkbox" name="isTBotActive">
                    @endif
                </div>
            </div>
            <div class="d-flex flex-column justify-content-start border border-secondary px-3">
                Канал:
                <x-text-input id="tBotChannel" class="form-control form-control-sm w-auto block mt-1 items-center justify-center" type="text" name="tBotChannel" value="{{$setting['tbot_channel_id']}}" required autofocus autocomplete="tBotChannel" />
                <x-input-error :messages="$errors->get('tBotChannel')" class="mt-2" />
            </div>
            <div class="d-flex flex-column justify-content-start col-2 border border-secondary px-3">
                <label for="tBotToken" class="form-label">Токен:</label>
                <textarea class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="tBotToken" rows="2" name="tBotToken">{{$setting['tbot_token']}}</textarea>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-center">

        </div>
        <div class="d-flex flex-row justify-content-center my-2">
            <button type="submit" class="btn btn-primary btn-sm shadow-lg" name="" value="">Сохранить</button>
        </div>
    </form>
</div>

