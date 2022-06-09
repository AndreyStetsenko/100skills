@component('mail::message')
# Новое бронирование

<div>
	Письмо с информацией о новом бронировании на сайте {{ config('app.name') }}
</div>

<br />

<article>
    <div>
        Данные о бронировании:
    </div>
    <div>
        Имя: <b>{{ $data['form']['name'] }}</b>
    </div>
    <div>
        Телефон: <b>{{ $data['form']['number'] }}</b>
    </div>
    <div>
        Email: <b>{{ $data['form']['email'] }}</b>
    </div>
    <div>
        Количество пассажиров: <b>{{ $data['form']['passenger'] }}</b>
    </div>
    <div>
        Детские места: <b>{{ isset($data['form']['child-seat']) ? "требуются" : "не требуются" }}</b>
    </div>
    <div>
        В одну/обе стороны: <b>{{ isset($data['form']['oneway']) ? "в одну сторону" : "в обе стороны" }}</b>
    </div>
    <div>
        Посмотрите бронирование на сайте: <b><a target="_blank" href="{{$data['form']['slug']}}">{{$data['form']['slug']}}</a></b>
    </div>
</article>

<br />

<article>
    <div>
        Информация о направлении:
    </div>
    <div>
        Номер отправления в системе: <b>{{ isset($data['directions']) ? $data['directions']['id'] : "-" }}</b>
    </div>
    <div>
        Наименование отправления в системе: <b>{{ isset($data['directions']) ? $data['directions']['title'] : "-" }}</b>
    </div>
    <div>
        Город отправления: <b>{{ isset($data['departure']) ? $data['departure']['title'] : "-" }}</b>
    </div>
    <div>
        Город прибытия: <b>{{ isset($data['arrival']) ? $data['arrival']['title'] : "-" }}</b>
    </div>
</article>

<br />

<article>
    <div>
        Информация о транспорте: 
    </div>  
    <div>
        Номер транспортного средства в системе: <b>{{ isset($data['transport']) ? $data['transport']['transport']->first()->id : "" }}</b> 
    </div>
    <div>
        Наименование транспортного средства: <b>{{ isset($data['transport']) ? $data['transport']['transport']->first()->title : "-" }}</b>
    </div>
    <div>
        Стоимость транспортного средства: <b>{{ isset($data['transport']) ? $data['transport']['transport']->first()->pivot['price'] . "EUR" : "-" }}</b>
    </div>
</article>

@endcomponent
