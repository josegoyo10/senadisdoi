<ul class="nav nav-tabs nav-justified aaa" style="max-width: 100%;font-size: 12px; vertical-align: middle; color: red " role="tablist">
    @foreach($dimension as $row)
        @if($row->nombre != "")
                <li style="height: 65.33px;" class="aaa">
                 <a onClick='activate_tab({{$row->id}})' style="height: 65.33px;color:#3c8dbc; border-right : 1px solid #ddd; border-top:1px solid #ddd;border-left:1px solid #ddd" data-toggle="tab"  data-id-dimension="{{$row->id}}" aria-controls="home2"  href="#dimension{{$row->id}}">{{ $row->nombre }}</a>
                </li>
        @endif        
    @endforeach
</ul>
