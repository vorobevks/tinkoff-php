    <table>
        <tr>
            <th>id</th>
            <th>Тип</th>
            <th>Название</th>
            <th>Статус</th>
            <th>Дата открытия</th>
            <th>Дата закрытия</th>
            <th>Уровень доступа</th>
        </tr>
        @foreach($accounts as $account)
        <tr>
            <td><a href="{{ route('getPortfolio', $account->getId()) }}">{{ $account->getId() }}</a></td>
            <td> {{ $account->getType() }}</td>
            <td> {{ $account->getName() }}</td>
            <td> {{ $account->getStatus() }}</td>
            <td> {{ $account->getOpenedDate() }}</td>
            <td> {{ $account->getClosedDate() }}</td>
            <td> {{ $account->getAccessLevel() }}</td>
        </tr>
        @endforeach

    </table>
