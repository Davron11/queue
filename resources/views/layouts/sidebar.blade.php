<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$currentLocale = app()->getLocale();
$otherLocale = ($currentLocale === 'ru') ? 'uz' : 'ru';
?>

<div class="sidebar">
    <h2>{{ __('messages.menu') }}</h2>

    <a href="{{ route('dashboard') }}">{{ __('messages.panel') }}</a>
    <a href="{{ route('pilgrims.index') }}">{{ __('messages.queue') }}</a>

    @if(in_array($user->role->slug, ['root_admin']))
        <a href="{{ route('states.index') }}">{{ __('messages.regions') }}</a>
        <a href="{{ route('cities.index') }}">{{ __('messages.cites') }}</a>
    @endif

    @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin']))
        <a href="{{ route('districts.index') }}">{{ __('messages.districts') }}</a>
    @endif

    @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin', 'mahalla_admin']))
        <a href="{{ route('mahallas.index') }}">{{ __('messages.mahallas') }}</a>
    @endif

    <a href="{{ route('users.index') }}">{{ __('messages.admins') }}</a>
    <a href="{{ route('pilgrims.confirmedList', ['type' => 'hajj'])}}">{{ __('messages.hajj_confirmed') }}</a>
    <a href="{{ route('pilgrims.confirmedList', ['type' => 'umra']) }}">{{ __('messages.umrah_confirmed') }}</a>
    <a href="{{ route('status') }}">{{ __('messages.profile') }}</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('messages.exit') }}
    </a>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

    <form method="POST" action="{{ route('locale.switch') }}">
        @csrf
        @if($currentLocale === 'uz')
            <button class="btn" type="submit" name="locale" value="ru">
                {{ __('messages.ru') }}
            </button>
        @elseif($currentLocale === 'ru')
            <button class="btn" type="submit" name="locale" value="uz">
                {{ __('messages.uz') }}
            </button>
        @endif
    </form>
</div>
