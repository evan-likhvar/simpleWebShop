<div id="footer" class="container-fluid">
    <div class="row text-center">
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <div><span class="podzag">Мы работаем</span><br>{!! $siteParameters['workFlow'] !!}</div><br>
            <div><span class="podzag">Контактные телефоны</span></div>
            {{$siteParameters['phone1']}}<br>{{$siteParameters['phone2']}}<br>
            {{$siteParameters['phone3']}}<br>{{$siteParameters['phone4']}}
        </div>

        <div class="col-sm-4">
            <div><span style="font-size: 120%; line-height: 2em;">Адрес:</span> {{$siteParameters['address']}}
            </div>
            <div id="googleMap" style="height:200px;width:100%;padding-top: 4px; margin-top: 7px; margin-bottom: 10px;"></div>
            <script type="application/javascript">
                function myMap() {
                    //var myCenter = new google.maps.LatLng(50.4179174,30.5438195);
                    var myCenter = new google.maps.LatLng({{$siteParameters['cordX']}},{{$siteParameters['cordY']}});
                    var mapProp = {center:myCenter, zoom:12, scrollwheel:true, draggable:true, mapTypeId:google.maps.MapTypeId.ROADMAP};
                    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                    var marker = new google.maps.Marker({position:myCenter});
                    marker.setMap(map);
                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvZg1cPhl9InRcoPf-8Xgewu8myx2XqXk&callback=myMap"></script>
        </div>
    </div>
</div>