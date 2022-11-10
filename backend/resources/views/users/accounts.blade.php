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
            <td> {{ $account->id }}</td>
            <td> {{ $account->type }}</td>
            <td> {{ $account->name }}</td>
            <td> {{ $account->status }}</td>
            <td> {{ $account->openedDate }}</td>
            <td> {{ $account->closedDate }}</td>
            <td> {{ $account->accessLevel }}</td>
        </tr>
        @endforeach

    </table>
