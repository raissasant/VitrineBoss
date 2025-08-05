@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-purple-700">Leads Capturados</h1>

    @if($leads->count())
        <div class="overflow-x-auto bg-white rounded-lg shadow p-6">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Nome</th>
                        <th class="px-4 py-2">E-mail</th>
                        <th class="px-4 py-2">WhatsApp</th>
                        <th class="px-4 py-2">Produto</th>
                        <th class="px-4 py-2">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $lead)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $lead->nome }}</td>
                            <td class="px-4 py-2">{{ $lead->email }}</td>
                            <td class="px-4 py-2">{{ $lead->whatsapp }}</td>
                            <td class="px-4 py-2">{{ $lead->produto }}</td>
                            <td class="px-4 py-2">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $leads->links() }}
        </div>
    @else
        <p class="text-gray-500">Nenhum lead encontrado.</p>
    @endif
</div>
@endsection
