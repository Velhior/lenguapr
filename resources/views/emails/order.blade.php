<h3>Новый заказ</h3>
<div>
 ID Тарифа {{ $tariff_id }} <br />
 Название Тарифа {{$tariff_name}} <br />
 ID Юзера {{ $user_id }} <br />
 Имя Юзера {{ $user_name }} <br />
 Дата заказа @php echo date('Y-m-d H:i:s', $start_date) @endphp <br />
{{ $some }}

</div>