@props(['user'])

<x-dropdown {{ $attributes->merge(['gatilhoId' => 'userDropdown']) }}>
    <x-slot:gatilho class="nav-link text-secondary">
        {{ $user->name }}
    </x-slot>
    <x-slot:menu class="dropdown-menu-end">
        <x-dropdown-item href="{{ route('profile.edit') }}">{{ __('Profile') }}</x-dropdown-item>
        <x-dropdown-item href="{{ route('logout') }}">{{ __('Log Out') }}</x-dropdown-item>
    </x-slot:menu>
</x-dropdown>
