<div class="row all-menus" id="beverage-menus">
    @foreach ($data as $menu)
        <div class="col-sm-4 menu" data-menuid="{{ $menu->id }}">
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
    <input type="hidden" name="hidden_page_beverage" id="hidden_page_beverage" value="1">
</div>
<div class="row justify-content-center mb-5">
    {{ $data->withQueryString()->links() }}
</div>