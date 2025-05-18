<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$currentLocale = app()->getLocale();
$otherLocale = ($currentLocale === 'ru') ? 'uz' : 'ru';
?>

<nav class="sidebar">
    <h2>{{ __('messages.menu') }}</h2>
    <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> {{ __('messages.panel') }}</a>
    <a href="{{ route('pilgrims.index') }}"><i class="fas fa-list"></i> {{ __('messages.queue') }}</a>

    @if(in_array($user->role->slug, ['root_admin']))
        <a href="{{ route('states.index') }}"><i class="fas fa-map"></i> {{ __('messages.regions') }}</a>
        <a href="{{ route('cities.index') }}"><i class="fas fa-city"></i> {{ __('messages.cites') }}</a>
    @endif

    @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin']))
        <a href="{{ route('districts.index') }}"><i class="fas fa-map-marker-alt"></i> {{ __('messages.districts') }}</a>
    @endif

    @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin', 'mahalla_admin']))
        <a href="{{ route('mahallas.index') }}"><i class="fas fa-building"></i> {{ __('messages.mahallas') }}</a>
    @endif

    <a href="{{ route('users.index') }}"><i class="fas fa-users"></i> {{ __('messages.admins') }}</a>
    <a href="{{ route('pilgrims.confirmedList', ['type' => 'hajj']) }}"><i class="fas fa-check-circle"></i> {{ __('messages.hajj_confirmed') }}</a>
    <a href="{{ route('pilgrims.confirmedList', ['type' => 'umra']) }}"><i class="fas fa-check-circle"></i> {{ __('messages.umrah_confirmed') }}</a>
    <a href="{{ route('status') }}"><i class="fas fa-user"></i> {{ __('messages.profile') }}</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> {{ __('messages.exit') }}
    </a>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

    <form method="POST" action="{{ route('locale.switch') }}">
        @csrf
        @if($currentLocale === 'uz')
            <button class="btn btn-language" type="submit" name="locale" value="ru">
                <i class="fas fa-globe"></i> {{ __('messages.ru') }}
            </button>
        @elseif($currentLocale === 'ru')
            <button class="btn btn-language" type="submit" name="locale" value="uz">
                <i class="fas fa-globe"></i> {{ __('messages.uz') }}
            </button>
        @endif
    </form>
</nav>

<button class="burger-menu" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<style>
    .sidebar {
        width: 250px;
        background-color: #1A3C34;
        color: #FFFFFF;
        height: 100vh;
        padding: 30px 20px;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        overflow-y: auto;
        font-family: 'Rubik', sans-serif;
        z-index: 1000;
        animation: fadeIn 0.5s ease-in;
    }

    .sidebar h2 {
        font-family: 'Amiri', serif;
        color: #D4A017;
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
        border-bottom: 1px solid #D4A017;
        padding-bottom: 15px;
    }

    .sidebar a {
        text-decoration: none;
        color: #FFFFFF;
        padding: 12px 15px;
        border-radius: 6px;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s, color 0.3s;
    }

    .sidebar a i {
        margin-right: 10px;
    }

    .sidebar a:hover {
        background-color: #D4A017;
        color: #1A3C34;
    }

    .sidebar .btn-language {
        background-color: #D4A017;
        color: #1A3C34;
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: auto;
        transition: background-color 0.3s, transform 0.2s;
    }

    .sidebar .btn-language:hover {
        background-color: #B8860B;
        transform: translateY(-2px);
    }

    .sidebar .btn-language i {
        margin-right: 8px;
    }

    .burger-menu {
        display: none;
        position: fixed;
        top: 1rem;
        left: 1rem;
        z-index: 1100;
        font-size: 1.5rem;
        color: #D4A017;
        background: none;
        border: none;
        cursor: pointer;
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateX(-20px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 250px;
            transform: translateX(-250px);
            transition: transform 0.3s ease;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .burger-menu {
            display: block;
        }

        .sidebar h2 {
            font-size: 20px;
        }

        .sidebar a {
            font-size: 14px;
        }
    }
</style>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
    }
</script>
