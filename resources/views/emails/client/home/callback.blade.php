@component('mail::message')
# Уведомление с сайта {{ config('app.name') }}

<div>
	Вы получили новую заявку с сайта {{ config('app.name') }}
</div>
<div>
    Имя пользователя: {{ $userdata['name'] }}
</div>
<div>
    Телефон пользователя: {{ $userdata['phone'] }}
</div>

@endcomponent
