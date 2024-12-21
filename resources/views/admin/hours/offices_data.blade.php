<div class="card-body">
    {{ $hours->first()->office->status }} 
    <table style="font-size: 15px; text-align: center;" class="table table-striped table-hover table-sm table-bordered">
        <thead>
            <tr>
                <th scope="col">Hora</th>
                <th scope="col">Lunes</th>
                <th scope="col">Martes</th>
                <th scope="col">Miercoles</th>
                <th scope="col">Jueves</th>
                <th scope="col">Viernes</th>
                <th scope="col">Sabado</th>
            </tr>
        </thead>
        <tbody>
            @php
                $hours_worker = [
                    '08:00:00 - 09:00:00',
                    '09:00:00 - 10:00:00',
                    '10:00:00 - 11:00:00',
                    '11:00:00 - 12:00:00',
                    '12:00:00 - 13:00:00',
                    '13:00:00 - 14:00:00',
                    '14:00:00 - 15:00:00',
                    '15:00:00 - 16:00:00',
                    '16:00:00 - 17:00:00',
                    '17:00:00 - 18:00:00',
                    '18:00:00 - 19:00:00',
                    '19:00:00 - 20:00:00',
                ];
                $days = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
            @endphp
            @foreach ($hours_worker as $hour_worker)
                @php
                    [$start_time, $end_time] = explode(' - ', $hour_worker);
                @endphp
                <tr>
                    <td>{{ $hour_worker }}</td>
                    @foreach ($days as $day)
                        @php
                            $doctor_name = '';
                            foreach ($hours as $hour) {
                                if (
                                    strtoupper($hour->day) == strtoupper($day) &&
                                    ($start_time >= $hour->start_time || $hour->start_time < $end_time) &&
                                    ($end_time <= $hour->end_time || $hour->end_time > $start_time)
                                ) {
                                    $doctor_name = $hour->doctor->names;
                                    break;
                                }
                            }
                        @endphp
                        <td> {{ $doctor_name }} </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
