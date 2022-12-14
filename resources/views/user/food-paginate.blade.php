<div class="row all-menus" id="food-menus">
    @foreach ($foodMenus as $menu)
        <div class="col-sm-4 menu" id="menu" data-menuid="{{ $menu->id }}">
            <div class="single-menu">
                <div class="row">
                    <div class="col-md-6">
                        <img src="/storage/{{$menu->menu_photo_path}}" alt="menu" width="150px" height="150px">
                    </div>
                    <div class="col-md-6">
                        <h4>{{ substr($menu->name, 0, 25) }}</h4>
                        <hr>
                        <span><strong>Stock : </strong>{{ $menu->stock }} </span><br>
                        <span><strong>Rp. {{ number_format($menu->price,2,',','.') }}</strong></span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <input type="hidden" name="hidden_page_food" id="hidden_page_food">
</div>
<div class="row justify-content-center mb-5">
    {{ $foodMenus->withQueryString()->links() }}
</div>