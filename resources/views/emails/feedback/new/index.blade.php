@component('mail::message')
# Новый отзыв

<div>
	Письмо с информацией о новом отзыва на сайте {{ config('app.name') }}
</div>

<br />

<article>
    <div>
        Информация об отзыве:
    </div>
    <div>
        Имя: <b>{{ $data['form']['name'] }}</b>
    </div>
    <div>
        Email: <b>{{ $data['form']['email'] }}</b>
    </div>
    <div>
        Сообщение: <b>{{ $data['form']['message'] }}</b>
    </div>
</article>

<br />

@endcomponent
