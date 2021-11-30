@extends('layouts/app')
@section('content')
<!DOCTYPE html>
<html>
<body>
<h1>Panggil antrian</h1>
<div id="result"></div>
<form id="form_antrian" action="{{route('push.get_antrian')}}" method="POST">
{{csrf_field()}} {{method_field('POST')}}
    <label>No. Perkara</label>
    <input type="text" name="no_perkara" id="no_perkara">
    <button type="submit" id="call">Submit</button>
</form>
</body>
</html>
@endsection
@push('scripts')
<script type="text/JavaScript">
$(document).ready(function(){
    $("#call").click(function(e){
        e.preventDefault();
        let no_perkara = $("#no_perkara").val();
        console.log("No. Perkara "+no_perkara);
        $.ajax({
            url:"{{route('push.get_antrian')}}",
            type:"GET",
            data:{no_perkara:no_perkara}
        });
    });
});
</script>
@endpush