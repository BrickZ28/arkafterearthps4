<div>
    The Pay Mod status is: {{$status}}
</div>
<br>
@foreach($totalOlds as $old)
    <div>
        Mod: {{$old->name}}
    </div>
    <div>
        New Pay: {{$old->gem_balance}}
    </div>
    <br>
@endforeach
<br>
@foreach($mods as $mod)
<div>
    Mod: {{$mod->name}}
</div>
<div>
    New Pay: {{$mod->gem_balance}}
</div>
    <br>
    @endforeach
