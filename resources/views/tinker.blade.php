<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BotMan Studio</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        body {
            font-family: "Source Sans Pro", sans-serif;
            margin: 0;
            padding: 0;
            background: radial-gradient(#57bfc7, #45a6b3);
        }

        .container {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .content {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content" id="app">
        <botman-tinker api-endpoint="/botman"></botman-tinker>
    </div>
</div>


@php
    App\Type::insert("INSERT INTO `types` (`id`, `type`, `prix`, `temps`, `photo`, `point`, `created_at`, `updated_at`) VALUES
(1, 'حلاقة عادية', '250', '20', 'https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599381388/1_ks3mg3.jpg', '10', NULL, NULL),
(2, 'لحية', '100', '10', 'https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599380742/6a9e1200d5f747a7a8a8e2010ccb9f02_vwjebs.jpg', '5', NULL, NULL),
(7, 'حلاقة عادية + لحية', '300', '30', 'https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599381715/semtouhair-salon-de-coiffure002_ja1gvx.jpg', '20', NULL, NULL),
(8, 'تور دوراي', '50', '5', 'https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599380735/hairdresser-hairstyle-cutting-hair-men-hair-salon-barber-beauty-spa-cutting-only-men_cxf1er.jpg', '5', NULL, NULL);
");

@endphp

<script src="/js/app.js"></script>
</body>
</html>