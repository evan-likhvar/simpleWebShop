Ваш заказ принят к обработке
<hr>
Контакт = {{$order->contact_name}} <br>
Телефон = {{$order->phone}} <br>
Почта = {{$order->e_mail}} <br>
Плательщик = {{$order->payer}} <br>
<hr>
@foreach($order->orderRows as $row)
    {{$row->article_name}}<br>
    количество {{$row->count}}<br>
    цена {{$row->priceGRN}}<br>
    <hr>
@endforeach