<?php
    $user = \Illuminate\Support\Facades\Auth::user();
?>
<div class="sidebar">
    <h2>Меню</h2>
    <a href="{{ route('dashboard') }}">Панель
    <a href="{{ route('add') }}">Добавить жителя</a>
    <a href="{{ route('pilgrims.index') }}">Очередь</a>
    @if(in_array($user->role->slug, ['root_admin']))
        <a href="{{ route('states.index') }}">Регионы</a>
    @endif
    @if(in_array($user->role->slug, ['root_admin']))
    @if(in_array($user->role->slug, ['root_admin', 'state_admin']))
    @endif
        <a href="{{ route('cities.index') }}">Города</a>
    @endif
    @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin']))
        <a href="{{ route('districts.index') }}">Районы</a>
    @endif
    @if(in_array($user->role->slug, ['root_admin', 'state_admin', 'city_admin', 'mahalla_admin']))
        <a href="{{ route('mahallas.index') }}">Махалли</a>
    @endif
        <a href="{{ route('users.index') }}">Администраторы</a>
    <a href="{{ route('status') }}">Профиль</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>
</div>

<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
    @csrf
</form>
