HTML::macro('MakeNavigation', function($data) {

foreach ($data as $key => $value) {
if($value->submenu) {
echo '<li class="'.$value->activeClass.'">
    <a href="'.$value->link.'" class="'.$value->activeClass.'">"'
        .$value->name.' <span class="fa arrow"></span>
    </a>';
    echo "<ul class='nav nav-".$value->level."-level ".$value->inClass." '>";
        HTML::MakeNavigation($value->submenu);
        echo "</ul>";
    }
    else {
    echo '<li class="'.$value->activeClass.'">
    <a href="'.$value->link.'" class="'.$value->activeClass.'">'
        .$value->name.'
    </a>';
    }
    echo "</li>";
}});