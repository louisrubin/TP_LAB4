

<div style="position: relative; display: inline-block; text-align: center;">
    <img src="images/main_img.jpg" style="width: 100%; height:150px;  "  >

    <div style="position: absolute; top: 7%; left: 37%; transform: translate(-50%, -50%); 
        color: black; font-size: 20px; font-weight: bold; width: 100%">
        <h3>Laboratorio de Computación 4 (2024)</h3>
        <h4>Sistema de Gestión Escolar en Laravel</h4>
    </div>

    <div style="position: absolute; top: 11%; left: 86%; transform: translate(-50%, -50%); 
        color: black; font-size: 15px; width: 100%" >
        <p>RUBIN AZAS M. Luis</p>
        <p>ZAMORA Martín</p>
    </div>
    
</div>

<div class="container">
    <h1>Cursos</h1>

    <table class="table" style="width: 100%;">
        <thead>
            <tr style="font-size: 1.2em;">
                <th>Nombre</th>
                <th>Materia</th>
                <th>Cant. Alumnos</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr style="text-align: center;">
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->subject->name ?? 'Sin asignar' }}</td>
                    <td style="padding-left: 30px;">{{ $item->students->count() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No se encontraron Cursos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <hr style="margin-top: 30px;">

</div>

