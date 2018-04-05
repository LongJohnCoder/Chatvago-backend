@if(session()->has('success'))
<div class="alert {{(session()->get('success') === true) ? 'alert-info' : 'alert-danger'}}">
    {{session()->get('message')}}
</div>
@endif
