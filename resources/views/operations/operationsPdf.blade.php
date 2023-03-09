<h4 align="center" ; style="text-transform: uppercase;">
    Opérations
</h4>

<h5>Listes des opérations</h5>

<table with="100%" style="border-collapse: collapse; border: 1px;">
    <thead>
        <tr>
            <th style="border: 1px solid; padding:6px;" width="10%">Date</th>
            <th style="border: 1px solid; padding:6px;" width="45%">Nature de l'opération</th>
            <th style="border: 1px solid; padding:6px;" width="25%">Catégorie de l'opération</th>
            <th style="border: 1px solid; padding:6px;" width="10%">Débit</th>
            <th style="border: 1px solid; padding:6px;" width="10%">Crédit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($operations as $operation)
        <tr>
            <td style="border: 1px solid; padding:6px;">{{$operation->operationDate}}</td>
            <td style="border: 1px solid; padding:6px;">{{$operation->operationDescription}}</td>
            <td style="border: 1px solid; padding:6px;">{{$operation->category->categoryName}}</td>
            <td style="border: 1px solid; padding:6px;">
                @if ($operation->operationSomme<0) {{$operation->operationSomme}} € @endif </td>
            <td style="border: 1px solid; padding:6px;">
                @if ($operation->operationSomme>=0)
                {{$operation->operationSomme}} €
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" style="border: 1px solid; padding:6px; text-align: right;">Total :</th>
            <td colspan="2" style="border: 1px solid; padding:6px;">
                @if($total >= 0)
                {{ $total }} €
                @else
                <div class="neg"> {{ $total }} € </div>
                @endif
            </td>
        </tr>
    </tfoot>
</table>