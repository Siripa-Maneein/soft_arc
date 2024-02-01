<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laravel Autocomplete</title>
    <link rel="stylesheet" href="//codeorigin.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//codeorigin.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
</head>
<body>
    <h2>Laravel Autocomplete</h2>

    {!! Form::open() !!}
    {!! Form::label('auto', 'Find a color: ') !!}
    {!! Form::text('auto', '', ['id' => 'auto']) !!} <br>
    {!! Form::label('response', 'Our color key: ') !!}
    {!! Form::text('response', '', ['id' => 'response', 'disabled' => 'disabled']) !!}
    {!! Form::close() !!}

    <script type="text/javascript">
        $(function () {
            $("#auto").autocomplete({
                source: "getdata",
                minLength: 1,
                select: function (event, ui) {
                    $('#response').val(ui.item.id);
                }
            });
        });
    </script>
</body>
</html>