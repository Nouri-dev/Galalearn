<!-- resources/views/workspace/index_result.blade.php -->

<div id="index-show-result" class="container" style="display: none;">
    <h1>Résultats des Quiz</h1>
    <table>
        <thead>
            <tr>
                <th>Quiz</th>
                <th>Score</th>
                <th>Date Complétée</th>
                <th>Date de Nouvel Essai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($results as $result)
            <tr>
                <td>{{ $result->quiz->title }}</td>
                <td>{{ $result->score }} %</td>
                <td>{{ $result->date_completed }}</td>
                <td>{{ $result->updated_at }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Aucun résultat trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

   
</div>












