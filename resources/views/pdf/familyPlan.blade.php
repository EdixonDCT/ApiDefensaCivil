<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Plan Familiar</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { text-align: center; }
    </style>
</head>
<body>

<h1>Plan Familiar #{{ $plan->id }}</h1>

<p><strong>Nombre:</strong> {{ $plan->last_names }}</p>
<p><strong>Fechaa:</strong> {{ $plan->created_at }}</p>

</body>
</html>