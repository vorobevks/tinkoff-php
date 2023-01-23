<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Общая стоимость акций в портфеле: {{ $portfolio->getTotalAmountShares() }}</p>
    <p>Общая стоимость облигаций в портфеле: {{ $portfolio->getTotalAmountBonds() }}</p>
    <p>Общая стоимость фондов в портфеле: {{ $portfolio->getTotalAmountEtf() }}</p>
    <p>Общая стоимость валют в портфеле: {{ $portfolio->getTotalAmountCurrencies() }}</p>
    <p>Общая стоимость фьючерсов в портфеле: {{ $portfolio->getTotalAmountFutures() }}</p>
    <p>Текущая относительная доходность портфеля, в %: {{ $portfolio->getExpectedYield() }}</p>
    <table class="table">
        <caption>Позиции в портфеле</caption>
        <tr>
            <th>Наименование</th>
            <th>Тип инструмента</th>
            <th>Штук в 1 лоте</th>
            <th>Количество лотов</th>
            <th>Количество, шт.</th>
            <th>Цена за 1 шт.</th>
            <th>Общая стоимость</th>
        </tr>
        @foreach($portfolio->getPositions() as $position)
            <tr>
                <td> {{ $position->getName() }}</td>
                <td> {{ $position->getInstrumentType() }}</td>
                <td> {{ $position->getQuantity() / $position->getQuantityLots() }}</td>
                <td> {{ $position->getQuantityLots() }}</td>
                <td> {{ $position->getQuantity() }}</td>
                <td> {{ $position->getCurrentPrice() . ' ' . $position->getCurrency() }}</td>
                <td> {{ round($position->getQuantity() * $position->getCurrentPrice(), 2) . ' ' . $position->getCurrency() }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>

