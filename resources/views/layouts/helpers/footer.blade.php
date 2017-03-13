<div id="footer" class="container-fluid">
    <div class="row text-center">
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <div><span class="podzag">Мы работаем</span><br>понедельник - пятница <br> с 10-00 до 19-00</div><br>
            <div><span class="podzag">Контактные телефоны</span></div>
            (044) 360-64-50<br>(050) 600-10-70<br>
            (067) 703-73-00<br>(063) 667-99-22
        </div>

        <div class="col-sm-4">
            <div><span style="font-size: 120%; line-height: 2em;">Адрес:</span> бульвар Дружбы Народов, 25
            </div>
            <div id="googleMap" style="height:200px;width:100%;padding-top: 4px; margin-top: 7px; margin-bottom: 10px;"></div>
            <script type="application/javascript">
                function myMap() {
                    var myCenter = new google.maps.LatLng(50.4179174,30.5438195);
                    var mapProp = {center:myCenter, zoom:12, scrollwheel:true, draggable:true, mapTypeId:google.maps.MapTypeId.ROADMAP};
                    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                    var marker = new google.maps.Marker({position:myCenter});
                    marker.setMap(map);
                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvZg1cPhl9InRcoPf-8Xgewu8myx2XqXk&callback=myMap"></script>




            <!--
            To use this code on your website, get a free API key from Google.
            Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
            -->
        </div>
    </div>
</div>