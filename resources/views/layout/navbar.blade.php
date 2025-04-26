@section('nav')
<button type="button"
        class="inline-flex items-center px-5 py-2.5 mb-3 text-sm font-medium text-center text-white bg-gray-500 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-600"
        onclick="window.location='{{ url(route("competitions.new")) }}'">
    Добавить соревнование
</button>

<ul class="space-y-2 mt-0">
    @foreach($competitions as $competition)
    <li>
        <button type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-competitions-{{ $competition->id }}" data-collapse-toggle="dropdown-competitions-{{ $competition->id }}">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
            </svg>
            <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ $competition->title }},<br />{{ $competition->start_date->format('d.m') }} - {{ $competition->end_date->format('d.m') }}</span>
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <ul id="dropdown-competitions-{{ $competition->id }}">
            @if($competition->isRegistrationOpen())
            <li class="pl-4 text-gray-500 dark:text-gray-400"><a href="{{ route('competitions.registrationForm', $competition->id) }}">✎ Регистрация</a></li>
            @endif
            @if($competition->participants_list_available_to_anyone || \App\Auth\ClientCertificateOrBasicAuthAuthenticator::isAuthenticated())
            <li class="pl-4 text-gray-500 dark:text-gray-400">≡ Список участников</li>
            @endif
            @if(\App\Auth\ClientCertificateOrBasicAuthAuthenticator::isAuthenticated())
            <li class="pl-4 text-gray-500 dark:text-gray-400">⚙ Настройки</li>
            <li class="pl-4 text-gray-500 dark:text-gray-400">╳ Удалить</li>
            @endif
        </ul>
    @endforeach
</ul>
@show
