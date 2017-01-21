<html>
<head lang="ru">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Ваша заявка принята</title>
</head>
<body style="background-color:#ffffff;color:#333333;font-family:Arial,Helvetica,FreeSans,'Liberation Sans','Nimbus Sans L',sans-serif;font-size:15px">

<div class="mailsub" style="width:640px;margin:0 auto">
    <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:640px">
        <tr>
            <td style="text-align:center;padding:7px 0 10px;">
                <span style="font-size:11px;color:#999999;line-height:18px">Ваша заявка принята</span>
            </td>
        </tr>

        <tr>
            <td style="width:640px;vertical-align:top">
                <table cellpadding="0" cellspacing="0" style="border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-top:3px solid #f09713;border-collapse:collapse;width:100%">
                    <tr>
                        <td style="padding:25px 30px 20px 27px;vertical-align:top;border-bottom:1px solid #cccccc;">
                            <h1 style="font-size:28px;line-height:32px;padding-bottom:15px;font-weight:normal;margin:0">{{$order->contact_name}}, спасибо за ваш заказ!</h1>
                            <p style="font-size:15px;padding-bottom:0;line-height:24px;margin:0">
                                Ваша заявка принята.
                                Мы свяжемся с вами в ближайшее время для подтверждения заказа.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <table cellpadding="0" cellspacing="0" style="border-bottom:1px solid #cccccc;border-collapse:collapse;width:100%">
                                <tr>
                                    <td style="padding:0 30px 0 27px;vertical-align:top">
                                        <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;line-height:24px;width:580px">
                                            <tr>
                                                <td colspan="2" style="vertical-align:baseline">
                                                    <h2 style="font-size:26px;margin:0;font-weight:normal;padding:20px 0 10px 0">Заказ</h2>
                                                </td>
                                                <td style="vertical-align:baseline;text-align:right;font-size:15px">{{$order->created_up}}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:13px;padding-bottom:5px;width:280px;vertical-align:top;color:#999999">Название и цена товара</td>
                                                <td style="font-size:13px;padding-bottom:5px;width:100px;vertical-align:top;color:#999999">Кол-во</td>
                                                <td style="font-size:13px;padding-bottom:5px;width:200px;text-align:right;vertical-align:top;color:#999999">Сумма</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="border-top:1px solid #f0f0f0;vertical-align:top">
                                                    <?php $total = 0; ?>
                                                    @foreach($order->orderRows as $row)
                                                        <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;margin-top:10px;margin-bottom:10px;width:100%">
                                                            <tr>
                                                                <td align="center" style="padding-left:20px;padding-right:20px;padding-top:5px;padding-bottom:5px;width:100px;vertical-align:middle">
                                                                    <img src="http://www.куперхантер.укр{{\App\Article::find($row->article_id)->getIntroImg('XS')}}" border="0" width="80" height="51"
                                                                         alt="{{\App\Article::find($row->article_id)->name}}" style="display:block;background-color:#ffffff;">
                                                                </td>
                                                                <td>
                                                                    <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:100%">
                                                                        <tr>
                                                                            <td colspan="3" style="padding:0 0 3px 0;line-height:20px">
                                                                                {{--{{$row->article_name}} --}}
                                                                                <a href="{{route('showArticle', ['article' => \App\Article::find($row->article_id)->getArticleLink()])}}" target="_blank" style="color:#3e77aa;font-size:15px;text-decoration:none;word-break:break-word;">{{\App\Article::find($row->article_id)->name}}</a>
                                                                                {{--{{\App\Article::find(1)->name}}--}}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="font-size:15px;width:140px;vertical-align:top;padding-top:5px">{{$row->priceGRN}} грн</td>
                                                                            <td style="font-size:15px;width:100px;vertical-align:top;padding-top:5px">{{$row->count}} шт.</td>
                                                                            <td style="font-size:18px;width:200px;vertical-align:top;text-align:right;color:#333333;padding-top:5px">{{$row->priceGRN*$row->count}} грн </td>
                                                                            <?php $total += $row->priceGRN*$row->count; ?>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    @endforeach
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="3" style="border-top:1px solid #f0f0f0;padding-top:17px;padding-bottom:17px">
                                                    <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:100%">
                                                        <tr>
                                                            <td style="font-size:15px;vertical-align:top;width:140px">Покупатель</td>
                                                            <td style="font-size:15px;vertical-align:top">{{$order->contact_name}}, {{$order->phone}}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            @if(isset($order->description) && !empty($order->description)))
                                            <tr>
                                                <td colspan="3" style="border-top:1px solid #f0f0f0;padding-top:17px;padding-bottom:17px">
                                                    <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:100%">
                                                        <tr>
                                                            <td style="font-size:15px;vertical-align:top;width:140px">Комментарий</td>
                                                            <td style="font-size:15px;vertical-align:top">{{$order->description}}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="3" style="border-top:1px solid #f0f0f0;padding-top:22px;padding-bottom:22px">
                                                    <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:100%">
                                                        <tr>
                                                            <td style="font-size:18px;vertical-align:baseline">К оплате</td>
                                                            <td style="font-size:26px;text-align:right;vertical-align:baseline">{{$total}} грн </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


        <tr>
            <td style="width:640px;vertical-align:top">
                <table cellpadding="0" cellspacing="0" style="border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-collapse:collapse;width:100%">
                    <tr>
                        <td style="padding:22px 30px 22px 27px;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;">
                            <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:100%">
                                <tr>
                                    <td style="width:68px;vertical-align:middle">
                                        <img src="http://www.куперхантер.укр/css/res/phone.png" alt="Телефон" width="48" height="48" style="border-width:0;display:block">
                                    </td>
                                    <td style="vertical-align:middle">
                                        <p style="margin:0;font-size:15px;line-height:24px">Будем рады ответить на Ваши вопросы:</p>
                                        <p style="margin:0;padding:0;font-size:15px;line-height:24px">(044) 292-19-49, (044) 292-19-49</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:10px 0 14px">
                            <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:100%">
                                <tr>
                                    <td style="vertical-align:middle;border-right:1px solid #cccccc;width:290px;padding-left:20px;">
										<span style="color:#666666;font-size:12px">Интернет-магазин КУПЕРХАНТЕР.УКР<br>
										</span>
                                    </td>
                                    <td style="vertical-align:middle;text-align:center">
										<span style="font-size:12px;line-height:16px;color:#666666;">
											<strong>044 292-19-49</strong><br>044 292-19-49<br>044 292-19-49</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="font-size:0;vertical-align:top;border-top:3px solid #f09713;">

            </td>
        </tr>


    </table>
</div>
</body>
</html>