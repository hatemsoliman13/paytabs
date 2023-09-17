<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Paytabs</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    </head>
    <body>
            <select name="category" id="category" onchange="handle(this)">
                <option disabled selected value=""> -- select a Category -- </option>
                @foreach ($mainCategories as $mainCategory)
                    <option value="{{$mainCategory->id}}" id="{{ $mainCategory->id }}">{{ $mainCategory->name }}</option>
                @endforeach
            </select>
        <script src="{{ asset('js/index.js')}}"></script>
   </body>
</html>
