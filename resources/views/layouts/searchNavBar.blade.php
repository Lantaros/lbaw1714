<form action="" method="get">
    <ul class="searchNav">
        <li id="options">
            <a style="cursor: pointer" href="{{route('events')}}">Filter</a>
            <ul class="subSearchNav">
            </ul>
        </li>
        <li id="search">
            <input type="text" name="search_text" id="search_text" placeholder="Search"/>
            <input type="button" name="search_button" id="search_button">
        </li>
    </ul>
</form>